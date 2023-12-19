<?php
  class Moderators{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function findModeratorById($user_id){
      $this->db->query('SELECT * from moderator WHERE user_id=:user_id');
      $this->db->bind(':user_id',$user_id);
     

      return $this->db->resultSet();
    }
  
  }




?>