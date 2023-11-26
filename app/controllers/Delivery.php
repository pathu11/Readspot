<?php
class Delivery extends Controller{
    private $deliveryModel;
    
    private $userModel;

    private $db;
    public function __construct(){
        $this->deliveryModel=$this->model('deliver');
        $this->userModel=$this->model('User');
       
       
        $this->db = new Database();
    }
    public function index(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $deliveryDetails = $this->deliveryModel->findDeliveryById($user_id);  
            $data = [
                'deliveryDetails' => $deliveryDetails
            ];
            $this->view('delivery/index', $data);
        }
       
       
    }
    
    public function orders(){
       
        $this->view('delivery/orders');
    }
    public function notification(){
       
        $this->view('delivery/notification');
    }
    public function successorders(){
       
        $this->view('delivery/successorders');
    }
    public function returnedorders(){
       
        $this->view('delivery/returnedorders');
    }
    public function processedorders(){
       
        $this->view('delivery/processedorders');
    }
    

}