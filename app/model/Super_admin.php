<?php 
  class Super_admin{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function getAdmins(){
      $this->db->query('SELECT * FROM admin');
      $results=$this->db->resultSet();

      return $results;
  }
  public function getModerator(){
    $this->db->query('SELECT * FROM moderator');
    $results=$this->db->resultSet();

    return $results;
}




    public function findSuperAdminById($user_id){
        $this->db->query('SELECT * from superadmin WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }

    public function addAdmin($data){
      try {
        $this->db->beginTransaction(); // Begin the transaction

        // Insert data into the 'users' table
        $this->db->query('INSERT INTO users (email, pass, user_role) VALUES (:email, :pass, :user_role)');
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['pass']);
        $this->db->bind(':user_role', 'admin');

        if ($this->db->execute()) {
            $user_id = $this->db->lastInsertId();

            // Insert data into the 'customers' table using the obtained user ID as the foreign key
            $this->db->query('INSERT INTO admin (user_id, name, email, pass) VALUES (:user_id, :name, :email, :pass)');
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':pass', $data['pass']);

            if ($this->db->execute()) {
                $this->db->commit(); // Commit the transaction
                return true;
            } else {
                $this->db->rollBack(); // Roll back the transaction if 'customers' insert fails
            }
        } else {
            $this->db->rollBack(); // Roll back the transaction if 'users' insert fails
        }
    } catch (PDOException $e) {
        echo "Transaction failed: " . $e->getMessage();
        $this->db->rollBack(); // Roll back the transaction on exception
    }

    return false;

    }

    public function addModerator($data){
      try {
        $this->db->beginTransaction(); // Begin the transaction

        // Insert data into the 'users' table
        $this->db->query('INSERT INTO users (email, pass, user_role) VALUES (:email, :pass, :user_role)');
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['pass']);
        $this->db->bind(':user_role', 'moderator');

        if ($this->db->execute()) {
            $user_id = $this->db->lastInsertId();

            // Insert data into the 'customers' table using the obtained user ID as the foreign key
            $this->db->query('INSERT INTO moderator (user_id, name, email, pass) VALUES (:user_id, :name, :email, :pass)');
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':pass', $data['pass']);

            if ($this->db->execute()) {
                $this->db->commit(); // Commit the transaction
                return true;
            } else {
                $this->db->rollBack(); // Roll back the transaction if 'customers' insert fails
            }
        } else {
            $this->db->rollBack(); // Roll back the transaction if 'users' insert fails
        }
    } catch (PDOException $e) {
        echo "Transaction failed: " . $e->getMessage();
        $this->db->rollBack(); // Roll back the transaction on exception
    }

    return false;

    }


  }