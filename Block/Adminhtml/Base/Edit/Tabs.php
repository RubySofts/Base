<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */		
namespace Mageaddons\Base\Block\Adminhtml\Base\Edit;

/**
 * Admin Locator left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs {
	protected function _construct() {
		parent::_construct();
		$this->setId('base_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(__('Base Information'));
	}

	protected function _prepareLayout() {
		return parent::_prepareLayout();
	}
}
