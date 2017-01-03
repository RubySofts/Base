<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */			
namespace Mageaddons\Base\Model\Resource\Base;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {


	protected function _construct() {
		$this->_init('Mageaddons\Base\Model\Base', 'Mageaddons\Base\Model\Resource\Base');
	}
}
