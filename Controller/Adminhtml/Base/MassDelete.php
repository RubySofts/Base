<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */	
namespace Mageaddons\Base\Controller\Adminhtml\Base;

class MassDelete extends \Mageaddons\Base\Controller\Adminhtml\Base
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $baseIds = $this->getRequest()->getParam('base');
        if (!is_array($baseIds) || empty($baseIds)) {
            $this->messageManager->addError(__('Please select base(s).'));
        } else {
            try {
                foreach ($baseIds as $baseId) {
                    $objBase = $this->_baseFactory->create()->load($baseId);
                    $objBase->delete();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been deleted.', count($baseIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }
}
