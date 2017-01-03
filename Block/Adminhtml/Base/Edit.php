<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */		
namespace Mageaddons\Base\Block\Adminhtml\Base;

/**
 * Base block edit form container
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container {
	protected function _construct() {
		$this->_objectId = 'base_id';
		$this->_blockGroup = 'Mageaddons_Base';
		$this->_controller = 'adminhtml_base';

		parent::_construct();

		$this->buttonList->update('save', 'label', __('Save'));
		$this->buttonList->update('delete', 'label', __('Delete'));

		if (!$this->getRequest()->getParam('base_id')) {
			$this->buttonList->remove('delete');
			$this->buttonList->add(
				'save_and_continue',
				[
					'label' => __('Save and Continue Edit'),
					'class' => 'save',
					'onclick' => 'customsaveAndContinueEdit()',
				],
				10
			);


			$this->_formScripts[] = "
				require(['jquery'], function($){
					$(document).ready(function(){
						var input = $('<input class=\"custom-button-submit\" type=\"submit\" hidden=\"true\" />');
						$(edit_form).append(input);

						window.customsaveAndContinueEdit = function (){
							edit_form.action = '" . $this->getSaveAndContinueUrl() . "';
							$('.custom-button-submit').trigger('click');

				        }

			    		window.saveAndCloseWindow = function (){
			    			edit_form.action = '" . $this->getSaveAndCloseWindowUrl() . "';
							$('.custom-button-submit').trigger('click');
			            }
					});
				});
			";

			if ($moduleId = $this->getRequest()->getParam('base_id')) {
				$this->_formScripts[] = "
					window.base_id = " . $moduleId . ";
				";
			}

		} else {
			$this->buttonList->add(
				'save_and_continue',
				[
					'label' => __('Save and Continue Edit'),
					'class' => 'save',
					'data_attribute' => [
						'mage-init' => [
							'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
						],
					],
				],
				10
			);
		}

	}

	/**
	 * Add elements in layout
	 *
	 * @return $this
	 */
	protected function _prepareLayout() {

		return parent::_prepareLayout();
	}

	/**
	 * Retrieve the save and continue edit Url.
	 *
	 * @return string
	 */
	protected function getSaveAndContinueUrl(){
		return $this->getUrl(
			'*/*/save',
			[
				'_current' => true,
				'back' => 'edit',
				'tab' => '{{tab_id}}',
				'module_id' => $this->getRequest()->getParam('base_id'),
			]
		);
	}
	
	/**
	 * Retrieve the save and continue edit Url.
	 *
	 * @return string
	 */
	protected function getSaveAndCloseWindowUrl() {
		return $this->getUrl(
			'*/*/save',
			[
				'_current' => true,
				'back' => 'edit',
				'tab' => '{{tab_id}}',
				'base_id' => $this->getRequest()->getParam('base_id'),
				'saveandclose' => 1,
			]
		);
	}
}
