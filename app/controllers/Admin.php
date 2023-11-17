<?php
 class Admin extends Controller{
  private $adminModel;
  
  private $userModel;

  private $db;
  public function __construct(){
      $this->adminModel=$this->model('Admins');
      $this->userModel=$this->model('User');
     
     
      $this->db = new Database();

  }
  public function index(){
      if (!isLoggedIn()) {
          redirect('landing/login');
      } else {
          $user_id = $_SESSION['user_id'];
         
          $adminDetails = $this->adminModel->findadminById($user_id);  
          $data = [
              'adminDetails' => $adminDetails
          ];
          $this->view('admin/index', $data);
      }
     
    
  }
 }