<?php 
  class Customer{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }


    public function findCustomerById($user_id){
        $this->db->query('SELECT * from customers WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }
  }