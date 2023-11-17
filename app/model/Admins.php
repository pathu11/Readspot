<?php 
  class Admins{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }


    public function findAdminById($user_id){
        $this->db->query('SELECT * from admin WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }
  }