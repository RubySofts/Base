<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */	
namespace Mageaddons\Base\Controller\Adminhtml\Base;

class Delete extends \Mageaddons\Base\Controller\Adminhtml\Base
{
    public function execute()
    {
        $moduleId = $this->getRequest()->getParam('base_id');
        try {
            $objBase = $this->_baseFactory->create()->load($baseId);
            $objBase->delete();
            $this->messageManager->addSuccess(
                __('Delete item successfully !')
            );
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }
}
