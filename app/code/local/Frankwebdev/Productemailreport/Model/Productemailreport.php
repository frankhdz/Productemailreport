<?php
class Frankwebdev_Productemailreport_Model_Productemailreport extends Mage_Reports_Model_Mysql4_Order_Collection
{
    protected $_from = '';
    protected $_to = '';
    
    function __construct() {
        Mage::log('CONSTRUCT');
        parent::__construct();
        $this->setResourceModel('sales/order');
        $this->_init('sales/order','entity_id');
    }

    public function setDateRange($from, $to){
       Mage::log('SET DATE RANGE');
       $this->_from = $from;
       $this->_to = $to;
       $this->_reset();
       return $this;
   }

        

    public function joinFields($from, $to, $storeIds = array()){
    
         #$this->populate_tmp($from, $to);
        #$this->_reset();
        if (count($storeIds)==1){
            $store_id = $storeIds[0];
            $where_store = ' AND (orders.store_id = '.$store_id.')';
        }else{
            $where_store = '';
        }

        
        


       // Mage::log("GET SESSION FILTER FROM FORM");
        
       // Mage::log("FILTER VAL : ".$this->getFilter('filtersku'));
        $searchesku = Mage::getSingleton('core/session')->getProductskufilter();//Mage::getSingleton('core/session')->getProductskufilter();
        
       // Mage::log($searchesku);
       // Mage::log("/GET SESSION FILTER FROM FORM");
        
        //search for sku(s) if set
        //$searchesku = 'L1056-9 Pomiferra 7';
        $skusearchterm = '';
        if($searchesku!==''){
            //generate search
            //split string

            $searchesku = str_replace(", ", ",", $searchesku);
            $searchesku = str_replace(" ,", ",", $searchesku);

            $csString = explode(",",$searchesku);
            $searchString = '';
            foreach($csString as $csVal){
                $searchString .= "'".$csVal."',";
            }
            Mage::log($searchString);
            $searchString = substr($searchString, 0, -1);



            $skusearchterm = " AND (salesitem.sku IN(".$searchString.") ) ";


        }

       
        #Mage::log('storeids: '.  print_r($storeIds, TRUE));
        $this->getSelect()->reset()
        ->from(

               

                array('orders' => $this->getTable('sales/order')),
                array(
                        'orderid' => 'orders.increment_id',
                        'customerfname' => 'orders.customer_firstname',
                        'customerlname' => 'orders.customer_lastname',
                        'customeremail' => 'orders.customer_email',
                        'productsku' => 'salesitem.sku',
                        'orderitemqty' => 'salesitem.qty_invoiced',
                        'created' => 'salesitem.created_at',
                        'productname' => 'salesitem.name',
                       // 'storename' => 'orders.store_name'
                        
                ))
                ->joinInner(array(
                 'salesitem' => 'sales_flat_order_item'),
                 'salesitem.order_id = orders.entity_id'
                 )
                 ->where('((orders.created_at>="'.$from.'") And (orders.created_at <="'.$to.'")) AND (orders.status != "canceled") '.$skusearchterm.$where_store)
                        ->group('salesitem.created_at')
                        ;
        // uncomment next line to get the query log:
        Mage::log('SKU EMAIL SQL: '.$this->getSelect()->__toString());
        return $this;
    }

    public function setStoreIds($storeIds)
    {
       Mage::log('SET STORE IDS');
       if ($storeIds)
        $this->joinFields($this->_from, $this->_to, $storeIds); 
    else
        $this->joinFields($this->_from, $this->_to);
    return $this;
    }

}
?>