<?php
/**
 * Orders Export and Import
 *
 * @category:    Aitoc
 * @package:     Aitoc_Aitexporter
 * @version      1.2.5
 * @license:     pBDvWaDqhQ3DIRKbTN7HhDu4UyU8nN6XjtbHvvUFoL
 * @copyright:   Copyright (c) 2014 AITOC, Inc. (http://www.aitoc.com)
 */
class Aitoc_Aitexporter_Model_Rewrite_SalesModelMysql4OrderInvoice extends Mage_Sales_Model_Mysql4_Order_Invoice
{
	/**
	 * To save correct create and update dates.
	 * 
	 * @override
	 */
	protected function _prepareDataForSave(Mage_Core_Model_Abstract $object)
	{
		if(Mage::registry('current_import'))
		{
            if(version_compare(Mage::getVersion(), '1.6.0.0', '>=')) {
                return Mage_Core_Model_Resource_Db_Abstract::_prepareDataForSave($object);
            } else {
			    return Mage_Core_Model_Mysql4_Abstract::_prepareDataForSave($object);
            }
		}
		else
		{
			return parent::_prepareDataForSave($object);
		}
	}
}