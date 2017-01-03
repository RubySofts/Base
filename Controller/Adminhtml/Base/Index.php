<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */	
namespace Mageaddons\Base\Controller\Adminhtml\Base;

class Index extends \Mageaddons\Base\Controller\Adminhtml\Base
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        if ($this->getRequest()->getQuery('ajax')) {
            $resultForward = $this->resultForwardFactory->create();
            $resultForward->forward('grid');
            return $resultForward;
        }

        $resultPage = $this->resultPageFactory->create();

        /**
         * Add breadcrumb item
         */
        $this->_addBreadcrumb(__('Base'), __('Bases'));
        $this->_addBreadcrumb(__('Manage Bases'), __('Manage Base'));

        return $resultPage;
    }
}
