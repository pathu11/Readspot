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
                'deliveryDetails' => $deliveryDetails,
                

            ];
            $this->view('delivery/index', $data);
        }
       
       
    }
    public function updatePricePerOne($delivery_id){
        if(!isLoggedIn()){
            redirect('landing/login');
        }
    
        $user_id = $_SESSION['user_id'];
        $deliveryDetails=$this->deliveryModel->findDeliveryById($user_id);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form submitted, process the data
    
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'deliveryDetails'=>$deliveryDetails,
                'delivery_id' => $delivery_id,
                'priceperkilo' => trim($_POST['priceperkilo']),
                
                'priceperkilo_err' => '',
            ];
               
                   
                
                if(empty($data['priceperkilo'])){
                    $data['priceperkilo_err']='Please enter the charge for per additional kilo gram';      
                }else if($data['priceperkilo']<0 ){
                    $data['priceperkilo_err']='Please enter a valid price'; 
                }
               
    
                //make sure errors are empty
                if( empty($data['priceperkilo_err'])   ){   
                    if($this->deliveryModel->updatePricePerOne($data)){
                        flash('update_success','You are added the book  successfully');
                        redirect('delivery/index');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                        $this->view('delivery/updatePricePerOne',$data);
                    }
                   
            }else{
                     
                $delivers = $this->deliveryModel->finddeliveryByDelId($delivery_id);
                
                
                $data = [
                    
                    'delivery_id' => $delivery_id,
                    'priceperkilo' => $delivers->priceperkilo,
                    
                    'priceperkilo_err'=>'',
                   
                ];


                $this->view('delivery/updatePricePerOne',$data);
    
            }  
        
    }
    public function updatepriceAdditional($delivery_id){
        if(!isLoggedIn()){
            redirect('landing/login');
        }
    
        $user_id = $_SESSION['user_id'];
        $deliveryDetails=$this->deliveryModel->findDeliveryById($user_id);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form submitted, process the data
    
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'deliveryDetails'=>$deliveryDetails,
                'delivery_id' => $delivery_id,
                'priceperadditional' => trim($_POST['priceperadditional']),
                
                'priceperadditional_err' => '',
            ];
               
                   
                
                if(empty($data['priceperadditional'])){
                    $data['priceperadditional_err']='Please enter the charge for per additional kilo gram';      
                }else if($data['priceperadditional']<0 ){
                    $data['priceperadditional_err']='Please enter a valid price'; 
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
                     
                $delivers = $this->deliveryModel->finddeliveryByDelId($delivery_id);
                
                
                $data = [
                    
                    'delivery_id' => $delivery_id,
                    'priceperadditional' => $delivers->priceperadditional,
                    
                    'priceperadditional_err'=>'',
                   
                ];


                $this->view('delivery/updatepriceAdditional',$data);
    
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
        $deliveryid = null;
    
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            
            $deliveryDetails = $this->deliveryModel->findDeliveryById($user_id);
    
            if ($publisherDetails) {
                $publisherid = $publisherDetails[0]->publisher_id;
    
                if ($publisherid) {
                    $orderDetails = $this->orderModel->findBrandNewBookProOrdersBypubId($publisherid);
    
                    if ($orderDetails) {
                        // Assuming findBrandNewBookProOrdersBypubId returns an array of orders
                        foreach ($orderDetails as $order) {
                            $customerId = $order->customer_id;
                            if ($customerId) {
                                $customerDetails=$this->publisherModel->findcustomerBycusId($customerId);
                                $customerName=$customerDetails->name;
                            } else {
                                echo "Not found1";
                            }
                           
                            // Now you can use $customerId to fetch customer details if needed
                            // ...
                        }
                    } else {
                        echo "No orders found";
                    }
                } else {
                    echo "Publisher ID not found";
                }
            } else {
                echo "Publisher not found";
            }
        } else {
            echo "Not logged in as a publisher";
        }
    
        $data = [
            'publisherid' => $publisherid,
            'publisherDetails' => $publisherDetails,
            'orderDetails' => $orderDetails,
            'customerName' => $customerName
        ];
    
        $this->view('delivery/processedorders');
    }
    

}