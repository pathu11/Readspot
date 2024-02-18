<?php 
  class Deliver{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
    public function findOrderById($order_id){
        $this->db->query('SELECT o.*, od.book_id, od.quantity 
                          FROM orders o 
                          INNER JOIN order_details od ON o.order_id = od.order_id 
                          WHERE o.order_id = :order_id');
        $this->db->bind(':order_id', $order_id);
        return $this->db->resultSet();
    }
    
    public function findCustomerById($customer_id){
        $this->db->query('SELECT * from customers WHERE customer_id=:customer_id');
        $this->db->bind(':customer_id',$customer_id);
        return $this->db->resultSet();
    }
    public function finddeliveryCharge(){
        $this->db->query('SELECT priceperkilo, priceperadditional FROM delivery LIMIT 1');
        $row = $this->db->single();
        return $row;
    }
    

    public function findDeliveryById($user_id){
        $this->db->query('SELECT * from delivery WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }
    public function findDeliveryByDelId($delivery_id){
      $this->db->query('SELECT * from delivery WHERE delivery_id=:delivery_id');
      $this->db->bind(':delivery_id',$delivery_id);
      $row = $this->db->single();
      return $row;
  }
    public function updatepriceAdditional($data) {
      $this->db->query('UPDATE delivery 
                SET priceperadditional = :priceperadditional 
                
                WHERE delivery_id = :delivery_id');

      // Bind values
      $this->db->bind(':delivery_id', $data['delivery_id']);
     
      $this->db->bind(':priceperadditional', $data['priceperadditional']);
     
      // Execute
      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
  }

  public function updatePricePerOne($data) {
    $this->db->query('UPDATE delivery 
              SET priceperkilo = :priceperkilo  
              
              WHERE delivery_id = :delivery_id');

    // Bind values
    $this->db->bind(':delivery_id', $data['delivery_id']);
   
    $this->db->bind(':priceperkilo', $data['priceperkilo']);
   
    // Execute
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

public function pickedUp($order_id) {
    $this->db->query('UPDATE orders
              SET status = :status  
              
              WHERE order_id = :order_id');

    // Bind values
    $this->db->bind(':order_id', $order_id);
   
    $this->db->bind(':status', 'shipping');
   
    // Execute
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

public function delivered($order_id) {
    $this->db->query('UPDATE orders
              SET status = :status  
              
              WHERE order_id = :order_id');

    // Bind values
    $this->db->bind(':order_id', $order_id);
   
    $this->db->bind(':status', 'delivered');
   
    // Execute
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}
public function returned($order_id) {
    $this->db->query('UPDATE orders
              SET status = :status  
              
              WHERE order_id = :order_id');

    // Bind values
    $this->db->bind(':order_id', $order_id);
   
    $this->db->bind(':status', 'returned');
   
    // Execute
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}
public function addMessage($data) {
    // Assuming $this->db is an instance of your database class
    $this->db->query('INSERT INTO messages (sender_id, user_id, topic,message,sender_name) VALUES (:sender_id, :user_id, :topic, :message, :sender_name)');
    $this->db->bind(':sender_id', $data['sender_id']);
    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':topic', $data['topic']);
    $this->db->bind(':message', $data['message']);
    $this->db->bind(':sender_name', $data['sender_name']);
    if($this->db->execute()){
        return true;
      }else{
        return false;
      }
}

public function findMessageByUserId($user_id){
    $this->db->query('SELECT * from messages WHERE user_id=:user_id ');
    $this->db->bind(':user_id',$user_id);
    return $this->db->resultSet();
}
public function getMessageById($message_id){
    $this->db->query('SELECT * from messages WHERE message_id=:message_id ');
    $this->db->bind(':message_id',$message_id);
    return $this->db->resultSet();
}

  }