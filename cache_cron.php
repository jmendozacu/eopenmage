<?php
require_once 'app/Mage.php';

Mage::app();
try {
	$allTypes = Mage::app()->useCache();
	foreach($allTypes as $type => $blah) {
		Mage::app()->getCacheInstance()->cleanType($type);
	}
} catch (Exception $e) {
	echo 'error';
}