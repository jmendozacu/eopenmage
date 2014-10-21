<?php
class Ewall_Wholesale_Model_Observer {
    protected $_rulePrices = array();
    public function processFrontFinalsPrice($observer) {
        $product = $observer->getEvent()->getProduct();
        $pId = $product->getId();
        $storeId = $product->getStoreId();
        if ($observer->hasWebsiteId()) {
            $wId = $observer->getEvent()->getWebsiteId();
        } else {
            $wId = Mage::app()->getStore($storeId)->getWebsiteId();
        }
        if ($observer->hasCustomerGroupId()) {
            $gId = $observer->getEvent()->getCustomerGroupId();
        } elseif ($product->hasCustomerGroupId()) {
            $gId = $product->getCustomerGroupId();
        } else {
            $gId = Mage::getSingleton('customer/session')->getCustomerGroupId();
        }
        $cgid = $gId . ',';
        $wholesale = Mage::getModel('wholesale/wholesale')->getCollection()->addFieldToFilter('status', 1);
        $wholesale->addFieldToFilter('customer_group_id', array('like' => '%,' . $cgid . '%', 'like' => $cgid . '%'));
        //$wholesale->getSelect()->where('customer_group_id like ?',$cgid.'%');
        //$wholesale->printlogquery(true); exit;
        foreach ($wholesale as $rule) {
            if ($rule->getWebsiteid() == Mage::app()->getStore()->getWebsiteId()) {
                if ($rule->getStoreid() == Mage::app()->getStore()->getId() || $rule->getStoreid() == 0) {
                    $arr[] = $rule->getData();
                }
            }
        }
        if (!empty($arr)) {
            $min = PHP_INT_MAX;
            foreach ($arr as $i) {
                $min = min($min, $i['priority']);
                $rule_id = $i['wholesale_id'];
            }
        }
        if (@$min && $rule_id) {
            $wholesale = Mage::getModel('wholesale/wholesale')->getCollection()->addFieldToFilter('status', 1)->addFieldToFilter('priority', $min)->addFieldToFilter('wholesale_id', $rule_id);
            foreach ($wholesale as $rule) {
                $rule_id = $rule->getId();
                $customerGroupId = $rule->getCustomerGroupId();
            }
            $customerGroupId = (array)explode(',', $customerGroupId, -1);
            if (in_array($gId, $customerGroupId)) {
                $wholesale_product = Mage::getModel('wholesale/product')->getCollection();
                $wholesale_product->addFieldToFilter('rule_id', array('eq' => $rule_id))->addFieldToFilter('product_id', array('eq' => $pId))->load();
                foreach ($wholesale_product as $prod) {
                    $product->setPrice($prod->getRulePrice());
                    $product->setFinalPrice($prod->getRulePrice());
                }
            }
        }
        return $this;
    }
    public function processListPageFinalPrice($observer) {
        $collection = $observer->getEvent()->getCollection();
        if ($observer->hasCustomerGroupId()) {
            $gId = $observer->getEvent()->getCustomerGroupId();
        } else {
            $gId = Mage::getSingleton('customer/session')->getCustomerGroupId();
        }
        $cgid = $gId . ',';
        $wholesale = Mage::getModel('wholesale/wholesale')->getCollection()->addFieldToFilter('status', 1);
        $wholesale->addFieldToFilter('customer_group_id', array('like' => '%,' . $cgid . '%', 'like' => $cgid . '%'));
        //$wholesale->addFieldToFilter('customer_group_id',array('in' => $cgid));
        //$wholesale->printLogQuery(true); exit;
        foreach ($wholesale as $rule) {
            if ($rule->getWebsiteid() == Mage::app()->getStore()->getWebsiteId()) {
                if ($rule->getStoreid() == Mage::app()->getStore()->getId() || $rule->getStoreid() == 0) {
                    $arr[] = $rule->getData();
                }
            }
        }
        if (!empty($arr)) {
            $min = PHP_INT_MAX;
            foreach ($arr as $i) {
                $min = min($min, $i['priority']);
                $rule_id = $i['wholesale_id'];
            }
        }
        if (@$min && $rule_id) {
            $wholesale = Mage::getModel('wholesale/wholesale')->getCollection()->addFieldToFilter('status', 1)->addFieldToFilter('priority', $min)->addFieldToFilter('wholesale_id', $rule_id);
            foreach ($wholesale as $rule) {
                $rule_id = $rule->getId();
                $customerGroupId = $rule->getCustomerGroupId();
            }
            $customerGroupId = (array)explode(',', $customerGroupId, -1);
            if (in_array($gId, $customerGroupId)) {
                foreach ($collection as $product) {
                    $type = $product->getData('type_id');
                    $wholesale_product = Mage::getModel('wholesale/product')->getCollection();
                    $wholesale_product->addFieldToFilter('rule_id', array('eq' => $rule_id))->addFieldToFilter('product_id', array('eq' => $product->getId()))->load();
                    foreach ($wholesale_product as $prod) {
                        $product->setPrice($prod->getRulePrice());
                        $product->setFinalPrice($prod->getRulePrice());
                    }
                    if ($type == 'grouped') {
                        $childIds = $product->getTypeInstance(true)->getChildrenIds($product->getId(), false);
                        $price_min = PHP_INT_MAX;
                        foreach ($childIds as $k => $v) {
                            foreach ($v as $k1 => $v1) {
                                $wholesale_product1 = Mage::getModel('wholesale/product')->getCollection();
                                $wholesale_product1->addFieldToFilter('rule_id', array('eq' => $rule_id))->addFieldToFilter('product_id', array('eq' => $v1))->load();
                                foreach ($wholesale_product1 as $prod1) {
                                    $price_min = min($price_min, $prod1->getRulePrice());
                                }
                            }
                        }
                        $product->setMinimalPrice($price_min);
                    }
                    if ($type == 'bundle') {
                        $childIds1 = $product->getTypeInstance(true)->getChildrenIds($product->getId(), false);
                        $price_max = 0;
                        $price_min1 = PHP_INT_MAX;
                        $price_max_final = 0;
                        foreach ($childIds1 as $k => $v) {
                            foreach ($v as $k1 => $v1) {
                                $wholesale_product1 = Mage::getModel('wholesale/product')->getCollection();
                                $wholesale_product1->addFieldToFilter('rule_id', array('eq' => $rule_id))->addFieldToFilter('product_id', array('eq' => $v1))->load();
                                foreach ($wholesale_product1 as $prod1) {
                                    $price_max = max($price_max, $prod1->getRulePrice());
                                    $price_min1 = min($price_min1, $prod1->getRulePrice());
                                }
                            }
                            $price_max_final = min($price_max_final, $price_max);
                            $price_min_final+= $price_min1;
                        }
                        $product->setMinPrice($price_min_final);
                        $product->setMaxPrice($price_max_final);
                    }
                }
            }
        }
        return $this;
    }
    public function catalogProductSaveAfter($observer) {
        $wholesale_helper = Mage::helper('wholesale/wholesale');
        $model = Mage::getSingleton('wholesale/wholesale');
        if ($model->getCollection()->count() > 0) {
            foreach ($model->getCollection() as $collection) {
                $rule_id = $collection->getId();
                $discount_amt = (int)$collection->getDiscount();
                $data = $collection->getData();
                $data['category_ids'] = unserialize($data['category_ids']);
                $data['in_featured_products'] = $data['products'];
                $wholesale_helper->generalDiscount($data, $rule_id, $discount_amt);
                $wholesale_helper->categoriesDiscount($data, $rule_id);
                $wholesale_helper->productsDiscount($data, $rule_id);
            }
        }
    }
    public function catalogProductDeleteAfter($observer) {
        $productId = $observer->getEvent()->getProduct()->getId();
        $customer_model1 = Mage::getModel('wholesale/product')->getCollection()->addFieldToFilter('product_id', array('eq' => $productId))->load();
        if ($customer_model1->count() > 0) {
            foreach ($customer_model1 as $mod) {
                $mod->delete();
            }
        }
    }
}