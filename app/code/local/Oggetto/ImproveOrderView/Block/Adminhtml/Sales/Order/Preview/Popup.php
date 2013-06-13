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
 * Popup window
 *
 * @category   Oggetto
 * @package    Oggetto_ImproveOrderView
 * @subpackage Block
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_ImproveOrderView_Block_Adminhtml_Sales_Order_Preview_Popup extends Mage_Adminhtml_Block_Template
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setOrder(Mage::registry('order'));
    }

    /**
     * Get order
     *
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        if (!$this->hasData('order')) {
            Mage::throwException(sprintf('Requires set order instance in %s', get_called_class()));
        }
        return $this->_getData('order');
    }

    /**
     * Items html
     *
     * @return string
     */
    public function getItemsHtml()
    {
        return $this->getChildHtml('order_items_preview_popup');
    }
}
