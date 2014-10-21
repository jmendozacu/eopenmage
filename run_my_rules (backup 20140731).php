<?php 
mail('khusyal@gmail.com','test cron ' , 'test message');
set_time_limit(0);  
error_reporting(0); 
require_once 'app/Mage.php';
umask(0);
Mage::app('default');

/*for ($i = 1; $i <= 9; $i++) {
    $process = Mage::getModel('index/process')->load($i);
    $process->reindexAll();
}*/
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


?>