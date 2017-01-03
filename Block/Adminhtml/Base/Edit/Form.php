<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */	
namespace Mageaddons\Base\Block\Adminhtml\Base\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic {
	protected function _prepareForm() {
		/** @var \Magento\Framework\Data\Form $form */
		$form = $this->_formFactory->create(
			array(
				'data' => array(
					'id' => 'edit_form',
					'action' => $this->getUrl('*/*/save'),
					'method' => 'post',
					'enctype' => 'multipart/form-data',
				),
			)
		);
		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}
