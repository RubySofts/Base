<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */				
namespace Mageaddons\Base\Model;

class Base extends \Magento\Framework\Model\AbstractModel {
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const BASE_MEDIA_PATH = 'mageaddons/base/images';

	protected $_moduleFactory;


	protected $_formFieldHtmlIdPrefix = 'page_';


	public function __construct(
		\Magento\Framework\Model\Context $context,
		\Magento\Framework\Registry $registry,
		\Mageaddons\Base\Model\Resource\Base $resource,
		\Mageaddons\Base\Model\Resource\Base\Collection $resourceCollection,
		\Mageaddons\Base\Model\BaseFactory $baseFactory
	) {
		parent::__construct(
			$context,
			$registry,
			$resource,
			$resourceCollection
		);
		$this->_baseFactory = $baseFactory;


	}

	public function getFormFieldHtmlIdPrefix() {
		return $this->_formFieldHtmlIdPrefix;
	}



	public function beforeSave() {

		return parent::beforeSave();
	}

	public function afterSave() {
		return parent::afterSave();
	}

	public function getAvailableStatuses() {
		return array(self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled'));
	}
}
