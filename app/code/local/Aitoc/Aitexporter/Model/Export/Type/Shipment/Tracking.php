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
class Aitoc_Aitexporter_Model_Export_Type_Shipment_Tracking implements Aitoc_Aitexporter_Model_Export_Type_Interface
{
    /**
     * 
     * @param SimpleXMLElement $shipmentXml
     * @param Mage_Sales_Model_Order_Shipment $shipment
     * @param Varien_Object $exportConfig
     */
    public function prepareXml(SimpleXMLElement $shipmentXml, Mage_Core_Model_Abstract $shipment, Varien_Object $exportConfig)
    {
        /* @var $shipment Mage_Sales_Model_Order_Shipment */

        $shipmentTrackingsXml = $shipmentXml->addChild('trackings');

        foreach ($shipment->getTracksCollection() as $shipmentTracking)
        {
            $shipmentTrackingXml = $shipmentTrackingsXml->addChild('tracking');
            
            foreach($shipmentTracking->getData() as $field => $value)
            {
                $shipmentTrackingXml->addChild($field, (string)$value);
            }
            
            if($shipmentTracking->hasData('number') && !$shipmentTracking->hasData('track_number'))
            {
                $shipmentTrackingXml->addChild('track_number', (string)$shipmentTracking->getData('number'));
            }
        }
    }
}