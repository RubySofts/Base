<?php
/**
 * @author Magento Addons Team
 * @copyright Copyright (c) 2015 Magento Addons (https://www.magentoaddons.com)
 * @package Mageaddons_Base
 */			
namespace Mageaddons\Base\Model\Resource;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Base extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('mageaddons_base', 'base_id');
    }
}
