<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */	
namespace Mageaddons\Base\Model;
class Status {
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;

	/**
	 * get available statuses
	 * @return []
	 */
	public static function getAvailableStatuses() {
		return [
			self::STATUS_ENABLED => __('Enabled')
			, self::STATUS_DISABLED => __('Disabled'),
		];
	}
}
