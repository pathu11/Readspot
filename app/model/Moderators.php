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

    public function getChallengeDetails(){
      $this->db->query('SELECT * FROM book_challenges');
      return $this->db->resultSet();
    }

    public function getPendingEventDetails(){
      $this->db->query('SELECT * FROM events WHERE status = "Pending"');
      return $this->db->resultSet();
    }

    public function approveEvent($id){
      $this->db->query("UPDATE events SET status = 'Approved' WHERE id = :id");
      $this->db->bind(':id', $id);
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }
  
  }




?>