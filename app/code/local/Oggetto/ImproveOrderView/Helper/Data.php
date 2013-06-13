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
 * Default helper
 *
 * @category   Oggetto
 * @package    Oggetto_ImproveOrderView
 * @subpackage Helper
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_ImproveOrderView_Helper_Data extends Mage_Core_Helper_Data
{
    const XML_PATH_GRID_VIEW_TYPE       = 'sales/order_view/grid_view_type';
    const XML_PATH_ORDER_ITEMS_IMAGES   = 'sales/order_view/order_grid_view';

    const PREVIEW_IMAGE_WIDTH           = 50;
    const PREVIEW_IMAGE_HEIGHT          = 50;

    protected $productIds = array();

    /**
     * Preview type grid
     *
     * @return bool
     */
    public function isPreviewTypeGrid()
    {
        return Mage::getStoreConfig(self::XML_PATH_GRID_VIEW_TYPE) ==
            Oggetto_ImproveOrderView_Model_System_Config_Source_ViewType::PREVIEW_TYPE_GRID;
    }

    /**
     * Preview type popup
     *
     * @return bool
     */
    public function isPreviewTypePopup()
    {
        return Mage::getStoreConfig(self::XML_PATH_GRID_VIEW_TYPE) ==
            Oggetto_ImproveOrderView_Model_System_Config_Source_ViewType::PREVIEW_TYPE_POPUP;
    }

    /**
     * is enabled preview in order gird
     *
     * @return bool
     */
    public function isEnableOrderGridPreview()
    {
        return (bool) Mage::getStoreConfig(self::XML_PATH_GRID_VIEW_TYPE);
    }

    /**
     * Product image
     *
     * @param int $productId product id
     * @param int $width     image width
     * @param int $height    image height
     * @return string
     */
    public function getItemProductImageSrc($productId, $width = null, $height = null)
    {
        if (!Mage::getStoreConfigFlag(self::XML_PATH_ORDER_ITEMS_IMAGES)) {
            return '';
        }
        $width  = intval($width)  ?: self::PREVIEW_IMAGE_WIDTH;
        $height = intval($height) ?: self::PREVIEW_IMAGE_HEIGHT;

        // @todo remove product loading, use product attribute
        $product = Mage::getModel('catalog/product')->load($productId);

        try {
            $src = (string) Mage::helper('catalog/image')->init($product, 'image')->resize($width, $height);
        } catch (Exception $e) {
            $src = '';
        }

        return $src;
    }

    /**
     * Product image html
     *
     * @param int $productId product id
     * @return string
     */
    public function getItemProductImage($productId)
    {

        $src = $this->getItemProductImageSrc($productId);
        if ($src) {
            return "<img src=\"{$src}\" />";
        }
        return '';
    }
}
