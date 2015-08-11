<?php
class Frankwebdev_Productemailreport_Block_Adminhtml_Productemailreport_Grid extends Mage_Adminhtml_Block_Report_Grid {
 
    public function __construct() {
          Mage::log('GRID CONSTRUCT');
       // parent::__construct();
        $this->setId('productemailreportgrid');
        $this->setDefaultSort('Type');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(false);
        $this->setSubReportSize(false);
    }
 
   protected function _prepareCollection() {
        Mage::log('PREPARE COLLECTION');
        parent::_prepareCollection();
       
        $this->getCollection()->initReport('productemailreport/productemailreport');

         Mage::log('GET CFILTER : '.$cfilter);
        
        /*if(isset($this->getFilter('filtersku'))){*/
            $cfilter = $this->getFilter('filtersku');
        /*}else{
            $cfilter = "";
        }*/
        if($cfilter != ''){
            Mage::log('CFILTER');
            Mage::log($cfilter);

            Mage::getSingleton('core/session')->setProductskufilter($cfilter);
        }else{
            Mage::getSingleton('core/session')->setProductskufilter('');
        }
         
        return $this;
    }
 
    protected function _prepareColumns() {
        
       

        $this->addColumn('orderid', array(
            'header'    =>Mage::helper('reports')->__('Order'),
            'align'     =>'left',
            'index'     =>'orderid',
            'total'     =>'',
            'sortable'  => true,
            'type'      =>'text'
        ));

        $this->addColumn('created', array(
            'header'    =>Mage::helper('reports')->__('Buy Date'),
            'align'     =>'left',
            'index'     =>'created',
            'total'     =>'',
            'type'      =>'datetime'
        ));

        $this->addColumn('productsku', array(
            'header'    =>Mage::helper('reports')->__('Sku'),
            'align'     =>'left',
            'index'     =>'productsku',
            'total'     =>'',
            'type'      =>'text'
        ));
        


        $this->addColumn('productname', array(
            'header'    =>Mage::helper('reports')->__('Product Name'),
            'align'     =>'left',
            'index'     =>'productname',
            'total'     =>'',
            'type'      =>'text'
        ));

        $this->addColumn('customerfname', array(
            'header'    =>Mage::helper('reports')->__('First Name'),
            'align'     =>'left',
            'index'     =>'customerfname',
            'total'     =>'',
            'type'      =>'text'
        ));
        $this->addColumn('customerlname', array(
            'header'    =>Mage::helper('reports')->__('Last Name'),
            'align'     =>'left',
            'index'     =>'customerlname',
            'total'     =>'',
            'type'      =>'text'
        ));
        $this->addColumn('customeremail', array(
            'header'    =>Mage::helper('reports')->__('Email'),
            'align'     =>'left',
            'index'     =>'customeremail',
            'total'     =>'',
            'type'      =>'text'
        ));
        $this->addColumn('orderitemqty', array(
            'header'    =>Mage::helper('reports')->__('Order Qty.'),
            'align'     =>'left',
            'index'     =>'orderitemqty',
            'total'     =>'sum',
            'type'      =>'number'
        ));
       
       

        
        $this->addExportType('*/*/exportCsv', Mage::helper('productemailreport')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('productemailreport')->__('XML'));
        return parent::_prepareColumns();
    }
 
    public function getRowUrl($row) {
        return false;
    }
 
    public function getReport($from, $to) {
        

        if ($from == '') {
            $from = $this->getFilter('report_from');
        }
        if ($to == '') {
            $to = $this->getFilter('report_to');
        }


        




        /*else{

            if(Mage::getSingleton('core/session')->setProductskufilter($cfilter)==""){
                Mage::log('UNSET');
                Mage::getSingleton('core/session')->unsProductskufilter();
            }


        }*/

        /*$totalObj = Mage::getModel('reports/totals');
        $totals = $totalObj->countTotals($this, $from, $to);
        $this->setTotals($totals);
        $this->addGrandTotals($totals);*/
        return $this->getCollection()->getReport($from, $to);
    }
    
   
}