<?php 
  class Deliver{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }


    public function findDeliveryById($user_id){
        $this->db->query('SELECT * from delivery WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }
  }