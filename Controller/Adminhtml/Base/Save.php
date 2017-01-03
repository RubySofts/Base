<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */		
namespace Mageaddons\Base\Controller\Adminhtml\Base;

use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Mageaddons\Base\Controller\Adminhtml\Base {
	/**
	 * @var \Magento\Framework\View\Result\PageFactory
	 */
	public function execute() {
		if ($data = $this->getRequest()->getPostValue()) {
			$model = $this->_baseFactory->create();
			
			if ($id = $this->getRequest()->getParam('base_id')) {
				$model->load($id);
			}

			/**
			 * Save image upload
			 */
			try {
				$uploader = $this->_objectManager->create(
					'Magento\MediaStorage\Model\File\Uploader',
					['fileId' => 'image']
				);
				$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);

				/** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
				$imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();

				$uploader->addValidateCallback('base_image', $imageAdapter, 'validateUploadFile');
				$uploader->setAllowRenameFiles(true);
				$uploader->setFilesDispersion(true);

				/** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
				$mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
				                       ->getDirectoryRead(DirectoryList::MEDIA);
				$result = $uploader->save($mediaDirectory->getAbsolutePath(\Mageaddons\Base\Model\Base::BASE_MEDIA_PATH));
				$data['image'] = \Mageaddons\Base\Model\Base::BASE_MEDIA_PATH . $result['file'];
			} catch (\Exception $e) {
				if ($e->getCode() == 0) {
					$this->messageManager->addError($e->getMessage());
				}
				if (isset($data['image']) && isset($data['image']['value'])) {
					if (isset($data['image']['delete'])) {
						$data['image'] = null;
						$data['delete_image'] = true;
					} else if (isset($data['image']['value'])) {
						$data['image'] = $data['image']['value'];
					} else {
						$data['image'] = null;
					}
				}
			}

			$model->setData($data);

			try {
				$model->save();

				$this->messageManager->addSuccess(__('The item has been saved.'));
				$this->_getSession()->setFormData(false);

				if ($this->getRequest()->getParam('back') === 'edit') {
					$this->_redirect(
						'*/*/edit',
						[
							'base_id' => $model->getId(),
							'_current' => true,
							'saveandclose' => $this->getRequest()->getParam('saveandclose'),
						]
					);

					return;
				} elseif ($this->getRequest()->getParam('back') === "new") {
					$this->_redirect('*/*/new', array('_current' => true));
					return;
				}
				$this->_redirect('*/*/');
				return;
			} catch (\Magento\Framework\Model\Exception $e) {
				$this->messageManager->addError($e->getMessage());
			} catch (\RuntimeException $e) {
				$this->messageManager->addError($e->getMessage());
			} catch (\Exception $e) {
				$this->messageManager->addError($e->getMessage());
				$this->messageManager->addException($e, __('Something went wrong while saving the item.'));
			}

			$this->_getSession()->setFormData($data);
			$this->_redirect('*/*/edit', array('base_id' => $this->getRequest()->getParam('base_id')));
			return;
		}
		$this->_redirect('*/*/');
	}
}
