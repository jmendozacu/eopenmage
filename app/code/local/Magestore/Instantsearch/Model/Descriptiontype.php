<?php
class Magestore_Instantsearch_Model_Descriptiontype{	
	public function toOptionArray() {		
		return array(			
			array('value'=>1, 'label'=>Mage::helper('instantsearch')->__('Search by Short Description')),			
			array('value'=>2, 'label'=>Mage::helper('instantsearch')->__('Search by Full Description')),			
			array('value'=>3, 'label'=>Mage::helper('instantsearch')->__('Search in Both')),		
		);		
	}
}