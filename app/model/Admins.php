<?php 
  class Admins{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    // Inside your AdminModel class
    public function getUserEmail($user_id) {
      $this->db->query('SELECT email FROM users WHERE user_id = :user_id');
      $this->db->bind(':user_id', $user_id);

      $row = $this->db->single();

      return ($row) ? $row->email : null;
    }



    public function findAdminById($user_id){
        $this->db->query('SELECT * from admin WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }

    public function getPendingPublishers() {
      $this->db->query('SELECT * FROM publishers WHERE  status = "pending"');
      $results=$this->db->resultSet();

      return $results;
  }

  public function getPendingCharity() {
    $this->db->query('SELECT * FROM charity WHERE  status = "pending"');
    $results=$this->db->resultSet();

    return $results;
}
  public function approvePub($user_id) {
    $this->db->query("UPDATE publishers SET status = 'approval' WHERE user_id = :user_id");
    $this->db->bind(':user_id', $user_id);
    if ($this->db->execute()) {
      return true;
  } else {
      return false;
  }
}

public function approveCharity($user_id) {
  $this->db->query("UPDATE charity SET status = 'approval' WHERE user_id = :user_id");
  $this->db->bind(':user_id', $user_id);
  if ($this->db->execute()) {
    return true;
} else {
    return false;
}
}

public function approveusers($user_id){
  $this->db->query("UPDATE users SET status = 'approval' WHERE user_id = :user_id");
  $this->db->bind(':user_id', $user_id);

  // Execute the query
  if ($this->db->execute()) {
      return true;
  } else {
      return false;
  }
}


  
  
  }