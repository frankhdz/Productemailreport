<?php
class Frankwebdev_Productemailreport_Block_Adminhtml_Productemailreport extends Mage_Adminhtml_Block_Widget_Grid_Container {
 
    public function __construct() {
    	Mage::log('Frankwebdev_Productemailreport_Block_Adminhtml_Productemailreport');
        $this->_controller = 'adminhtml_productemailreport';
        $this->_blockGroup = 'productemailreport';
        $this->_headerText = Mage::helper('productemailreport')->__('Product Email Report');
        //parent::__construct();
       // $this->setTemplate('productemailreport/grid.phtml');
        $this->_removeButton('add');
        
    }
 
}