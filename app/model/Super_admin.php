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

   

    public function restrictpublishers($user_id) {
        $this->db->query('UPDATE publishers SET status="restrict" , restriction_date = NOW() WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function restrictcustomers($user_id) {
        $this->db->query('UPDATE customers SET status="restrict" , restriction_date = NOW() WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function restrictdelivery($user_id) {
        $this->db->query('UPDATE delivery SET status="restrict" , restriction_date = NOW() WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function restrictmoderator($user_id) {
        $this->db->query('UPDATE moderator SET status="restrict" , restriction_date = NOW() WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function restrictadmin($user_id) {
        $this->db->query('UPDATE admin SET status="restrict"  , restriction_date = NOW() WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function restrictcharity($user_id) {
        $this->db->query('UPDATE charity SET status="restrict" , restriction_date = NOW() WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function restrictusers($user_id) {
        $this->db->query('UPDATE users SET status="restrict"  , restriction_date = NOW() WHERE user_id = :user_id');
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

public function getMonthlyRegisteredUserCount(){
    $this->db->query('SELECT DATE(created_at) AS registration_day, COUNT(*) AS num_users_registered
                    FROM 
                      users
                    WHERE 
                      created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)
                    GROUP BY 
                      DATE(created_at)');
    $results=$this->db->resultSet();
    return $results;
}

public function getMonthlyloginCount(){
    $this->db->query('SELECT DATE(login_time) AS login_date, COUNT(*) AS num_logins
                      FROM user_logins WHERE login_time>=DATE_SUB(CURRENT_DATE,INTERVAL 1 MONTH) GROUP BY DATE(login_time)');
    $results=$this->db->resultSet();
    return $results;
  }
  
public function getMonthlylogoutCount(){
    $this->db->query('SELECT DATE(logout_time) AS logout_date, COUNT(*) AS num_logouts
                        FROM user_logins WHERE logout_time>=DATE_SUB(CURRENT_DATE,INTERVAL 1 MONTH) GROUP BY DATE(logout_time)');
    $results=$this->db->resultSet();
    return $results;
}

public function getTotalLoggedInTime() {
    $this->db->query('SELECT DATE(login_time) AS login_date, SUM(TIME_TO_SEC(TIMEDIFF(logout_time, login_time))) / 60 AS total_logged_in_minutes FROM user_logins GROUP BY DATE(login_time)');
    $results=$this->db->resultSet();
    return $results;
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
            return true; 
        } else {
            return false; 
        }
    }
    public function getRemover(){
        $this->db->query('SELECT * FROM removed_list WHERE status="removed"');
        $results=$this->db->resultSet();
        return $results;
    }
    public function restoreusers($remove_id){
      
        $this->db->query("
        UPDATE removed_list AS rl
        INNER JOIN users AS u ON rl.user_id = u.user_id
        SET 
            rl.status = 'restored',
            u.status = 'approval'
        WHERE rl.remove_id = :removeId");
   
        $this->db->bind(':removeId', $remove_id);
        $this->db->execute();
        return true; 
    }
    public function updateUserStatus($userId, $userRole) {
        switch ($userRole) {
            case 'customer':
                $this->db->query("UPDATE customers SET status = 'approval' WHERE user_id = :userId");
                break;
            case 'publisher':
                $this->db->query("UPDATE publishers SET status = 'approval' WHERE user_id = :userId");
                break;
            case 'admin':
                $this->db->query("UPDATE admin SET status = 'approval' WHERE user_id = :userId");
                break;
            case 'moderator':
                $this->db->query("UPDATE moderator SET status = 'approval' WHERE user_id = :userId");
                break;
            case 'charity':
                $this->db->query("UPDATE charity SET status = 'approval' WHERE user_id = :userId");
                break;
            case 'delivery':
                $this->db->query("UPDATE delivery SET status = 'approval' WHERE user_id = :userId");
                break;
            default:
                // Handle unsupported or unrecognized user roles
                return false;
        }
        
        // Bind parameters and execute query
        $this->db->bind(':userId', $userId);
        if ($this->db->execute()) {
            return true; // Successful update
        } else {
            return false; // Update failed
        }
    }
    
    public function getUserRoleByRemoveId($removeId) {
        $this->db->query("
            SELECT u.user_role,u.user_id,u.email,u.name
            FROM removed_list AS rl
            INNER JOIN users AS u ON rl.user_id = u.user_id
            WHERE rl.remove_id = :removeId ");
        $this->db->bind(':removeId', $removeId);
        $results=$this->db->resultSet();
        return $results;
    }
    public function getComplaintsDetails(){
        $this->db->query(" SELECT * FROM complaint WHERE sent_to_superadmin = 1 ");
        $results=$this->db->resultSet();
        return $results;
    }

    public function updateComplaint($complaintId, $reason){
        $this->db->query('UPDATE complaint SET superadmin_comment=:reason , resolvedBy_superadmin=1 WHERE complaint_id=:complaint_id');
        $this->db->bind(':reason',$reason);
        $this->db->bind(':complaint_id',$complaintId);
        if ($this->db->execute()) {
            return true; 
        } else {
            return false; 
        }

    }
    public function getResolvedCount(){
        $this->db->query('SELECT 
        SUM(CASE WHEN resolvedBy_superadmin = 1 THEN 1 ELSE 0 END) AS resolved_count,
        SUM(CASE WHEN resolvedBy_superadmin = 0 THEN 1 ELSE 0 END) AS unresolved_count
        FROM 
            complaint;
        ');
        $results=$this->db->resultSet();
        return $results;
    }
    public function getUserCountByDate(){
        $this->db->query('SELECT DAY(created_at) AS day, COUNT(*) AS user_count
        FROM users
        WHERE MONTH(created_at) = MONTH(CURRENT_DATE())
        AND YEAR(created_at) = YEAR(CURRENT_DATE())
        GROUP BY DAY(created_at)
        ');
        $results=$this->db->resultSet();
        return $results;
    }
    public function UserLoginCountToday() {
        $today = date('Y-m-d');
        $query = "SELECT u.user_role, COUNT(DISTINCT l.user_id) AS login_count 
                  FROM user_logins l 
                  INNER JOIN users u ON l.user_id = u.user_id 
                  WHERE DATE(l.login_time) = :today 
                  GROUP BY u.user_role";
        $this->db->query($query);
        $this->db->bind(':today', $today);
    
        $results = $this->db->resultSet();
    
        return $results;
    }
    
    
  }    
