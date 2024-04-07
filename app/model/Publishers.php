<?php 
class Publishers{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
    public function findStoreById($store_id){
        $this->db->query('SELECT * FROM publisher_stores WHERE store_id=:store_id');
        $this->db->bind(':store_id', $store_id);
        return $this->db->resultSet();
    }
    
    
    public function findPublisherById($user_id){
        $this->db->query('SELECT * from publishers WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }
    public function findcustomerBycusId($customer_id){
        $this->db->query('SELECT * from customers WHERE customer_id=:customer_id');
        $this->db->bind(':customer_id',$customer_id);
       
        $row = $this->db->single();
        return $row;
    }
    public function findPublisherBypubId($publisher_id){
        $this->db->query('SELECT * from publishers WHERE publisher_id=:publisher_id ');
        $this->db->bind(':publisher_id',$publisher_id);
        $row = $this->db->single();
        return $row;
    }
    
    public function findBookById($book_id){
        $this->db->query('SELECT * FROM books WHERE book_id = :book_id AND type="new"');
        $this->db->bind(':book_id', $book_id);
        $row = $this->db->single();
        return $row;
    }
   
    public function findNewBooks(){
        $this->db->query('SELECT * FROM books WHERE status ="approval" AND type="new"');
        $rows = $this->db->resultSet(); // Fetch multiple rows as an array of associative arrays
        return $rows;
    }
    


    public function findBookByPubId($publisher_id){
        $this->db->query('SELECT * from books WHERE publisher_id=:publisher_id AND type="new" AND status="approval"');
        $this->db->bind(':publisher_id',$publisher_id);
       

        return $this->db->resultSet();
    }
    public function getPublisherStoreDetails($publisher_id){
        $this->db->query('SELECT * from publisher_stores WHERE publisher_id=:publisher_id ');
        $this->db->bind(':publisher_id',$publisher_id);
        return $this->db->resultSet();
    }
    
    public function AddBookApproval($data) {
        $this->db->query('UPDATE books 
                          SET 
                          status = :status
                          WHERE publisher_id = :publisher_id');
    
        // Bind values
        $this->db->bind(':status', "approval");
        $this->db->bind(':publisher_id', $data['publisher_id']); // Assuming publisher_id is in the $data array
    
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }    
    public function editpostal($data) {
        $this->db->query('UPDATE publishers 
                  SET postal_name = :postal_name, 
                  street_name = :street_name, 
                  town = :town,  
                  district = :district, 
                  postal_code = :postal_code
                  WHERE publisher_id = :publisher_id');

        // Bind values
        $this->db->bind(':publisher_id', $data['publisher_id']);
        $this->db->bind(':postal_name', $data['postal_name']);
        $this->db->bind(':street_name', $data['street_name']);
        
        $this->db->bind(':town', $data['town']);
        $this->db->bind(':district', $data['district']);
        $this->db->bind(':postal_code', $data['postal_code']);
       
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }  
    public function getLastInsertedBookId() {
        $this->db->query('SELECT LAST_INSERT_ID() as book_id');
        $row = $this->db->single();
        return $row->book_id;
    }
    public function editpostalInBooks($data) {
        $this->db->query('UPDATE books
                  SET postal_name = :postal_name, 
                  street_name = :street_name, 
                  town = :town,  
                  district = :district, 
                  postal_code = :postal_code
                  WHERE book_id = :book_id');

        // Bind values
        $this->db->bind(':book_id', $data['book_id']);
        $this->db->bind(':postal_name', $data['postal_name']);
        $this->db->bind(':street_name', $data['street_name']);
        
        $this->db->bind(':town', $data['town']);
        $this->db->bind(':district', $data['district']);
        $this->db->bind(':postal_code', $data['postal_code']);
       
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    } 
    public function editProfile($data) {
        $this->db->query('UPDATE publishers 
                          SET name = :name, 
                              contact_no = :contact_no, 
                              profile_img = :profile_img
                          WHERE publisher_id = :publisher_id');
    
        // Bind values
        $this->db->bind(':publisher_id', $data['publisher_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':profile_img', $data['profile_img']);
       
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function editAccount($data) {
        $this->db->query('UPDATE publishers 
                  SET account_name = :account_name, 
                  account_no = :account_no, 
                  bank_name = :bank_name,  
                  branch_name = :branch_name 
                 
                  WHERE publisher_id = :publisher_id');

        // Bind values
        $this->db->bind(':publisher_id', $data['publisher_id']);
        $this->db->bind(':account_name', $data['account_name']);
        $this->db->bind(':account_no', $data['account_no']);
        
        $this->db->bind(':bank_name', $data['bank_name']);
        $this->db->bind(':branch_name', $data['branch_name']);
       
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    
    public function editAccountInBooks($data) {
        $this->db->query('UPDATE books
                  SET account_name = :account_name, 
                  account_no = :account_no, 
                  bank_name = :bank_name,  
                  branch_name = :branch_name 
                  WHERE book_id = :book_id');
        // Bind values
        $this->db->bind(':book_id', $data['book_id']);
        $this->db->bind(':account_name', $data['account_name']);
        $this->db->bind(':account_no', $data['account_no']);
        
        $this->db->bind(':bank_name', $data['bank_name']);
        $this->db->bind(':branch_name', $data['branch_name']);  
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function addBooks($data){
        $this->db->query('INSERT INTO books (book_name, ISBN_no, author, price, category, weight, descript, quantity, img1, img2, publisher_id,type) VALUES(:book_name, :ISBN_no, :author, :price, :category, :weight, :descript, :quantity, :img1, :img2, :publisher_id,:type)');
        $this->db->bind(':book_name',$data['book_name']);
        $this->db->bind(':ISBN_no',$data['ISBN_no']);
        $this->db->bind(':author',$data['author']);
        $this->db->bind(':price',$data['price']);
        $this->db->bind(':category',$data['category']);
        $this->db->bind(':weight',$data['weight']);
        $this->db->bind(':descript',$data['descript']);
        $this->db->bind(':quantity',$data['quantity']);
        $this->db->bind(':img1',$data['img1']);
        $this->db->bind(':img2',$data['img2']);
        $this->db->bind(':publisher_id',$data['publisher_id']);
        $this->db->bind(':type',"new");
        // $this->db->bind(':status','approval');
        // execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }        
    }

    public function update($data) {
        if (!empty($data['img1'])) {
            // Update img1 column
            $this->db->query('UPDATE books SET img1 = :img1 WHERE book_id = :book_id');
            $this->db->bind(':book_id', $data['book_id']);
            $this->db->bind(':img1', $data['img1']);
            $this->db->execute();
        }
    
        // Check if new img2 is uploaded
        if (!empty($data['img2'])) {
            // Update img2 column
            $this->db->query('UPDATE books SET img2 = :img2 WHERE book_id = :book_id');
            $this->db->bind(':book_id', $data['book_id']);
            $this->db->bind(':img2', $data['img2']);
            $this->db->execute();
        }
    
        $this->db->query('UPDATE books 
                  SET book_name = :book_name, 
                  ISBN_no = :ISBN_no, 
                  author = :author,  
                  price = :price, 
                  category = :category,
                  weight = :weight,
                  descript = :descript,
                  quantity = :quantity,
                  img1 = :img1,
                  img2 = :img2
                  WHERE book_id = :book_id');

        // Bind values
        $this->db->bind(':book_id', $data['book_id']);
        $this->db->bind(':book_name', $data['book_name']);
        $this->db->bind(':ISBN_no', $data['ISBN_no']);
        $this->db->bind(':author', $data['author']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':weight', $data['weight']);
        $this->db->bind(':descript', $data['descript']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':img1', $data['img1']);
        $this->db->bind(':img2', $data['img2']);
        // $this->db->bind(':publisher_id', $data['publisher_id']);
    
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deletebooks($book_id) {
        $this->db->query('DELETE FROM books WHERE book_id = :book_id');
        // Bind values
        $this->db->bind(':book_id', $book_id);

        // Execute after binding
        $this->db->execute();

        // Check for row count affected
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }   
    public function findbookByName($book_name,$publisher_id){
        $this->db->query('SELECT * from books WHERE book_name=:book_name AND type="new" AND status="approval" AND publisher_id=:publisher_id ');
        $this->db->bind(':book_name',$book_name);
        $this->db->bind(':publisher_id',$publisher_id);
        $row=$this->db->single();
        if($this->db->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }
    public function countBooks($publisher_id){    
        $this->db->query('SELECT COUNT(*) as bookCount FROM books WHERE publisher_id = :publisher_id AND type="new"');
        $this->db->bind(':publisher_id', $publisher_id);
        $result = $this->db->single();
        if ($result) {
            return $result->bookCount;
        } else {
            return 0; 
        }
    }


    public function getPublisherEventDetails($user_id){
        $this->db->query('SELECT * FROM events WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);

        return $this->db->resultSet();
    }

    public function addEvent($data){
        $this->db->query('INSERT INTO events (user_id,user_type,title, description, location,start_date , end_date, category_name,poster) VALUES(:user_id,:user_type,:title, :description, :location, :start_date , :end_date, :category, :poster)');
        $this->db->bind(':user_type',$data['user_type']);
        $this->db->bind(':user_id',$data['user_id']);
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':description',$data['description']);
        $this->db->bind(':location',$data['location']);
        $this->db->bind(':start_date',$data['start_date']);
        $this->db->bind(':end_date',$data['end_date']);
        $this->db->bind(':category',$data['category']);
        $this->db->bind(':poster',$data['poster']);
        // execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        } 
    }

    public function addStore($data){
        $this->db->query('INSERT INTO  publisher_stores  (postal_name,street_name,town,district,postal_code,publisher_id) VALUES( :postal_name, :street_name, :town, :district, :postal_code, :publisher_id)');
        
        $this->db->bind(':postal_name', $data['postal_name']);
        $this->db->bind(':street_name', $data['street_name']);
        $this->db->bind(':town', $data['town']);
        $this->db->bind(':district', $data['district']);
        $this->db->bind(':postal_code', $data['postal_code']);
        $this->db->bind(':publisher_id', $data['publisher_id']);
        // execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        } 
    }
    public function findMessageByUserId($user_id){
        $this->db->query('SELECT * FROM messages WHERE user_id = :user_id ORDER BY timestamp DESC');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }
    
    public function getMessageById($message_id){
        $this->db->query('SELECT * from messages WHERE message_id=:message_id ');
        $this->db->bind(':message_id',$message_id);
        return $this->db->resultSet();
    }
    public function addMessage($data) {
        // Assuming $this->db is an instance of your database class
        $this->db->query('INSERT INTO messages (sender_id,parent_id, user_id, topic,message,sender_name) VALUES (:sender_id, :parent_id, :user_id, :topic, :message, :sender_name)');
        $this->db->bind(':sender_id', $data['sender_id']);
        $this->db->bind(':parent_id', $data['parent_id']);
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
    
    public function changeStatus($message_id) {
        $this->db->query('UPDATE messages 
                          SET status = :status
                          WHERE message_id = :message_id');
    

        // Bind values
        $this->db->bind(':message_id', $message_id);
        $this->db->bind(':status', 'read');
       
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            echo $this->db->error();
            return false;
        }
    }
    

    public function markSelectedAsRead($userId) {
        // Update the status of all messages to 'read' for the specific user (publisher)
        $this->db->query("UPDATE messages SET status = 'read' WHERE user_id = :user_id");
        
        // Bind values
        $this->db->bind(':user_id', $userId);

        // Execute the query
        return $this->db->execute();
    }

    public function getUnreadMessagesCount($userId) {
        $this->db->query('SELECT COUNT(*) AS unreadCount FROM messages WHERE user_id = :user_id AND status = "unread"');
        $this->db->bind(':user_id', $userId);
        $result = $this->db->single();
        if ($result) {
            return $result->unreadCount;
        } else {
            return 0; 
        }
    }
    public function updateStore($data) {
        $this->db->query('UPDATE publisher_stores 
                          SET publisher_id = :publisher_id,
                             
                              postal_name = :postal_name, 
                              street_name = :street_name, 
                              town = :town,  
                              district = :district, 
                              postal_code = :postal_code
                          WHERE store_id = :store_id');
        // Bind values
        $this->db->bind(':publisher_id', $data['publisher_id']);
       
        $this->db->bind(':postal_name', $data['postal_name']);
        $this->db->bind(':street_name', $data['street_name']);
        $this->db->bind(':town', $data['town']);
        $this->db->bind(':district', $data['district']);
        $this->db->bind(':postal_code', $data['postal_code']);
        $this->db->bind(':store_id', $data['store_id']);
    
        if ($this->db->execute()) {
            return true;
        } else {
            echo $this->db->error();
            return false;
        }
    }
    

    public function deleteStore($store_id) {
        $this->db->query('DELETE FROM publisher_stores  WHERE store_id = :store_id');
        // Bind values
        $this->db->bind(':store_id', $store_id);

        // Execute after binding
        $this->db->execute();

        // Check for row count affected
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    } 
    public function finduserDetails($sender_id){
        $this->db->query('SELECT * FROM users WHERE user_id=:user_id');
        $this->db->bind(':user_id', $sender_id);
        return $this->db->single(); // Return the result of the query
    }
    public function getChatDetailsById($user_id){
        $this->db->query('SELECT m.*, last_msgs.chat_id 
                         FROM message m 
                         JOIN (
                             SELECT MAX(msg_id) AS max_msg_id, 
                                 CASE 
                                     WHEN incoming_msg_id = :user_id THEN outgoing_msg_id 
                                     ELSE incoming_msg_id 
                                 END AS chat_id
                             FROM message 
                             WHERE incoming_msg_id = :user_id OR outgoing_msg_id = :user_id 
                             GROUP BY chat_id
                         ) AS last_msgs 
                         ON m.msg_id = last_msgs.max_msg_id;');
            
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }
    
    
    

}