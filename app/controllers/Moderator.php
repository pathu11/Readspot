<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require APPROOT . '\vendor\autoload.php';

  class Moderator extends Controller{
    private $moderatorModel;

    private $userModel;

    private $db;
    public function __construct(){
        $this->moderatorModel=$this->model('Moderators');
        $this->userModel=$this->model('User');
        $this->db = new Database();

    }

    public function index(){
      if (!isLoggedInModerator()) {
        redirect('landing/login');
      }else{
        $user_id = $_SESSION['user_id'];

        $moderatorDetails = $this->moderatorModel->findmoderatorById($user_id);
        $messageDetails = $this->moderatorModel->getMessageDetails($user_id);
        $contentSubmissionCount = $this->moderatorModel->getContentSubmissionCount();
        $eventSubmissionCount = $this->moderatorModel->getEventSubmissionCount();
        $challengeSubmissionCount = $this->moderatorModel->getChallengeSubmissionCount();
        
        $data = [
          'moderatorDetails' => $moderatorDetails,
          'moderatorName'=>$moderatorDetails[0]->name,
          'messageDetails'=>$messageDetails,
          'contentSubmissionCount'=>$contentSubmissionCount->num_contents,
          'eventSubmissionCount'=>$eventSubmissionCount->num_events,
          'challengeSubmissionCount'=>$challengeSubmissionCount->num_challenges,
      ];
        $this->view('moderator/index',$data);
      }
      
    }

    public function challenges(){
      if (!isLoggedInModerator()) {
        redirect('landing/login');
      }else{
        $user_id = $_SESSION['user_id'];

        $moderatorDetails = $this->moderatorModel->findmoderatorById($user_id);
        $challengeDetails = $this->moderatorModel->getChallengeDetails();
        $data = [
          'moderatorDetails' => $moderatorDetails,
          'moderatorName'=>$moderatorDetails[0]->name,
          'challengeDetails'=>$challengeDetails,

      ];
        $this->view('moderator/challenges',$data);
      }
    }

    public function deleteChallenge($challengeId){
      if (!isLoggedInModerator()) {
        redirect('landing/login');
      }else{
        if($this->moderatorModel->deleteChallenge($challengeId)){
          flash('delete_success','You deleted the challenge successfully');
          redirect('moderator/challenges');
        }
        else{
            die('Something went wrong');
        }
      }
    }

    public function createChallenge(){
      if (!isLoggedIn()) {
        redirect('landing/login');
      }else{
        $user_id = $_SESSION['user_id'];
        $moderatorDetails = $this->moderatorModel->findmoderatorById($user_id);
        
        if($_SERVER['REQUEST_METHOD']=='POST'){
          $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
          $data = [
              'moderatorDetails' => $moderatorDetails,
              'moderatorName'=>$moderatorDetails[0]->name,
              'title'=>trim($_POST['title']),
              'number_of_questions'=>trim($_POST['number_of_questions']),
              'time_limit'=>trim($_POST['time_limit']),
              'description'=>trim($_POST['description']),
              'img'=>'',
              
              'title_err'=>'',
              'number_of_questions_err'=>'',
              'time_limit_err'=>'',
              'description_err'=>'',
              'img_err'=>''
          ];
          if(empty($data['title'])){
              $data['title_err']='Please enter the qyuiz title';      
          }
  
          if(empty($data['number_of_questions'])){
              $data['number_of_questions_err']='Please enter the number of questions';      
          }

          if(empty($data['time_limit'])){
            $data['time_limit_err']='Please enter the quiz time limit';      
          }

          if(empty($data['description'])){
            $data['description_err']='Please enter the quiz description';      
          }

          if(empty($data['title_err']) && empty($data['number_of_questions_err']) && empty($data['time_limit_err']) && empty($data['description_err'])){

            if (isset($_FILES['img']['name']) AND !empty($_FILES['img']['name'])) {
              $img_name = $_FILES['img']['name'];
              $tmp_name = $_FILES['img']['tmp_name'];
              $error = $_FILES['img']['error'];
                          
              if ($error === 0) {
                  $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                  $img_ex_to_lc = strtolower($img_ex);
                      
                  $allowed_exs = array('jpg', 'jpeg', 'png');
                  if (in_array($img_ex_to_lc, $allowed_exs)) {
                      // Generate a unique identifier (e.g., timestamp)
                      $unique_id = time(); 
                      $new_img_name = 'challenge' . $unique_id . '-img.' . $img_ex_to_lc;
                      $img_upload_path = "../public/assets/images/moderator/" . $new_img_name;
                      move_uploaded_file($tmp_name, $img_upload_path);
                      
                      $data['img'] = $new_img_name;
                  } else {
                      // Handle file type not allowed error
                      $data['img_err'] = 'Only JPG, JPEG, and PNG files are allowed';
                  }
              } else {
                  // Handle file upload error
                  $data['img_err'] = 'Error uploading the file';
              }
            }
              
            
            if($this->moderatorModel->addQuiz($data)){
                  flash('add_success','You are added the quiz successfully');
                  redirect('moderator/createChallengeQuestions');
              }else{
                  die('Something went wrong');
              }
          }
  
          else{
              $this->view('moderator/createChallenge',$data);
          }  
      }
      else{
          $data=[
              'moderatorDetails' => $moderatorDetails,
              'moderatorName'=>$moderatorDetails[0]->name,
              'title'=>'',
              'number_of_questions'=>'',
              'time_limit'=>'',
              'description'=>'',
              'img'=>'',
              
              'title_err'=>'',
              'number_of_questions_err'=>'',
              'time_limit_err'=>'',
              'description_err'=>'',
              'img_err'=>''
          ];
  
          $this->view('moderator/createChallenge',$data);
      } 
      }
    }

    public function createChallengeQuestions(){
      if (!isLoggedIn()) {
          redirect('landing/login');
      } else {
          $user_id = $_SESSION['user_id'];
          $moderatorDetails = $this->moderatorModel->findmoderatorById($user_id);
          $quiz_id = $this->moderatorModel->getQuizID();       
  
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
              $all_questions_added = true;
  
              for ($i = 1; $i <= 5; $i++) {
                  $question = $_POST["q$i"];
                  $option1 = $_POST["q$i-opt1"];
                  $option2 = $_POST["q$i-opt2"];
                  $option3 = $_POST["q$i-opt3"];
                  $correctAnswer = $_POST["q$i-answer"];
  
                  $data = [
                      'moderatorDetails' => $moderatorDetails,
                      'moderatorName' => $moderatorDetails[0]->name,
                      'question' => $question,
                      'option1' => $option1,
                      'option2' => $option2,
                      'option3' => $option3,
                      'correctAnswer' => $correctAnswer,
                      'quiz_id' => $quiz_id,
                      'question_id'=>$i,
  
                      'question_err' => '',
                      'option1_err' => '',
                      'option2_err' => '',
                      'option3_err' => '',
                      'correctAnswer_err' => '',
                  ];
  
                  if (empty($data['question'])) {
                      $data['question_err'] = 'Please enter the question';      
                      $all_questions_added = false;
                  }
                  if (empty($data['option1'])) {
                      $data['option1_err'] = 'Please enter the option 1';      
                      $all_questions_added = false;
                  }
                  if (empty($data['option2'])) {
                      $data['option2_err'] = 'Please enter the option 2';      
                      $all_questions_added = false;
                  }
                  if (empty($data['option3'])) {
                      $data['option3_err'] = 'Please enter the option 3';      
                      $all_questions_added = false;
                  }
                  if (empty($data['correctAnswer'])) {
                      $data['correctAnswer_err'] = 'Please enter the correct answer';      
                      $all_questions_added = false;
                  }
  
                  if ($all_questions_added && $this->moderatorModel->addQuestion($data)) {
                      // All questions added successfully
                      flash('add_success', 'You have added the questions successfully');
                      // redirect('moderator/challenges');
                  }
              }
              redirect('moderator/challenges');
          } else {
              for ($i = 1; $i <= 5; $i++) {
                  $question = '';
                  $option1 = '';
                  $option2 = '';
                  $option3 = '';
                  $correctAnswer = '';
  
                  $data = [
                      'moderatorDetails' => $moderatorDetails,
                      'moderatorName' => $moderatorDetails[0]->name,
                      'question' => $question,
                      'option1' => $option1,
                      'option2' => $option2,
                      'option3' => $option3,
                      'correctAnswer' => $correctAnswer,
                      'quiz_id' => $quiz_id,
  
                      'question_err' => '',
                      'option1_err' => '',
                      'option2_err' => '',
                      'option3_err' => '',
                      'correctAnswer_err' => '',
                  ];
  
                  $this->view('moderator/createChallengeQuestions', $data);
              } 
          }
      }
    }
  

    public function events(){
      if (!isLoggedInModerator()) {
        redirect('landing/login');
      }else{
        $user_id = $_SESSION['user_id'];

        $moderatorDetails = $this->moderatorModel->findmoderatorById($user_id);
        $pendingEventDetails = $this->moderatorModel->getPendingEventDetails();
        $data = [
          'moderatorDetails' => $moderatorDetails,
          'moderatorName'=>$moderatorDetails[0]->name,
          'pendingEventDetails'=>$pendingEventDetails,

      ];
        $this->view('moderator/events',$data);
      }
    }

    public function approveEvent($userid,$eventid){
      $pendingEventOwner = $this->moderatorModel->getPendingEventOwner($userid);
      $pendingEvent = $this->moderatorModel->getPendingEventById($eventid);

      if ($this->moderatorModel->approveEvent($eventid)) {   
        // Send email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = MAIL_HOST;  // Specify your SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = MAIL_USER; // SMTP username
            $mail->Password   = MAIL_PASS;   // SMTP password
            $mail->SMTPSecure = MAIL_SECURITY;
            $mail->Port       = MAIL_PORT;

            //Recipients
            $mail->setFrom('readspot27@gmail.com', 'READSPOT');
            $mail->addAddress($pendingEventOwner->email);  // Add a recipient

            // Content
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Your Event Has Been Accepted';
            $mail->Body    = "Dear ".$pendingEventOwner->name. ". Your event ".$pendingEvent->title." has been approved.";

            $mail->send();

            // Redirect or perform other actions as needed
            redirect('moderator/events');
        } catch (Exception $e) {
            die('Something went wrong: ' . $mail->ErrorInfo);
        }
      }
      else{
        echo 'Something Went Wrong';
      }
    }

    public function rejectEvent(){
      if (!isLoggedInModerator()) {
        redirect('landing/login');
      }else{
        if($_SERVER["REQUEST_METHOD"]=="POST"){
          $rejectReason = $_POST["rejectReason"];
          $user_id = $_POST["user_id"];
          $event_id = $_POST["event_id"];

          $pendingEventOwner = $this->moderatorModel->getPendingEventOwner($user_id);
          $pendingEvent = $this->moderatorModel->getPendingEventById($event_id);

          if ($this->moderatorModel->rejectEvent($event_id)) {   
            // Send email using PHPMailer
            $mail = new PHPMailer(true);
    
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = MAIL_HOST;  // Specify your SMTP server
                $mail->SMTPAuth   = true;
                $mail->Username   = MAIL_USER; // SMTP username
                $mail->Password   = MAIL_PASS;   // SMTP password
                $mail->SMTPSecure = MAIL_SECURITY;
                $mail->Port       = MAIL_PORT;
    
                //Recipients
                $mail->setFrom('readspot27@gmail.com', 'READSPOT');
                $mail->addAddress($pendingEventOwner->email);  // Add a recipient
    
                // Content
                $mail->isHTML(true);  // Set email format to HTML
                $mail->Subject = 'Your Event Has Been Rejected';
                $mail->Body    = "Dear ".$pendingEventOwner->name. ". Your event ".$pendingEvent->title." has been rejected. The reason for the rejection is '".$rejectReason."'.";
    
                $mail->send();
    
                // Redirect or perform other actions as needed
                redirect('moderator/events');
            } catch (Exception $e) {
                die('Something went wrong: ' . $mail->ErrorInfo);
            }
          }
          else{
            echo 'Something Went Wrong';
          }

        }
      }
    }

    public function contents(){
      if (!isLoggedInModerator()) {
        redirect('landing/login');
      }else{
        $user_id = $_SESSION['user_id'];
        $contentDetails=$this->moderatorModel->findPendingContents();
        $moderatorDetails = $this->moderatorModel->findmoderatorById($user_id);
        $data = [
          'moderatorDetails' => $moderatorDetails,
          'moderatorName'=>$moderatorDetails[0]->name,
          'contentDetails'=>$contentDetails
      ];
        $this->view('moderator/contents',$data);
      }
    }
    public function approveContent(){
      if (!isLoggedInModerator()) {
        redirect('landing/login');
      }else{
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $data = json_decode(file_get_contents("php://input"));
          $content_id = $data->content_id;
  
          if($content_id){
            if($this->moderatorModel->approveContent($content_id)){
              $response = ['success' => true]; 
              echo json_encode($response);
            }
          }
          
      } else {
          // If the request method is not POST, return an error response
          $response = ['success' => false, 'message' => 'Invalid request method'];
          echo json_encode($response);
      }
      }
    }

  public function rejectContent() {
    // Check if user is logged in as a moderator
    if (!isLoggedInModerator()) {
        redirect('landing/login');
    }


    // Ensure the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        // If the request method is not POST, return an error response
        $response = ['success' => false, 'message' => 'Invalid request method'];
        echo json_encode($response);
        return;
    }

    // Get the content ID from the request body
    $data = json_decode(file_get_contents("php://input"));
    $content_id = $data->content_id;
    $reason = $data->reason;

    // Validate content ID
    if (!($content_id || $reason)) {
        // If content ID is missing, return an error response
        $response = ['success' => false, 'message' => 'Invalid content ID'];
        echo json_encode($response);
        return;
    }

    // Perform the rejection operation in the model
    if ($this->moderatorModel->rejectContent($content_id,$reason)) {
        // If rejection is successful, return a success response
        $response = ['success' => true];
        echo json_encode($response);
    } else {
        // If rejection fails, return an error response
        $response = ['success' => false, 'message' => 'Failed to reject content'];
        echo json_encode($response);
    }
}


    public function livesearch(){
      if(isset($_POST['input'])){
        $input = $_POST['input'];
        $eventSearchDetails = $this->moderatorModel->geteventSearchDetails($input);
        $challengeSearchDetails = $this->moderatorModel->getChallengeSearchDetails($input);
        $complainSearchDetails = $this->moderatorModel->getComplainSearchDetails($input);
        $bookReviewSearchDetails = $this->moderatorModel->getbookReviewSearchDetails($input);
        $contentReviewSearchDetails = $this->moderatorModel->getcontentReviewSearchDetails($input);
      }
  
      $data = [
          'eventSearchDetails'=>$eventSearchDetails,
          'challengeSearchDetails'=>$challengeSearchDetails,
          'complainSearchDetails'=>$complainSearchDetails,
          'bookReviewSearchDetails'=>$bookReviewSearchDetails,
          'contentReviewSearchDetails'=>$contentReviewSearchDetails
      ];
      
      $this->view('moderator/livesearch',$data);
    }

    public function topContents(){
      if (!isLoggedInModerator()) {
        redirect('landing/login');
      }else{
        $user_id = $_SESSION['user_id'];
        $moderatorDetails = $this->moderatorModel->findmoderatorById($user_id);
        $topContentDetails = $this->moderatorModel->getTopContents();
        $data = [
          'moderatorDetails' => $moderatorDetails,
          'moderatorName'=>$moderatorDetails[0]->name,
          'topContentDetails'=>$topContentDetails,
      ];
        $this->view('moderator/topContents',$data);
      }
    }
  
  public function addPoints(){
    if (!isLoggedInModerator()) {
      redirect('landing/login');
    }else{
      if($_SERVER['REQUEST_METHOD']=='POST'){
        $customer_id = $_POST["customer_id"];
        $numberOfPoints = $_POST["numberOfPoints"];
        $content_id = $_POST["content_id"];

        if($this->moderatorModel->addPoints($customer_id,$numberOfPoints)){
          if($this->moderatorModel->markPointsAdd($content_id)){
            redirect('moderator/topContents');
          }
        }
        else{
          echo 'Something went wrong';
        }

      }
      else{
        echo 'Something went wrong';
      }
    }
  }

  public function addPointsChallenge(){
    if (!isLoggedInModerator()) {
      redirect('landing/login');
    }else{
      if($_SERVER['REQUEST_METHOD']=='POST'){
        $user_id = $_POST["user_id"];
        $numberOfPoints = $_POST["numberOfPoints"];

        if($this->moderatorModel->addPointsChallenge($user_id,$numberOfPoints)){
            redirect('moderator/topChallenges');
        }
        else{
          echo 'Something went wrong';
        }
      }
    }
  }

  public function complains(){
    if (!isLoggedInModerator()) {
      redirect('landing/login');
    }else{
      $user_id = $_SESSION['user_id'];
      $moderatorDetails = $this->moderatorModel->findmoderatorById($user_id);
      $complainDetails = $this->moderatorModel->getComplains();
      
      $data = [
        'moderatorDetails' => $moderatorDetails,
        'moderatorName'=>$moderatorDetails[0]->name,
        'complainDetails'=>$complainDetails,
      ];
      $this->view('moderator/complains',$data);
    }
  }

  public function respondComplain(){
    if (!isLoggedInModerator()) {
      redirect('landing/login');
    }else{
      if($_SERVER["REQUEST_METHOD"]=="POST"){
        $moderatorComment = $_POST["moderatorComment"];
        $complaint_id = $_POST["complaint_id"];
        $email = $_POST["email"];
        $name = $_POST["name"];

        if ($this->moderatorModel->respondComplain($complaint_id,$moderatorComment)) {   
          // Send email using PHPMailer
          $mail = new PHPMailer(true);
  
          try {
              //Server settings
              $mail->isSMTP();
              $mail->Host       = MAIL_HOST;  // Specify your SMTP server
              $mail->SMTPAuth   = true;
              $mail->Username   = MAIL_USER; // SMTP username
              $mail->Password   = MAIL_PASS;   // SMTP password
              $mail->SMTPSecure = MAIL_SECURITY;
              $mail->Port       = MAIL_PORT;
  
              //Recipients
              $mail->setFrom('readspot27@gmail.com', 'READSPOT');
              $mail->addAddress($email);  // Add a recipient
  
              // Content
              $mail->isHTML(true);  // Set email format to HTML
              $mail->Subject = 'Regarding Your Complain';
              $mail->Body    = "Dear ".$name. ". Thank you for reaching out to us ".$moderatorComment." If there is anything else we can assist you with, or if you have any further questions, please don't hesitate to contact us.

              Thank you for your understanding.";
  
              $mail->send();
  
              // Redirect or perform other actions as needed
              redirect('moderator/complains');
          } catch (Exception $e) {
              die('Something went wrong: ' . $mail->ErrorInfo);
          }
        }
        else{
          echo 'Something Went Wrong';
        }

      }
    }
  }

  public function topChallenges(){
    if (!isLoggedInModerator()) {
      redirect('landing/login');
    }else{
      $user_id = $_SESSION['user_id'];
      $moderatorDetails = $this->moderatorModel->findmoderatorById($user_id);
      $challengeScoreDetails = $this->moderatorModel->getChallengeScoreDetails();
      $pointsAddDate = $this->moderatorModel->pointsAddDate();
      
      $data = [
        'moderatorDetails' => $moderatorDetails,
        'moderatorName'=>$moderatorDetails[0]->name,
        'challengeScoreDetails'=>$challengeScoreDetails,
        'pointsAddDate'=>$pointsAddDate,
      ];
      $this->view('moderator/topChallenges',$data);
    }
  }

  public function bookReviews(){
    if (!isLoggedInModerator()) {
      redirect('landing/login');
    }else{
      $user_id = $_SESSION['user_id'];
      $moderatorDetails = $this->moderatorModel->findmoderatorById($user_id);
      $reviewDetails = $this->moderatorModel->getReviews();
      
      $data = [
        'moderatorDetails' => $moderatorDetails,
        'moderatorName'=>$moderatorDetails[0]->name,
        'reviewDetails'=>$reviewDetails,
      ];
      $this->view('moderator/bookReviews',$data);
    }
  }

  public function contentReviews(){
    if (!isLoggedInModerator()) {
      redirect('landing/login');
    }else{
      $user_id = $_SESSION['user_id'];
      $moderatorDetails = $this->moderatorModel->findmoderatorById($user_id);
      $contentReviewDetails = $this->moderatorModel->getContentReviews();
      
      $data = [
        'moderatorDetails' => $moderatorDetails,
        'moderatorName'=>$moderatorDetails[0]->name,
        'contentReviewDetails'=>$contentReviewDetails,
      ];
      $this->view('moderator/contentReviews',$data);
    }
  }


  public function deleteBookReview($review_id){
    if (!isLoggedInModerator()) {
      redirect('landing/login');
    }else{
      if($this->moderatorModel->deleteBookReview($review_id)){
        redirect('moderator/bookReviews');
      }
      else echo 'Something went wrong';
    }
  }

  public function deleteContentReview($review_id){
    if (!isLoggedInModerator()) {
      redirect('landing/login');
    }else{
      if($this->moderatorModel->deleteContentReview($review_id)){
        redirect('moderator/contentReviews');
      }
      else echo 'Something went wrong';
    }
  }

  public function sendToSuperAdmin($complaint_id) {
    if (!isLoggedInModerator()) {
        redirect('landing/login');
    }else{
      $user_id = $_SESSION['user_id'];
      $adminDetails = $this->moderatorModel->findmoderatorById($user_id);

      if($this->moderatorModel->sendToSuperAdmin($complaint_id)){
          $_SESSION['showModal'] = true; // Set session variable to true
          redirect('moderator/complains');
      }else{
          echo 'Something went wrong';
      }
    }
}
  
  }


?>

