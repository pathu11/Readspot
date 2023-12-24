<?php 
  class Deliver{
    private $db;
    public function __construct(){
        $this->db = new Database;
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
  }