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
 * ImproveOrderViewController
 *
 * @category   Oggetto
 * @package    Oggetto_ImproveOrderView
 * @subpackage controller
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_ImproveOrderView_Adminhtml_ImproveOrderViewController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Index Action
     *
     * @return void
     */
    public function indexAction()
    {
        $orderId = (int) $this->getRequest()->getParam('id');
        if (!$orderId) {
            $this->redirect('noRoute');
        }
        Mage::register('order', Mage::getModel('sales/order')->load($orderId));
        $this->loadLayout();
        $this->renderLayout();
    }
}
