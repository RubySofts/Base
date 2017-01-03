<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */	
namespace Mageaddons\Base\Controller\Adminhtml\Base;

class NewAction extends \Mageaddons\Base\Controller\Adminhtml\Base
{
    public function execute()
    {
        $this->_forward('edit');
    }
}
