<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */		
namespace Mageaddons\Base\Block\Adminhtml\Base\Helper\Renderer;
class Image extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer{
	/**
	 * Store manager
	 *
	 * @var \Magento\Store\Model\StoreManagerInterface
	 */
	protected $_storeManager;

	protected $_moduleFactory;

	/**
	 * Registry object
	 * @var \Magento\Framework\Registry
	 */
	protected $_coreRegistry;

	/**
	 * @param \Magento\Backend\Block\Context $context
	 * @param array $data
	 */
	public function __construct(
		\Magento\Backend\Block\Context $context,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Mageaddons\Base\Model\BaseFactory $baseFactory,
		\Magento\Framework\Registry $coreRegistry,
		array $data = []
	) {
		parent::__construct($context, $data);
		$this->_storeManager = $storeManager;
		$this->_baseFactory = $baseFactory;
		$this->_coreRegistry = $coreRegistry;
	}

	/**
	 * Render action
	 *
	 * @param \Magento\Framework\Object $row
	 * @return string
	 */
	public function render(\Magento\Framework\DataObject $row){
		$base = $this->_baseFactory->create()->load($row->getId());
		$srcImage = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $base->getImage();
		return '<image width="150" src ="' . $srcImage . '" alt="' . $base->getImage() . '" >';
	}
}
