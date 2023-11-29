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
            $deliverId=$deliveryDetails[0]->deliver_id;  
            $data = [
                'deliveryDetails' => $deliveryDetails,\
                'deliverId'=>$deliverId

            ];
            $this->view('delivery/index', $data);
        }
       
       
    }
    public function updatepriceAdditional($deliver_id){
        if(!isLoggedIn()){
            redirect('landing/login');
        }
    
        $user_id = $_SESSION['user_id'];

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form submitted, process the data
    
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'deliver_id' => $deliver_id,
                'priceperadditional' => trim($_POST['priceperadditional']),
                
                'priceperadditional_err' => '',
            ];
               
                   
                
                if(empty($data['priceperadditional_code'])){
                    $data['priceperadditional_err']='Please enter the charge for per additional kilo gram';      
                }
               
    
                //make sure errors are empty
                if( empty($data['priceperadditional_err'])   ){

                   
                    
                    
                    if($this->deliveryModel->updatepriceAdditional($data)){
                        flash('update_success','You are added the book  successfully');
                        redirect('delivery/index');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                        $this->view('delivery/updatepriceAdditional',$data);
                    }
    
                   
            }else{
                     
                $delivers = $this->deliveryModel->finddeliveryBypubId($deliver_id);
                
                
                $data = [
                    
                    'deliver_id' => $deliver_id,
                    'priceperadditional' => $delivers->priceperadditional,
                    
                    'priceperadditional_err'=>'',
                   
                ];


                $this->view('delivery/updatepriceAdditional');
    
            }  
        
    }
    public function updatepricePerOne($deliver_id){
        if(!isLoggedIn()){
            redirect('landing/login');
        }
    
        $user_id = $_SESSION['user_id'];

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form submitted, process the data
    
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'deliver_id' => $deliver_id,
                'priceperkilo' => trim($_POST['priceperkilo']),
                
                'priceperkilo_err' => '',
            ];
               
                   
                
                if(empty($data['priceperkilo'])){
                    $data['priceperkilo_err']='Please enter the charge for first kilo gram';      
                }
               
    
                //make sure errors are empty
                if( empty($data['priceperkilo_err'])   ){

                   
                    
                    
                    if($this->deliveryModel->updatepricePerOne($data)){
                        flash('update_success','You are added the book  successfully');
                        redirect('delivery/index');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                        $this->view('delivery/updatepricePerOne',$data);
                    }
    
                   
            }else{
                     
                $delivers = $this->deliveryModel->finddeliveryBypubId($deliver_id);
                
                
                $data = [
                    
                    'deliver_id' => $deliver_id,
                    'priceperkilo' => $delivers->priceperkilo,
                    
                    'priceperkilo_err'=>'',
                   
                ];


                $this->view('delivery/updatepricePerOne');
    
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