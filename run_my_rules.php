<?php
// Change current directory to the directory of current script
//chdir(dirname(__FILE__));

require 'app/Mage.php';

if (!Mage::isInstalled()) {
    echo "Application is not installed yet, please complete install wizard first.";
    exit;
}

// Only for urls
// Don't remove this
//$_SERVER['SCRIPT_NAME'] = str_replace(basename(__FILE__), 'index.php', $_SERVER['SCRIPT_NAME']);
//$_SERVER['SCRIPT_FILENAME'] = str_replace(basename(__FILE__), 'index.php', $_SERVER['SCRIPT_FILENAME']);

Mage::app('admin')->setUseSessionInUrl(false);

umask(0);

try {
	/** @var $resource Mage_CatalogRule_Model_Resource_Rule */
    $resource = Mage::getResourceSingleton('catalogrule/rule');
    $resource->applyAllRules();
} catch (Exception $e) {
    Mage::printException($e);
    exit(1);
}

/*
 
mail('khusyal@gmail.com','test cron ' , 'test message');
set_time_limit(0);  
error_reporting(0); 
require_once 'app/Mage.php';
umask(0);
Mage::app('default');

for ($i = 1; $i <= 9; $i++) {
    $process = Mage::getModel('index/process')->load($i);
    $process->reindexAll();
}
$indexingProcesses = Mage::getSingleton('index/indexer')->getProcessesCollection(); 
foreach ($indexingProcesses as $process) {
      $process->reindexEverything();
}
Mage::app()->cleanCache();

function dailyCatalogUpdate()
{
    Mage::getModel('catalogrule/rule')->getResourceCollection()
                  ->walk(array(
                         Mage::getResourceSingleton('catalogrule/rule'),
                         'updateRuleProductData'
                  ));
    Mage::getResourceSingleton('catalogrule/rule')->applyAllRulesForDateRange();

   // return $this;
}
dailyCatalogUpdate();

$indexingProcesses = Mage::getSingleton('index/indexer')->getProcessesCollection(); 
foreach ($indexingProcesses as $process) {
      $process->reindexEverything();
}

Mage::app()->getCacheInstance()->flush();
Mage::app()->cleanCache();
*/

?>