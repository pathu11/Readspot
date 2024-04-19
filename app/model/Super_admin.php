<?php 
  class Super_admin{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
   
 public function getuserDetails($user_id){
    $this->db->query('SELECT * from users WHERE user_id=:user_id');
    $this->db->bind(':user_id',$user_id);
    return $this->db->resultSet();
}
    public function findAdminById($user_id){
            $this->db->query('SELECT * from admin WHERE user_id=:user_id');
            $this->db->bind(':user_id',$user_id);
           
    
            return $this->db->resultSet();
        }
    public function findModeratorById($user_id){
        $this->db->query('SELECT * from moderator WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }
    public function findDeliveryById($user_id){
        $this->db->query('SELECT * from delivery WHERE user_id=:user_id');
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
        $this->db->query('INSERT INTO users (name,email, pass, user_role,status) VALUES (:name,:email, :pass, :user_role, :status)');
        $this->db->bind(':name', $data['name']);
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
        $this->db->query('INSERT INTO users (name,email, pass, user_role,status) VALUES (:name,:email, :pass, :user_role, :status)');
        $this->db->bind(':name', $data['name']);
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
          $this->db->query('INSERT INTO users (name,email, pass, user_role,status) VALUES (:name,:email, :pass, :user_role, :status)');
          $this->db->bind(':name', $data['name']);
          $this->db->bind(':email', $data['email']);
          $this->db->bind(':pass', $data['pass']);
          $this->db->bind(':user_role', 'deliver');
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
        $this->db->query('DELETE FROM moderator WHERE user_id = :user_id');
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
    public function restrictpublishers($user_id) {
        $this->db->query('UPDATE publishers SET status="restrict" WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function restrictcustomers($user_id) {
        $this->db->query('UPDATE customers SET status="restrict" WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function restrictdelivery($user_id) {
        $this->db->query('UPDATE delivery SET status="restrict" WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function restrictmoderator($user_id) {
        $this->db->query('UPDATE moderator SET status="restrict" WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function restrictadmin($user_id) {
        $this->db->query('UPDATE admin SET status="restrict" WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function restrictcharity($user_id) {
        $this->db->query('UPDATE charity SET status="restrict" WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function restrictusers($user_id) {
        $this->db->query('UPDATE users SET status="restrict" WHERE user_id = :user_id');
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
    

public function updateAdmin($data) {
    // Update users table
    $this->db->query('UPDATE users
                      SET email = :email, pass = :pass
                      WHERE user_id = :user_id');
    
    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':pass', $data['pass']);

    if ($this->db->execute()) {
        $this->db->query('UPDATE admin
                      SET name = :name, email = :email, pass = :pass
                      WHERE user_id = :user_id');
    
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['pass']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
}
public function updateModerator($data) {
    // Update users table
    $this->db->query('UPDATE users
                      SET email = :email, pass = :pass
                      WHERE user_id = :user_id');
    
    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':pass', $data['pass']);

    if (!$this->db->execute()) {
        // Log or print an error message
        error_log('Error updating users table: ' . $this->db->error());
        return false;
    }

    // Update moderator table
    $this->db->query('UPDATE moderator
                      SET name = :name, email = :email, pass = :pass
                      WHERE user_id = :user_id');
    
    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':pass', $data['pass']);

    if (!$this->db->execute()) {
        // Log or print an error message
        error_log('Error updating moderator table: ' . $this->db->error());
        return false;
    }

    // Both updates were successful
    return true;
}

public function updateDelivery($data) {
    // Update moderator table
    $this->db->query('UPDATE delivery SET name = :name, email = :email, pass = :pass WHERE user_id = :user_id');

    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':pass', $data['pass']);
    $this->db->bind(':user_id', $data['user_id']);
    try {
        $this->db->execute();
        return true;
    } catch (PDOException $e) {
        // Log or handle the error as needed
        return false;
    }
    
}
public function updateUsers($data) {
    
    // Update moderator table
    $this->db->query('UPDATE users
                      SET  email = :email, pass = :pass
                      WHERE user_id = :user_id');
    
    $this->db->bind(':user_id', $data['user_id']);
   
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':pass', $data['pass']);

    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }

}


public function countAdmins(){    
    $this->db->query('SELECT COUNT(*) as adminCount FROM admin ');
   
    $result = $this->db->single();
    if ($result) {
        return $result->adminCount;
    } else {
        return 0; 
    }
}
public function countModerators(){    
    $this->db->query('SELECT COUNT(*) as moderatorCount FROM moderator ');
   
    $result = $this->db->single();
    if ($result) {
        return $result->moderatorCount;
    } else {
        return 0; 
    }
}
    public function countDelivery(){    
        $this->db->query('SELECT COUNT(*) as deliveryCount FROM delivery ');
       
        $result = $this->db->single();
        if ($result) {
            return $result->deliveryCount;
        } else {
            return 0; 
        }
    }
    public function countCustomers(){    
        $this->db->query('SELECT COUNT(*) as customerCount FROM customers WHERE status="approval" ');
    
        $result = $this->db->single();
        if ($result) {
            return $result->customerCount;
        } else {
            return 0; 
        }
    }
    public function countPublishers(){    
        $this->db->query('SELECT COUNT(*) as PublishersCount FROM publishers WHERE status="approval" ');
        
        $result = $this->db->single();
        if ($result) {
            return $result->PublishersCount;
        } else {
            return 0; 
            }
}
public function countCharity(){    
    $this->db->query('SELECT COUNT(*) as CharityCount FROM charity WHERE status="approval" ');
    
    $result = $this->db->single();
    if ($result) {
        return $result->CharityCount;
    } else {
        return 0; 
        }
}
public function rejectUser($user_id) {
   
        $this->db->query('UPDATE users SET status = "reject" WHERE user_id = :userId');
        $this->db->bind(':userId', $user_id);
        $this->db->execute();
        if ($this->db->execute()) {
            return true; // Operation successful
        } else {
            return false; // Operation failed
        }
}
    public function rejectpublisher($user_id) {
        // Update publishers table
        $this->db->query('UPDATE publishers SET status ="reject"   WHERE user_id = :userId');
        $this->db->bind(':userId', $user_id);
        if ($this->db->execute()) {
            return true; // Operation successful
        } else {
            return false; // Operation failed
        }
    }
    public function rejectdelivery($user_id) {
        // Update delivery table
        $this->db->query('UPDATE delivery SET status = "reject"  WHERE user_id = :userId');
        $this->db->bind(':userId', $user_id);
        if ($this->db->execute()) {
            return true; // Operation successful
        } else {
            return false; // Operation failed
        }
    }
    public function rejectcustomers($user_id) {
        // Update customers table
        $this->db->query('UPDATE customers SET status = "reject" WHERE user_id = :userId');
        $this->db->bind(':userId', $user_id);
        if ($this->db->execute()) {
            return true; // Operation successful
        } else {
            return false; // Operation failed
        }
    }
    public function rejectadmin($user_id) {
        // Update admin table
        $this->db->query('UPDATE admin SET status ="reject" WHERE user_id = :userId');
        $this->db->bind(':userId', $user_id);
        if ($this->db->execute()) {
            return true; // Operation successful
        } else {
            return false; // Operation failed
        }
    }
    public function rejectmoderator($user_id) {
        // Update moderator table
        $this->db->query('UPDATE moderator SET status = "reject"  WHERE user_id = :userId');
        $this->db->bind(':userId', $user_id);
        
        if ($this->db->execute()) {
            return true; // Operation successful
        } else {
            return false; // Operation failed
        }
    }
    public function rejectcharity($user_id) {
        // Update charity table
        $this->db->query('UPDATE charity SET status ="reject"  WHERE user_id = :userId');
        $this->db->bind(':userId', $user_id);
        if ($this->db->execute()) {
            return true; // Operation successful
        } else {
            return false; // Operation failed
        }
    }
    public function insertRemove_list($user_id,$email,$name) {
        // Insert into removed_list table
        $this->db->query('INSERT INTO removed_list(user_id, name, email) VALUES (:user_id,:name,:email)');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':name', $name);
        $this->db->bind(':email', $email);
        if ($this->db->execute()) {
            return true; // Operation successful
        } else {
            return false; // Operation failed
        }
    }



  }