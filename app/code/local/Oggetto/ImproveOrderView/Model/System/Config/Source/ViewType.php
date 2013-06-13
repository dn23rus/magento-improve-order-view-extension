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
 * System config source model
 *
 * @category   Oggetto
 * @package    Oggetto_ImproveOrderView
 * @subpackage Model
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_ImproveOrderView_Model_System_Config_Source_ViewType
{
    const PREVIEW_TYPE_DISABLED         = 0;
    const PREVIEW_TYPE_GRID             = 1;
    const PREVIEW_TYPE_POPUP            = 2;

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array(
                'value' => self::PREVIEW_TYPE_DISABLED,
                'label' => Mage::helper('oggetto_iov')->__('Disable')
            ),
            array(
                'value' => self::PREVIEW_TYPE_GRID,
                'label' => Mage::helper('oggetto_iov')->__('In Grid')
            ),
            array(
                'value' => self::PREVIEW_TYPE_POPUP,
                'label' => Mage::helper('oggetto_iov')->__('In Popup Window')
            ),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            self::PREVIEW_TYPE_DISABLED => Mage::helper('oggetto_iov')->__('Disable'),
            self::PREVIEW_TYPE_GRID     => Mage::helper('oggetto_iov')->__('In Grid'),
            self::PREVIEW_TYPE_POPUP    => Mage::helper('oggetto_iov')->__('In Popup Window'),
        );
    }
}
