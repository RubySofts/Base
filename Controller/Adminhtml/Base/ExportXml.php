<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */	
namespace Mageaddons\Base\Controller\Adminhtml\Base;

use Magento\Framework\App\Filesystem\DirectoryList;

class ExportXml extends \Mageaddons\Base\Controller\Adminhtml\Base {
	public function execute() {
		$fileName = 'base_data.xml';
		$content = $this->_view->getLayout()->createBlock('Mageaddons\Base\Block\Adminhtml\Base\Grid')->getXml();
		return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
	}
}
