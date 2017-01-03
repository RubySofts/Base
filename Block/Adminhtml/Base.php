<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */	
namespace Mageaddons\Base\Block\Adminhtml;

class Base extends \Magento\Backend\Block\Widget\Grid\Container {
	/**
	 * Constructor
	 *
	 * @return void
	 */
	protected function _construct() {

		$this->_controller = 'adminhtml_base';
		$this->_blockGroup = 'Mageaddons_Base';
		$this->_headerText = __('Base');
		$this->_addButtonLabel = __('Add New');
		parent::_construct();
	}
}
