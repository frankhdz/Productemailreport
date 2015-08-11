<?php
class Frankwebdev_Productemailreport_Block_Productemailreport extends Mage_Core_Block_Template {
 
    public function _prepareLayout() {
        Mage::log('BLOCK _prepareLayout');
        return parent::_prepareLayout();
    }
 
    public function getProductemailreport() {
    	Mage::log('BLOCK getProductemailreport');
        if (!$this->hasData('productemailreport')) {
            $this->setData('productemailreport', Mage::registry('productemailreport'));
        }
        return $this->getData('productemailreport');
    }
 
}
