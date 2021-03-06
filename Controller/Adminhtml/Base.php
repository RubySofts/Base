<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */	
namespace Mageaddons\Base\Controller\Adminhtml;

abstract class Base extends \Magento\Backend\App\Action {

	/**
	 * @var \Magento\Store\Model\StoreManagerInterface
	 */
	protected $_storeManager;

	/**
	 * @var \Magento\Backend\Model\View\Result\ForwardFactory
	 */
	protected $resultForwardFactory;

	/**
	 * @var \Magento\Framework\View\Result\LayoutFactory
	 */
	protected $resultLayoutFactory;

	/**
	 * A factory that knows how to create a "page" result
	 * Requires an instance of controller action in order to impose page type,
	 * which is by convention is determined from the controller action class
	 * @var \Magento\Framework\View\Result\PageFactory
	 */
	protected $resultPageFactory;

	/**
	 * Module factory
	 * @var \Mageaddons\Module\Model\ModuleFactory
	 */
	protected $_baseFactory;

	/**
	 * Registry object
	 * @var \Magento\Framework\Registry
	 */
	protected $_coreRegistry;

	/**
	 * File Factory
	 * @var \Magento\Framework\App\Response\Http\FileFactory
	 */
	protected $_fileFactory;

	/**
	 * __construct
	 * @param \Magento\Backend\App\Action\Context               $context              [description]
	 * @param \Mageaddons\Module\Model\ModuleFactory       		$moduleFactory        [description]
	 * @param \Magento\Framework\Registry                       $coreRegistry         [description]
	 * @param \Magento\Framework\App\Response\Http\FileFactory  $fileFactory          [description]
	 * @param \Magento\Framework\View\Result\PageFactory        $resultPageFactory    [description]
	 * @param \Magento\Framework\View\Result\LayoutFactory      $resultLayoutFactory  [description]
	 * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory [description]
	 * @param \Magento\Store\Model\StoreManagerInterface        $storeManager         [description]
	 */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Mageaddons\Base\Model\BaseFactory $baseFactory,
		\Magento\Framework\Registry $coreRegistry,
		\Magento\Framework\App\Response\Http\FileFactory $fileFactory,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
		\Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
		\Magento\Store\Model\StoreManagerInterface $storeManager
	) {
		parent::__construct($context);
		$this->_coreRegistry = $coreRegistry;
		$this->_baseFactory = $baseFactory;
		$this->_fileFactory = $fileFactory;
		$this->_storeManager = $storeManager;

		$this->resultPageFactory = $resultPageFactory;
		$this->resultLayoutFactory = $resultLayoutFactory;
		$this->resultForwardFactory = $resultForwardFactory;

	}

	/**
	 * Check if admin has permissions to visit related pages
	 *
	 * @return bool
	 */
	protected function _isAllowed() {
		return $this->_authorization->isAllowed('Mageaddons_Base::base');
	}
}
