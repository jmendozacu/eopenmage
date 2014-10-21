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
class Aitoc_Aitexporter_Block_Widget_Grid_massaction extends Mage_Adminhtml_Block_Widget_Grid_Massaction_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('aitexporter/13/massaction.phtml');
        $this->setErrorText(Mage::helper('catalog')->jsQuoteEscape(Mage::helper('catalog')->__('Please select  items')));
    }
}