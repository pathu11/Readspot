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
    public function rejectContent($content_id,$reason){
      $this->db->query('UPDATE content SET status=:status, reject_reason=:reject_reason WHERE content_id=:content_id
      ');
      $this->db->bind(':status',"reject");
      $this->db->bind(':content_id',$content_id);
      $this->db->bind(':reject_reason',$reason);
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
      $this->db->query('INSERT INTO quiz(title,number_of_questions,time_limit,description,img) VALUES (:title,:number_of_questions,:time_limit,:description,:img)');

      $this->db->bind(':title',$data['title']);
      $this->db->bind(':number_of_questions',$data['number_of_questions']);
      $this->db->bind(':time_limit',$data['time_limit']);
      $this->db->bind(':description',$data['description']);
      $this->db->bind(':img',$data['img']);

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

    public function getComplainSearchDetails($input){
      $this->db->query("SELECT CONCAT(first_name,' ',last_name) AS name, email, contact_number, other, descript, err_img, complaint_id, resolved_or_not 
      FROM complaint 
      WHERE resolved_or_not = :input 
      AND (reason='Events' OR reason='Challenges' OR reason='Contents')");
      $this->db->bind(":input",$input);
      $results=$this->db->resultSet();
      return $results;

    }

    public function getbookReviewSearchDetails($input){
      $this->db->query("SELECT r.book_id, b.book_name, r.review, r.review_id, c.first_name AS name, c.profile_img AS profile_img 
      FROM reviews r 
      JOIN customers c ON r.customer_id = c.customer_id
      JOIN books b ON r.book_id = b.book_id WHERE r.review LIKE '{$input}%' OR c.name LIKE '{$input}%' ");
      $results=$this->db->resultSet();
      return $results;
    }

    public function getcontentReviewSearchDetails($input){
      $this->db->query("SELECT r.content_id, b.topic, r.review, r.review_id, c.first_name AS name, c.profile_img AS profile_img 
      FROM content_review r 
      JOIN customers c ON r.customer_id = c.customer_id
      JOIN content b ON r.content_id = b.content_id WHERE b.topic LIKE '{$input}%' OR r.review LIKE '{$input}%'");
      $results=$this->db->resultSet();
      return $results;
    }

    public function getTopContents(){
      $this->db->query("SELECT c.content_id, c.topic, c.text, c.customer_id, c.img, c.pointsAdd, COUNT(cr.rate) AS rating_count
      FROM content c
      JOIN content_review cr ON c.content_id = cr.content_id
      GROUP BY c.content_id
      ORDER BY rating_count DESC
      LIMIT 3");

      $results=$this->db->resultSet();
      return $results;
    }

    public function addPoints($customer_id,$numberOfPoints){
      $this->db->query("UPDATE customers SET redeem_points = redeem_points + :numberOfPoints AND content_point = content_point + :numberOfPoints WHERE customer_id = :customer_id");

      $this->db->bind(":numberOfPoints",$numberOfPoints);
      $this->db->bind(":customer_id",$customer_id);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }

    public function markPointsAdd($content_id){
      $this->db->query("UPDATE content SET pointsAdd = 1 WHERE content_id = :content_id");
      $this->db->bind(":content_id",$content_id);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }

    public function getContentSubmissionCount(){
      $this->db->query('SELECT COUNT(*) AS num_contents
      FROM content
      WHERE MONTH(time) >= MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
      AND YEAR(time) >= YEAR(CURRENT_DATE - INTERVAL 1 MONTH);
      ');
      $result = $this->db->single();
      return $result;
    }

    public function getEventSubmissionCount(){
      $this->db->query('SELECT COUNT(*) AS num_events
      FROM events
      WHERE MONTH(created_at) >= MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
      AND YEAR(created_at) >= YEAR(CURRENT_DATE - INTERVAL 1 MONTH);
      ');
      $result = $this->db->single();
      return $result;
    }

    public function getChallengeSubmissionCount(){
      $this->db->query('SELECT COUNT(*) AS num_challenges
      FROM history
      WHERE MONTH(attempt_date) >= MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
      AND YEAR(attempt_date) >= YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
      ');
      $result = $this->db->single();
      return $result;
    }

    public function getComplains(){
      $this->db->query('SELECT CONCAT(first_name," ",last_name) AS name,email,contact_number,other,descript,err_img,complaint_id,resolved_or_not FROM complaint WHERE reason="Events" OR reason="Challenges" OR reason="Contents"');
      $results=$this->db->resultSet();
      return $results;
    }

    public function respondComplain($complaint_id,$moderatorComment){
      $this->db->query('UPDATE complaint SET moderatorAdmin_comment = :moderatorComment, resolved_or_not=1 WHERE complaint_id = :complaint_id');

      $this->db->bind(":moderatorComment",$moderatorComment);
      $this->db->bind(":complaint_id",$complaint_id);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }

    public function getChallengeScoreDetails(){
      $this->db->query('SELECT u.name, s.user_id, SUM(s.score) AS total_score, u.challnege_point
      FROM history s
      INNER JOIN customers u ON s.user_id = u.user_id
      GROUP BY u.user_id
      ORDER BY total_score DESC');

      return $this->db->resultSet();
    }

    public function pointsAddDate(){
      $this->db->query('SELECT user_id FROM customers WHERE challenge_point_date >= DATE_SUB(NOW(), INTERVAL 1 WEEK)');
      $results = $this->db->resultSet();
      return $results;
    }

    public function addPointsChallenge($user_id,$numberOfPoints){
      $this->db->query('UPDATE customers SET challnege_point = challnege_point+ :numberOfPoints, redeem_points = redeem_points + :numberOfPoints, challenge_point_date = NOW() WHERE user_id = :user_id');

      $this->db->bind(":numberOfPoints",$numberOfPoints);
      $this->db->bind(":user_id",$user_id);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }

    public function getReviews() {
      $this->db->query('SELECT r.book_id, b.book_name, r.review, r.review_id, c.first_name AS name, c.profile_img AS profile_img 
      FROM reviews r 
      JOIN customers c ON r.customer_id = c.customer_id
      JOIN books b ON r.book_id = b.book_id');
      $results = $this->db->resultSet();
      return $results;
    }

    public function deleteBookReview($review_id){
      $this->db->query('DELETE FROM reviews WHERE review_id = :review_id');
      $this->db->bind(":review_id",$review_id);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }

    public function getContentReviews(){
      $this->db->query('SELECT r.content_id, b.topic, r.review, r.review_id, c.first_name AS name, c.profile_img AS profile_img 
      FROM content_review r 
      JOIN customers c ON r.customer_id = c.customer_id
      JOIN content b ON r.content_id = b.content_id');
      $results = $this->db->resultSet();
      return $results;
    }

    public function deleteContentReview($review_id){
      $this->db->query('DELETE FROM content_review WHERE review_id = :review_id');
      $this->db->bind(":review_id",$review_id);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }

    public function sendToSuperAdmin($complaint_id) {
      $this->db->query('UPDATE complaint SET sent_to_superadmin = 1 WHERE complaint_id = :complaint_id');
      $this->db->bind(":complaint_id",$complaint_id);
    
      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    
    }

  }




?>