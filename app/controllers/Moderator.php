<?php

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
      if (!isLoggedIn()) {
        redirect('landing/login');
      }else{
        $user_id = $_SESSION['user_id'];

        $moderatorDetails = $this->moderatorModel->findmoderatorById($user_id);
        $messageDetails = $this->moderatorModel->getMessageDetails($user_id);
        $data = [
          'moderatorDetails' => $moderatorDetails,
          'moderatorName'=>$moderatorDetails[0]->name,
          'messageDetails'=>$messageDetails,
      ];
        $this->view('moderator/index',$data);
      }
      
    }

    public function challenges(){
      if (!isLoggedIn()) {
        redirect('landing/login');
      }else{
        $user_id = $_SESSION['user_id'];

        $moderatorDetails = $this->moderatorModel->findmoderatorById($user_id);
        //$challengeDetails = $this->moderatorModel->getChallengeDetails();
        $data = [
          'moderatorDetails' => $moderatorDetails,
          'moderatorName'=>$moderatorDetails[0]->name,
          //'challengeDetails'=>$challengeDetails,

      ];
        $this->view('moderator/challenges',$data);
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
              'marks_right_answer'=>trim($_POST['marks_right_answer']),
              'time_limit'=>trim($_POST['time_limit']),
              'description'=>trim($_POST['description']),
              
              'title_err'=>'',
              'number_of_questions_err'=>'',
              'marks_right_answer_err'=>'',
              'time_limit_err'=>'',
              'description_err'=>'',
          ];
          if(empty($data['title'])){
              $data['title_err']='Please enter the qyuiz title';      
          }
  
          if(empty($data['number_of_questions'])){
              $data['number_of_questions_err']='Please enter the number of questions';      
          }

          if(empty($data['marks_right_answer'])){
            $data['marks_right_answer_err']='Please enter the marks for right answer';      
          }

          if(empty($data['time_limit'])){
            $data['time_limit_err']='Please enter the quiz time limit';      
          }

          if(empty($data['description'])){
            $data['description_err']='Please enter the quiz description';      
          }

          if(empty($data['title_err']) && empty($data['number_of_questions_err']) && empty($data['marks_right_answer_err']) && empty($data['time_limit_err']) && empty($data['description_err'])){
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
              'marks_right_answer'=>'',
              'time_limit'=>'',
              'description'=>'',
              
              'title_err'=>'',
              'number_of_questions_err'=>'',
              'marks_right_answer_err'=>'',
              'time_limit_err'=>'',
              'description_err'=>'',
          ];
  
          $this->view('moderator/createChallenge',$data);
      } 
      }
    }

    public function createChallengeQuestions(){
      $this->view('moderator/createChallengeQuestions');
    }

    public function events(){
      if (!isLoggedIn()) {
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

    public function approveEvent($id){
      if ($this->moderatorModel->approveEvent($id)) {   
        flash('post_message', 'Event is Approved');
        redirect('moderator/events');
        
        
      } else {
        die('Something went wrong');
      }
    }

    public function chat(){
      if (!isLoggedIn()) {
        redirect('landing/login');
      }else{
        $user_id = $_SESSION['user_id'];

        $moderatorDetails = $this->moderatorModel->findmoderatorById($user_id);
        $data = [
          'moderatorDetails' => $moderatorDetails,
          'moderatorName'=>$moderatorDetails[0]->name,

      ];
        $this->view('moderator/chat',$data);
      }
    }
  
  
  }


?>

