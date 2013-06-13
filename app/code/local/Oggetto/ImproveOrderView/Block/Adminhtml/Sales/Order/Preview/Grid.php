<?php
/**
 * Oggetto Web extension for Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade
 * the Oggetto ImproveOrderView module to newer versions in the future.
 * If you wish to customize the Oggetto ImproveOrderView module for your needs
 * please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Oggetto
 * @package    Oggetto_ImproveOrderView
 * @copyright  Copyright (C) 2013 Oggetto Web (http://oggettoweb.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml sales order gird
 *
 * @category   Oggetto
 * @package    Oggetto_ImproveOrderView
 * @subpackage Block
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_ImproveOrderView_Block_Adminhtml_Sales_Order_Preview_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    const PREVIEW_IMAGE_WIDTH   = 50;
    const PREVIEW_IMAGE_HEIGHT  = 50;

    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setPagerVisibility(false);
        $this->setFilterVisibility(false);
        $this->setHeadersVisibility(false);
    }

    /**
     * Get order id
     *
     * @return int
     * @throws Mage_Core_Exception
     */
    public function getOrderId()
    {
        if ($this->hasData('order_id')) {
            return $this->_getData('order_id');
        }
        Mage::throwException(sprintf('Require set order id in %s', get_called_class()));
    }

    /**
     * Prepare collection
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        /* @var $collection Mage_Sales_Model_Resource_Order_Item_Collection */
        $collection = Mage::getModel('sales/order')->setId($this->getOrderId())->getItemsCollection();
        foreach ($collection as $item) {
            /* @var $item Mage_Sales_Model_Order_Item */
            if ($item->getProductType() === Mage_Catalog_Model_Product_Type::TYPE_SIMPLE
                && $item->getParentItemId()
            ) {
                $collection->removeItemByKey($item->getId());
            }
        }
        $this->setCollection($collection);
        $this->setDefaultLimit(count($collection)); // show all items
        return parent::_prepareCollection();
    }

    /**
     * Prepare columns
     *
     * @return void
     */
    public function _prepareColumns()
    {
        $this->addColumn('product_link', array(
            'header'            => $this->helper('oggetto_iov')->__('Product Link'),
            'sortable'          => false,
            'filter'            => false,
            'width'             => '100px',
            'align'             => 'center',
            'frame_callback'    => array($this, 'decorateProductPreviewLink')
        ));
        $this->addColumn('product', array(
            'header'            => $this->helper('oggetto_iov')->__('Product'),
            'type'              => 'text',
            'sortable'          => false,
            'frame_callback'    => array($this, 'formatProductName')
        ));
        $this->addColumn('qty', array(
            'header'            => $this->helper('oggetto_iov')->__('Qty'),
            'type'              => 'number',
            'sortable'          => false,
            'index'             => 'qty_ordered',
        ));
        $this->addColumn('price', array(
            'header'            => $this->helper('oggetto_iov')->__('Price'),
            'type'              => 'price',
            'sortable'          => false,
            'index'             => 'row_total',
        ));

        parent::_prepareColumns();
    }

    /**
     * Product name
     *
     * @param string                                  $value    value
     * @param Varien_Object                           $row      row
     * @param Mage_Adminhtml_Block_Widget_Grid_Column $column   column
     * @param bool                                    $isExport is export
     * @return string
     */
    public function formatProductName($value, $row, $column, $isExport)
    {
        return '<p><strong>' . $row->getData('name') . '</strong><br />' . $row->getData('sku') . '</p>';
    }

    /**
     * Product preview link
     *
     * @param string                                  $value    value
     * @param Varien_Object                           $row      row
     * @param Mage_Adminhtml_Block_Widget_Grid_Column $column   column
     * @param bool                                    $isExport is export
     * @return string
     */
    public function decorateProductPreviewLink($value, $row, $column, $isExport)
    {
        $product = Mage::getModel('catalog/product')->setId($row->getData('product_id'));
        $src = Mage::helper('oggetto_iov')->getItemProductImageSrc(
            $row->getData('product_id'), self::PREVIEW_IMAGE_WIDTH, self::PREVIEW_IMAGE_HEIGHT
        );

        $preview = Mage::helper('oggetto_iov')->__('Preview');
        $link = $src ? "<img src=\"{$src}\" title=\"{$preview}\" />" : $preview;

        return "<a href=\"{$product->getProductUrl()}\" target=\"_blank\">$link</a>";
    }
}
