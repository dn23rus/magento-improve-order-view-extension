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
 * Pview column renderer
 *
 * @category   Oggetto
 * @package    Oggetto_ImproveOrderView
 * @subpackage Block
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_ImproveOrderView_Block_Adminhtml_Widget_Grid_Column_Renderer_Preview
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Renders grid column
     *
     * @param Varien_Object $row row
     * @return string
     */
    public function render(Varien_Object $row)
    {
        if (Mage::helper('oggetto_iov')->isPreviewTypeGrid()) {
            $block = Mage::app()->getLayout()->createBlock('oggetto_iov/adminhtml_sales_order_preview_grid');
            $block->setOrderId($row->getId());
            return $block->toHtml();
        } elseif (Mage::helper('oggetto_iov')->isPreviewTypePopup()) {
            $url     = $this->getUrl('adminhtml/improveOrderView/index', array('id' => $row->getId()));
            $src     = Mage::getBaseUrl('skin') . 'adminhtml/default/default/images/oggetto/preview.png';
            $preview = Mage::helper('oggetto_iov')->__('Preview');
            return <<<"LINK"
<a class="preview-items-link" onclick="javascript:showItemsPreviewWindow('{$url}')">
    <img src="{$src}" alt="{$preview}" title="{$preview}" />
</a>
LINK;
        }
        return '';
    }
}
