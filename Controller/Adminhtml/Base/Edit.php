<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */	
namespace Mageaddons\Base\Controller\Adminhtml\Base;

class Edit extends \Mageaddons\Base\Controller\Adminhtml\Base {
	/**
	 * @var \Magento\Framework\View\Result\PageFactory
	 */
	public function execute() {

		$id = $this->getRequest()->getParam('base_id');
		$model = $this->_baseFactory->create();

		if ($id) {
			$model->load($id);
			if (!$model->getId()) {
				$this->messageManager->addError(__('This item no longer exists.'));
				$this->_redirect('*/*/');
				return;
			}
		}

		$data = $this->_getSession()->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		$this->_coreRegistry->register('base', $model);
		$this->_view->loadLayout();
		$this->_view->getLayout()->initMessages();
		$this->_view->renderLayout();
	}
}
