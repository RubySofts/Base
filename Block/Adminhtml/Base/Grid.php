<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */
namespace Mageaddons\Base\Block\Adminhtml\Base;

use Mageaddons\Base\Model\Status;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended {
	/**
	 * Base factory
	 * @var \Mageaddons\Base\Model\BaseFactory
	 */
	protected $_baseFactory;

	/**
	 * Registry object
	 * @var \Magento\Framework\Registry
	 */
	protected $_coreRegistry;

	/**
	 * [__construct description]
	 * @param \Magento\Backend\Block\Template\Context     $context       [description]
	 * @param \Magento\Backend\Helper\Data                $backendHelper [description]
	 * @param \Mageaddons\Base\Model\BaseFactory 	  $baseFactory [description]
	 * @param \Magento\Framework\Registry                 $coreRegistry  [description]
	 * @param array                                       $data          [description]
	 */
	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		\Magento\Backend\Helper\Data $backendHelper,
		\Mageaddons\Base\Model\BaseFactory $baseFactory,
		\Magento\Framework\Registry $coreRegistry,
		array $data = []
	) {
		$this->_baseFactory = $baseFactory;
		$this->_coreRegistry = $coreRegistry;
		parent::__construct($context, $backendHelper, $data);
	}

	protected function _construct() {
		parent::_construct();
		$this->setId('baseGrid');
		$this->setDefaultSort('base_id');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
		$this->setUseAjax(true);
	}

	protected function _prepareCollection() {
	
		$collection = $this->_baseFactory->create()->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	/**
	 * @return $this
	 */
	protected function _prepareColumns() {
		$this->addColumn(
			'base_id',
			[
				'header' => __('ID'),
				'type' => 'number',
				'index' => 'base_id',
				'header_css_class' => 'col-id',
				'column_css_class' => 'col-id',
				'width' => '50px',
			]
		);
		
		$this->addColumn(
			'image',
			[
				'header' => __('Image'),
				'index' => 'image',
				'filter' => false,
				'renderer' => 'Mageaddons\Base\Block\Adminhtml\Base\Helper\Renderer\Image',
			]
		);
		
		$this->addColumn(
			'title',
			[
				'header' => __('Title'),
				'index' => 'title',
				'class' => 'xxx',
			]
		);
		

		


		$this->addColumn(
			'status',
			[
				'header' => __('Status'),
				'index' => 'status',
				'type' => 'options',
				'options' => Status::getAvailableStatuses(),
			]
		);
		$this->addColumn(
			'edit',
			[
				'header' => __('Edit'),
				'type' => 'action',
				'getter' => 'getId',
				'actions' => [
					[
						'caption' => __('Edit'),
						'url' => ['base' => '*/*/edit'],
						'field' => 'base_id',
					],
				],
				'filter' => false,
				'sortable' => false,
				'index' => 'stores',
				'header_css_class' => 'col-action',
				'column_css_class' => 'col-action',
			]
		);
		$this->addExportType('*/*/exportCsv', __('CSV'));
		$this->addExportType('*/*/exportXml', __('XML'));
		$this->addExportType('*/*/exportExcel', __('Excel'));

		return parent::_prepareColumns();
	}

	/**
	 * @return $this
	 */
	protected function _prepareMassaction() {
		$this->setMassactionIdField('entity_id');
		$this->getMassactionBlock()->setFormFieldName('base');

		$this->getMassactionBlock()->addItem(
			'delete',
			[
				'label' => __('Delete'),
				'url' => $this->getUrl('*/*/massDelete'),
				'confirm' => __('Are you sure want to delete this item?'),
			]
		);

		$statuses = Status::getAvailableStatuses();

		array_unshift($statuses, ['label' => '', 'value' => '']);
		$this->getMassactionBlock()->addItem(
			'status',
			[
				'label' => __('Change status'),
				'url' => $this->getUrl('*/*/massStatus', ['_current' => true]),
				'additional' => [
					'visibility' => [
						'name' => 'status',
						'type' => 'select',
						'class' => 'required-entry',
						'label' => __('Status'),
						'values' => $statuses,
					],
				],
			]
		);
		return $this;
	}

	/**
	 * @return string
	 */
	public function getGridUrl() {
		return $this->getUrl('*/*/grid', ['_current' => true]);
	}
	public function getRowUrl($row) {
		return $this->getUrl(
			'*/*/edit',
			['base_id' => $row->getId()]
		);
	}
}
