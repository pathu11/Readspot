<?php
class User{
   private $db;

    public function __construct(){
        $this->db=new Database;
    }

    public function getUsers(){
        $this->db->query('SELECT * FROM users');
        $results=$this->db->resultSet();

        return $results;
    }
    public function getUserDetails($user_id){
        $this->db->query('SELECT * FROM users WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
        $results=$this->db->resultSet();

        return $results;
    }
    // public function signupCustomerPending($data) {
    //     try {
    //         $this->db->beginTransaction(); // Begin the transaction
    //         $fullName = $data['first_name'] . ' ' . $data['last_name'];
    //         // Insert data into the 'users' table
    //         $this->db->query('INSERT INTO users (name,email, pass, user_role) VALUES (:name,:email, :pass, :user_role)');
    //         $this->db->bind(':name', $fullName);
    //         $this->db->bind(':email', $data['email']);
    //         $this->db->bind(':pass', $data['pass']);
    //         $this->db->bind(':user_role', 'customer');
    //         // $this->db->bind(':status', 'approval');

    //         if ($this->db->execute()) {
    //             $user_id = $this->db->lastInsertId();

    //             // Insert data into the 'customers' table using the obtained user ID as the foreign key
    //             $this->db->query('INSERT INTO customers (user_id, first_name,last_name, email, pass) VALUES (:user_id, :first_name, :last_name ,:email, :pass)');
    //             $this->db->bind(':user_id', $user_id);
    //             $this->db->bind(':first_name', $data['first_name']);
    //             $this->db->bind(':last_name', $data['last_name']);
    //             $this->db->bind(':email', $data['email']);
    //             $this->db->bind(':pass', $data['pass']);

    //             if ($this->db->execute()) {
    //                 $this->db->commit(); // Commit the transaction
    //                 return true;
    //             } else {
    //                 $this->db->rollBack(); // Roll back the transaction if 'customers' insert fails
    //             }
    //         } else {
    //             $this->db->rollBack(); // Roll back the transaction if 'users' insert fails
    //         }
    //     } catch (PDOException $e) {
    //         echo "Transaction failed: " . $e->getMessage();
    //         $this->db->rollBack(); // Roll back the transaction on exception
    //     }

    //     return false;
    // }
    public function signupCustomer($data) {
        try {
            $this->db->beginTransaction(); // Begin the transaction
            $fullName = $data['first_name'] . ' ' . $data['last_name'];
            // Insert data into the 'users' table
            $this->db->query('INSERT INTO users (name,email, pass, user_role,status) VALUES (:name,:email, :pass, :user_role,:status)');
            $this->db->bind(':name', $fullName);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':pass', $data['pass']);
            $this->db->bind(':user_role', 'customer');
            $this->db->bind(':status', 'approval');

            if ($this->db->execute()) {
                $user_id = $this->db->lastInsertId();

                // Insert data into the 'customers' table using the obtained user ID as the foreign key
                $this->db->query('INSERT INTO customers (user_id, name,first_name,last_name, email, pass,status) VALUES (:user_id,:name, :first_name, :last_name ,:email, :pass,:status)');

                $this->db->bind(':user_id', $user_id);
                $this->db->bind(':name', $fullName);
                $this->db->bind(':first_name', $data['first_name']);
                $this->db->bind(':last_name', $data['last_name']);
                $this->db->bind(':email', $data['email']);
                $this->db->bind(':pass', $data['pass']);
                $this->db->bind(':status', 'approval');
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
    // public function verifyemailCustomer($user_id) {
    //     $this->db->query("UPDATE customers SET status = 'approval' WHERE user_id = :user_id");
    //     $this->db->bind(':user_id', $user_id);
    //     if ($this->db->execute()) {
    //       return true;
    //   } else {
    //       return false;
    //   }
    // }
    // public function verifyemailUsers($user_id) {
    //     $this->db->query("UPDATE users SET status = 'approval' WHERE user_id = :user_id");
    //     $this->db->bind(':user_id', $user_id);
    //     if ($this->db->execute()) {
    //       return true;
    //   } else {
    //       return false;
    //   }
    // }
    

    public function signupPubPending($data){
        try {
            $this->db->beginTransaction(); // Begin the transaction

            // Insert data into the 'users' table
            $this->db->query('INSERT INTO users (name,email, pass, user_role) VALUES (:name,:email, :pass, :user_role)');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':pass', $data['pass']);
            $this->db->bind(':user_role', 'publisher');
            // $this->db->bind(':status', 'pending');

            if ($this->db->execute()) {
                $user_id = $this->db->lastInsertId();

                // Insert data into the 'customers' table using the obtained user ID as the foreign key
                $this->db->query('INSERT INTO publishers (user_id, name,company_name,reg_no, email,contact_no, pass) VALUES (:user_id, :name,:company_name,:reg_no, :email,:contact_no , :pass)');

                $this->db->bind(':user_id', $user_id);
                $this->db->bind(':name', $data['name']);
                $this->db->bind(':company_name', $data['company_name']);
                $this->db->bind(':reg_no', $data['reg_no']);
                $this->db->bind(':email', $data['email']);
                $this->db->bind(':contact_no', $data['contact_no']);
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

    public function signupCharityPending($data){
        try {
            $this->db->beginTransaction(); // Begin the transaction

            // Insert data into the 'users' table
            $this->db->query('INSERT INTO users (name,email, pass, user_role) VALUES (:name,:email, :pass, :user_role)');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':pass', $data['pass']);
            $this->db->bind(':user_role', 'charity');
            // $this->db->bind(':status', 'pending');

            if ($this->db->execute()) {
                $user_id = $this->db->lastInsertId();

                // Insert data into the 'customers' table using the obtained user ID as the foreign key
                $this->db->query('INSERT INTO charity (user_id, name,org_name,reg_no, email,contact_no, pass) VALUES (:user_id, :name,:org_name,:reg_no, :email,:contact_no , :pass)');

                $this->db->bind(':user_id', $user_id);
                $this->db->bind(':name', $data['name']);
                $this->db->bind(':org_name', $data['org_name']);
                $this->db->bind(':reg_no', $data['reg_no']);
                $this->db->bind(':email', $data['email']);
                $this->db->bind(':contact_no', $data['contact_no']);
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
    public function login($email, $pass)
{
    $this->db->query('SELECT * FROM users WHERE email=:email AND status = "approval"');
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    if (!$row) {
        // User not found
        return false;
    }

    $storedPassword = $row->pass;

    // Check if the stored password is hashed
    $isPasswordHashed = password_verify($pass, $storedPassword);

    if ($isPasswordHashed) {
        // Password is hashed
        return $row;
    } else {
        // Check if the password matches without hashing
        if ($pass === $storedPassword) {
            return $row;
        } else {
            // Passwords do not match
            return false;
        }
    }
}   
    //find by user email
    public function findUserByEmail($email){
        $this->db->query('SELECT * from users WHERE email=:email');
        $this->db->bind(':email',$email);

        return $this->db->resultSet();
    }
    public function findUserByRegNo($reg_no){
        $this->db->query('SELECT * from publishers WHERE reg_no=:reg_no');
        $this->db->bind(':reg_no',$reg_no);

        return $this->db->resultSet();
    }
    public function findUserByRegNoCharity($reg_no){
        $this->db->query('SELECT * from charity WHERE reg_no=:reg_no');
        $this->db->bind(':reg_no',$reg_no);

        return $this->db->resultSet();
    }
    public function findUserById($user_id){
        $this->db->query('SELECT * from users WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }
    public function findUserByToken($token){
        $this->db->query('SELECT * from users WHERE token=:token');
        $this->db->bind(':token',$token);
        return $this->db->resultSet();
    }
    // userModel.php

// public function findUserByToken($token) {
//     $this->db->query('SELECT * FROM users WHERE token = :token');
//     $this->db->bind(':token', $token);
//     $user = $this->db->single();

//     // Ensure that $user is an object
//     return (is_object($user)) ? $user : null;
// }


    public function findUserByPubId($user_id){
        $this->db->query('SELECT * from publishers WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }

    
    public function updatePassword($data) {
        $this->db->query('UPDATE users SET pass = :pass WHERE user_id = :user_id');
        $this->db->bind(':pass', $data['pass']);
        $this->db->bind(':user_id', $data['user_id']);
    
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updatePasswordPub($data) {
        $this->db->query('UPDATE publishers SET pass = :pass WHERE user_id = :user_id');
        $this->db->bind(':pass', $data['pass']);
        $this->db->bind(':user_id', $data['user_id']);
    
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updatePasswordCus($data) {
        $this->db->query('UPDATE customers SET pass = :pass WHERE user_id = :user_id');
        $this->db->bind(':pass', $data['pass']);
        $this->db->bind(':user_id', $data['user_id']);
    
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updatePasswordCharity($data) {
        $this->db->query('UPDATE charity SET pass = :pass WHERE user_id = :user_id');
        $this->db->bind(':pass', $data['pass']);
        $this->db->bind(':user_id', $data['user_id']);
    
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    
    
    public function setRememberMeToken($user_id,$token){
        $this->db->query('UPDATE users SET token = :token WHERE user_id = :user_id');
        $this->db->bind(':token', $token);
        $this->db->bind(':user_id', $user_id);
    
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function logUserLogin($userId, $loginTime) {
        $this->db->query('INSERT INTO user_logins (user_id, login_time) VALUES (:user_id, :login_time)');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':login_time', $loginTime);
        $this->db->execute();
    }
    
    public function logUserLogout($userId, $logoutTime) {
        $this->db->query('UPDATE user_logins SET logout_time = :logout_time WHERE user_id = :user_id AND logout_time IS NULL');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':logout_time', $logoutTime);
        $this->db->execute();
    }
    public function getLatestDeliveryReviews() {
        $this->db->query('SELECT dr.*,c.*  FROM delivery_reviews dr INNER JOIN  customers c WHERE dr.customer_id=c.customer_id AND rating>3 ORDER BY date DESC LIMIT 3');
        return $this->db->resultSet();
    }  

}
