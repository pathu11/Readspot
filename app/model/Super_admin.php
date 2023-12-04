<?php 
  class Super_admin{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
    public function findAdminById($admin_id){
        $this->db->query('SELECT * from admin WHERE admin_id=:admin_id');
        $this->db->bind(':admin_id',$admin_id);
       

        return $this->db->resultSet();
    }
    public function findModeratorById($user_id){
        $this->db->query('SELECT * from moderator WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
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
public function getPublishers(){
    $this->db->query('SELECT * FROM publishers WHERE status = "approval"');
    $results=$this->db->resultSet();

    return $results;
}
public function getCustomers(){
    $this->db->query('SELECT * FROM customers');
    $results=$this->db->resultSet();

    return $results;
}
public function getCharity(){
    $this->db->query('SELECT * FROM charity  WHERE status = "approval"');
    $results=$this->db->resultSet();

    return $results;
}
public function getDelivery(){
    $this->db->query('SELECT * FROM delivery');
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
        $this->db->query('INSERT INTO users (email, pass, user_role,status) VALUES (:email, :pass, :user_role, :status)');
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['pass']);
        $this->db->bind(':user_role', 'admin');
        $this->db->bind(':status', 'approval');

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
        $this->db->query('INSERT INTO users (email, pass, user_role,status) VALUES (:email, :pass, :user_role,:status)');
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['pass']);
        $this->db->bind(':user_role', 'moderator');
        $this->db->bind(':status', 'approval');

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

    public function addDelivery($data){
        try {
          $this->db->beginTransaction(); // Begin the transaction
  
          // Insert data into the 'users' table
          $this->db->query('INSERT INTO users (email, pass, user_role,status) VALUES (:email, :pass, :user_role, :status)');
          $this->db->bind(':email', $data['email']);
          $this->db->bind(':pass', $data['pass']);
          $this->db->bind(':user_role', 'delivery');
          $this->db->bind(':status', 'approval');
  
          if ($this->db->execute()) {
              $user_id = $this->db->lastInsertId();
  
              // Insert data into the 'customers' table using the obtained user ID as the foreign key
              $this->db->query('INSERT INTO delivery (user_id, name, email, pass) VALUES (:user_id, :name, :email, :pass)');
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

    //   delete users

    public function deleteusers($user_id) {
        $this->db->query('DELETE FROM users WHERE user_id = :user_id');
        // Bind values
        $this->db->bind(':user_id', $user_id);

        // Execute after binding
        $this->db->execute();

        // Check for row count affected
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function deletepublishers($user_id) {
        $this->db->query('DELETE FROM publishers WHERE user_id = :user_id');
        // Bind values
        $this->db->bind(':user_id', $user_id);

        // Execute after binding
        $this->db->execute();

        // Check for row count affected
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteadmins($user_id) {
        $this->db->query('DELETE FROM admin WHERE user_id = :user_id');
        // Bind values
        $this->db->bind(':user_id', $user_id);

        // Execute after binding
        $this->db->execute();

        // Check for row count affected
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function deletecustomers($user_id) {
        $this->db->query('DELETE FROM customers WHERE user_id = :user_id');
        // Bind values
        $this->db->bind(':user_id', $user_id);

        // Execute after binding
        $this->db->execute();

        // Check for row count affected
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function deletecharity($user_id) {
        $this->db->query('DELETE FROM charity WHERE user_id = :user_id');
        // Bind values
        $this->db->bind(':user_id', $user_id);

        // Execute after binding
        $this->db->execute();

        // Check for row count affected
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deletemoderators($user_id) {
        $this->db->query('DELETE FROM moderators WHERE user_id = :user_id');
        // Bind values
        $this->db->bind(':user_id', $user_id);

        // Execute after binding
        $this->db->execute();

        // Check for row count affected
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function deletedelivery($user_id) {
        $this->db->query('DELETE FROM delivery WHERE user_id = :user_id');
        // Bind values
        $this->db->bind(':user_id', $user_id);

        // Execute after binding
        $this->db->execute();

        // Check for row count affected
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updatedelivery($data) {
        $this->db->query('UPDATE delivery
                      SET name = :name, 
                      
                          email = :email,
                          pass = :pass,
                          
                      WHERE user_id = :user_id');
        // Bind values
        $this->db->bind(':user_id', $data['user_id']);
        
        $this->db->bind(':name ', $data['name ']);
        $this->db->bind(':email  ', $data['email ']);
       
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAdmin($data) {
        $this->db->query('UPDATE admin
                          SET name = :name, email = :email, pass = :pass
                          WHERE admin_id = :admin_id');
        // Bind values
        $this->db->bind(':admin_id', $data['admin_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['pass']);
    
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updateModerator($data) {
        $this->db->query('UPDATE moderator
                          SET name = :name, email = :email, pass = :pass
                          WHERE user_id = :user_id');
        // Bind values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['pass']);
    
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updateusers($data) {
        $this->db->query('UPDATE users
                          SET email = :email, pass = :pass                    
                          WHERE user_id = :user_id');
        // Bind values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['pass']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
  


  }