<?php
class Magentothem_Bestsellerproduct_Block_Bestsellerproduct extends Mage_Catalog_Block_Product_Abstract
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    protected function useFlatCatalogProduct()
    {
        return Mage::getStoreConfig('catalog/frontend/flat_catalog_product');
    }    
    public function getBestsellerproduct()     
    { 
        if (!$this->hasData('bestsellerproduct')) {
            $this->setData('bestsellerproduct', Mage::registry('bestsellerproduct'));
        }
        return $this->getData('bestsellerproduct');
    }
/*     public function getProducts()
    {

        $write = Mage::getSingleton('core/resource')->getConnection('core_write');
        $read = Mage::getSingleton('core/resource')->getConnection('core_read');
        $table_prefixx = Mage::getConfig()->getTablePrefix(); 
        $res = $write->query("select max(qo) as des_qty,`product_id`,`parent_item_id` FROM (select sum(`qty_ordered`) AS qo,`product_id`,created_at,store_id,`parent_item_id` from ".$table_prefixx."sales_flat_order_item Group By `product_id`) AS t1 where parent_item_id is null Group By `product_id` order By des_qty desc"); 
        
        $ids = array();
        while ($row = $res->fetch()) 
        { 
            $ids[]=$row['product_id'];
            
        }

        $collection = Mage::getModel('catalog/product')->getCollection()
                    ->addAttributeToFilter('entity_id', array('in' => $ids))
                    ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes());
        $collection->setPageSize($this->getConfig('qty'));
        $this->setProductCollection($collection);
    } */
	public function getProducts()
    {
		$storeId    = Mage::app()->getStore()->getId();

		$collection = Mage::getResourceModel('reports/product_collection')
				->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
				->setStoreId($storeId)
				->addStoreFilter($storeId)
				->addOrderedQty()
				->setOrder('ordered_qty', 'desc');
		Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
        $collection->setPageSize($this->getConfig('qty'));
        $this->setProductCollection($collection);
    }
    public function getConfig($att) 
    {
        $config = Mage::getStoreConfig('bestsellerproduct');
        if (isset($config['bestsellerproduct_config'][$att]) ) {
            $value = $config['bestsellerproduct_config'][$att];
            return $value;
        }
    }
	
		public function cut_string4($string,$number){
			if(strlen($string) <= $number) {
				return $string;
			}
			else {	
				if(strpos($string," ",$number) > $number){
					$new_space = strpos($string," ",$number);
					$new_string = substr($string,0,$new_space)."..";
					return $new_string;
				}
				$new_string = substr($string,0,$number)."..";
				return $new_string;
			}
		}
}