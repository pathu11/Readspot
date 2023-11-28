<?php 
  class Orders{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }


    public function findNBrandNewBookOrdersByOrderId($order_id){
        $this->db->query('SELECT * from brandnewbookorders WHERE order_id=:order_id');
        $this->db->bind(':order_id',$order_id);
       

        return $this->db->resultSet();
    }
    public function findBrandNewBookProOrdersBypubId($publisher_id){
        $this->db->query('SELECT * from brandnewbookorders WHERE publisher_id=:publisher_id AND status="processing"');
        $this->db->bind(':publisher_id',$publisher_id);
       

        return $this->db->resultSet();
    }
    public function findBrandNewBookShippingOrdersBypubId($publisher_id){
        $this->db->query('SELECT * from brandnewbookorders WHERE publisher_id=:publisher_id AND status="shipping"');
        $this->db->bind(':publisher_id',$publisher_id);
       

        return $this->db->resultSet();
    }
    public function findBrandNewBookDeliveredOrdersBypubId($publisher_id){
        $this->db->query('SELECT * from brandnewbookorders WHERE publisher_id=:publisher_id AND status="delivered"');
        $this->db->bind(':publisher_id',$publisher_id);
       

        return $this->db->resultSet();
    }
  }