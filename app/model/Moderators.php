<?php
  class Moderators{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function findModeratorById($user_id){
      $this->db->query('SELECT * from moderator WHERE user_id=:user_id');
      $this->db->bind(':user_id',$user_id);
     

      return $this->db->resultSet();
    }

    public function getChallengeDetails(){
      $this->db->query('SELECT * FROM quiz');
      return $this->db->resultSet();
    }

    public function getPendingEventDetails(){
      $this->db->query('SELECT * FROM events WHERE status = "Pending"');
      return $this->db->resultSet();
    }
    
    public function findPendingContents(){
      $this->db->query('SELECT * FROM content WHERE status = "pending"');
      return $this->db->resultSet();
    }
    public function approveEvent($id){
      $this->db->query("UPDATE events SET status = 'Approved' WHERE id = :id");
      $this->db->bind(':id', $id);
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function rejectEvent($id){
      $this->db->query("UPDATE events SET status = 'Rejected' WHERE id = :id");
      $this->db->bind(':id', $id);
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function getPendingEventOwner($id){
      $this->db->query('SELECT name,email FROM users WHERE user_id = :id');
      $this->db->bind(':id', $id);
      return $this->db->single();
    }

    public function getPendingEventById($eventid){
      $this->db->query('SELECT title FROM events WHERE id = :eventid');
      $this->db->bind(':eventid', $eventid);
      return $this->db->single();
    }
    
    public function approveContent($content_id){
      $this->db->query('UPDATE content SET status=:status WHERE content_id=:content_id');
      $this->db->bind(':status',"approval");
      $this->db->bind(':content_id',$content_id);
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }
    public function rejectContent($content_id){
      $this->db->query('UPDATE content SET status=:status WHERE content_id=:content_id');
      $this->db->bind(':status',"reject");
      $this->db->bind(':content_id',$content_id);
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }
    public function getMessageDetails($user_id){
      $this->db->query('
          SELECT 
              u.name AS incoming_user_name,
              u2.name AS outgoing_user_name,
              m.msg,
              m.incoming_msg_id,
              m.outgoing_msg_id
          FROM 
              message AS m 
          JOIN 
              users AS u ON u.user_id = m.incoming_msg_id 
          JOIN 
              users AS u2 ON u2.user_id = m.outgoing_msg_id 
          WHERE 
              m.incoming_msg_id = :user_id
          ORDER BY 
              m.msg_id DESC
          LIMIT 5'
      );
      $this->db->bind(':user_id', $user_id);
  
      return $this->db->resultSet();
    }

    public function deleteChallenge($challengeId){
      $this->db->query('DELETE FROM quiz WHERE quiz_id = :challengeId');
      $this->db->bind(':challengeId',$challengeId);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }

    public function addQuiz($data){
      $this->db->query('INSERT INTO quiz(title,number_of_questions,time_limit,description) VALUES (:title,:number_of_questions,:time_limit,:description)');

      $this->db->bind(':title',$data['title']);
      $this->db->bind(':number_of_questions',$data['number_of_questions']);
      $this->db->bind(':time_limit',$data['time_limit']);
      $this->db->bind(':description',$data['description']);


      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }

    public function getQuizID(){
      $this->db->query('SELECT MAX(quiz_id) AS max_quiz_id FROM quiz');
      $result = $this->db->single();
      if ($result) {
        return $result->max_quiz_id;
      } else {
        return 1; 
      }
    }

    public function addQuestion($data){
      $this->db->query('INSERT INTO quiz_questions(quiz_id,question_id,question,option1,option2,option3,correctAnswer) VALUES (:quiz_id,:question_id,:question,:option1,:option2,:option3,:correctAnswer)');

      $this->db->bind(':quiz_id',$data['quiz_id']);
      $this->db->bind(':question_id',$data['question_id']);
      $this->db->bind(':question',$data['question']);
      $this->db->bind(':option1',$data['option1']);
      $this->db->bind(':option2',$data['option2']);
      $this->db->bind(':option3',$data['option3']);
      $this->db->bind(':correctAnswer',$data['correctAnswer']);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }

    public function geteventSearchDetails($input){
      $this->db->query("SELECT * FROM events WHERE title LIKE '{$input}%' AND status='Pending'");
      $results=$this->db->resultSet();
      return $results;

    }

    public function getchallengeSearchDetails($input){
      $this->db->query("SELECT * FROM quiz WHERE title LIKE '{$input}%' ");
      $results=$this->db->resultSet();
      return $results;

    }

    public function getTopContents(){
      $this->db->query("SELECT c.content_id, c.topic, c.text, c.customer_id, c.img, COUNT(cr.rate) AS rating_count
      FROM content c
      JOIN content_review cr ON c.content_id = cr.content_id
      GROUP BY c.content_id
      ORDER BY rating_count DESC
      LIMIT 3");

      $results=$this->db->resultSet();
      return $results;
    }

  
  
  
  }




?>