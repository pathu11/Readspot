<?php 
  class Chat{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
    public function insertChat($data) {
        $this->db->query('INSERT INTO message (incoming_msg_id, outgoing_msg_id, msg) VALUES (:incoming_msg_id, :outgoing_msg_id, :msg)');
        $this->db->bind(':incoming_msg_id', $data['incoming_msg_id']);
        $this->db->bind(':outgoing_msg_id', $data['outgoing_msg_id']);
        $this->db->bind(':msg', $data['message']);
    
        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // public function getChat($data) {
    //     $this->db->query('SELECT * FROM message WHERE (incoming_msg_id = :incoming_msg_id AND outgoing_msg_id = :outgoing_msg_id) OR (incoming_msg_id = :outgoing_msg_id AND outgoing_msg_id = :incoming_msg_id)');
    //     $this->db->bind(':incoming_msg_id', $data['incoming_id']);
    //     $this->db->bind(':outgoing_msg_id', $data['outgoing_id']);
    
    //     // Return the result set
    //     return $this->db->resultSet();
    // }
    public function getChat($data){
        $this->db->query('SELECT * FROM message
        LEFT JOIN users ON users.user_id = message.outgoing_msg_id
        WHERE (message.outgoing_msg_id = :outgoing_msg_id AND message.incoming_msg_id = :incoming_msg_id)
        OR (message.outgoing_msg_id = :incoming_msg_id AND message.incoming_msg_id = :outgoing_msg_id)
        ORDER BY message.msg_id ASC');
        $this->db->bind(':outgoing_msg_id',$data['outgoing_msg_id']);
        $this->db->bind(':incoming_msg_id',$data['incoming_msg_id']);


        return $this->db->resultSet();
    }

    
    
  }