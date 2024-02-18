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
        $data = [
          'moderatorDetails' => $moderatorDetails,
          'moderatorName'=>$moderatorDetails[0]->name,

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
        $challengeDetails = $this->moderatorModel->getChallengeDetails();
        $data = [
          'moderatorDetails' => $moderatorDetails,
          'moderatorName'=>$moderatorDetails[0]->name,
          'challengeDetails'=>$challengeDetails,

      ];
        $this->view('moderator/challenges',$data);
      }
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

