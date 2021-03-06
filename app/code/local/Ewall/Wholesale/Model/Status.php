<?php

class Ewall_Wholesale_Model_Status extends Varien_Object
{
    const STATUS_ENABLED	= 1;
    const STATUS_DISABLED	= 2;

	//Status options
    static public function getOptionArray()
    {
        return array(
            self::STATUS_ENABLED    => Mage::helper('wholesale')->__('Enabled'),
            self::STATUS_DISABLED   => Mage::helper('wholesale')->__('Disabled')
        );
    }
}
