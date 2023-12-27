<?php
class Delivery extends Controller{
    private $deliveryModel;
    
    private $userModel;
    private $orderModel;
    private $db;
    public function __construct(){
        $this->deliveryModel=$this->model('deliver');
        $this->userModel=$this->model('User');
        $this->orderModel=$this->model('Orders');
       
       
        $this->db = new Database();
    }
    public function index(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $deliveryDetails = $this->deliveryModel->findDeliveryById($user_id);
            $deliveryName=$deliveryDetails[0]->name;
             
            $data = [
                'deliveryDetails' => $deliveryDetails,
                'deliveryName'=>$deliveryName
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
                'deliveryName'=>$deliveryDetails[0]->name,
             
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
                    'deliveryName'=>$delivers->name
                   
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
    
    public function shippingorders(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
    
        $deliveryid = null;
    
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
    
            $deliveryDetails = $this->deliveryModel->findDeliveryById($user_id);
            $orderDetails = $this->orderModel->findBookShippingOrders();
    
            $senderName = $receiverName = $senderStreet = $senderTown = $senderDistrict = $senderPostalCode = $receiverStreet = $receiverTown = $receiverDistrict = $receiverPostalCode = '';
    
            
        } else {
            echo "Not logged in as a publisher";
        }
        $deliveryDetails = $this->deliveryModel->findDeliveryById($user_id);
        $data = [
            'orderDetails'=>$orderDetails,
            'deliveryName'=>$deliveryDetails[0]->name
        ];
       
        $this->view('delivery/shippingorders',$data);
    }
    public function notification(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            
            $deliveryDetails = $this->deliveryModel->findDeliveryById($user_id);
           
            if ($deliveryDetails) {
               
                $deliveryid = $deliveryDetails[0]->delivery_id;
              
                $messageDetails = $this->deliveryModel->findMessageByUserId($user_id);
                // $messageDetails2 = $this->deliveryModel->getMessageById($message_id);
                
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a publisher";
        }
    
        $data = [
            'deliveryid' => $deliveryid,
            'deliveryDetails' => $deliveryDetails,
            'messageDetails' => $messageDetails,
           
            'deliveryName'  =>$deliveryDetails[0] ->name
        ];
    

        $this->view('delivery/notification',$data);
    }
    
    public function deliveredorders(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
    
        $deliveryid = null;
    
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
    
            $deliveryDetails = $this->deliveryModel->findDeliveryById($user_id);
            $orderDetails = $this->orderModel->findBookDeliveredOrders();
    
            $senderName = $receiverName = $senderStreet = $senderTown = $senderDistrict = $senderPostalCode = $receiverStreet = $receiverTown = $receiverDistrict = $receiverPostalCode = '';
    
            
        } else {
            echo "Not logged in as a publisher";
        }
        $deliveryDetails = $this->deliveryModel->findDeliveryById($user_id);
        $data = [
            'orderDetails'=>$orderDetails,
            'deliveryName'=>$deliveryDetails[0]->name
           
        ];
       
        $this->view('delivery/deliveredorders',$data);
    }
    public function returnedorders(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
    
        $deliveryid = null;
    
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
    
            $deliveryDetails = $this->deliveryModel->findDeliveryById($user_id);
            $orderDetails = $this->orderModel->findBookReturnedOrders();
    
            $senderName = $receiverName = $senderStreet = $senderTown = $senderDistrict = $senderPostalCode = $receiverStreet = $receiverTown = $receiverDistrict = $receiverPostalCode = '';
    
            
        } else {
            echo "Not logged in as a publisher";
        }
        $deliveryDetails = $this->deliveryModel->findDeliveryById($user_id);
        $data = [
            'orderDetails'=>$orderDetails,
            'deliveryName'=>$deliveryDetails[0]->name
           
        ];
        $this->view('delivery/returnedorders',$data);
    }
    public function processedorders() {
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
    
        $deliveryid = null;
    
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
    
            $deliveryDetails = $this->deliveryModel->findDeliveryById($user_id);
            $orderDetails = $this->orderModel->findBookProOrders();
    
            $sender_id = $senderName = $receiverName = $senderStreet = $senderTown = $senderDistrict = $senderPostalCode = $receiverStreet = $receiverTown = $receiverDistrict = $receiverPostalCode = '';
    
            
        } else {
            echo "Not logged in as a publisher";
        }
        $deliveryDetails = $this->deliveryModel->findDeliveryById($user_id);
        $data = [
            'orderDetails'=>$orderDetails,
            'deliveryName'=>$deliveryDetails[0]->name
           
        ];
    
        $this->view('delivery/processedorders', $data);
    }
    public function pickedUp($order_id){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
        if($this->deliveryModel->pickedUp($order_id)){
            
            redirect('delivery/processedorders');
        }
        else{
            die('Something went wrong');
        }
    }
    public function delivered($order_id){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
        if($this->deliveryModel->delivered($order_id)){
            
            redirect('delivery/shippingorders');
        }
        else{
            die('Something went wrong');
        }
    }
    public function returned($order_id){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
        if($this->deliveryModel->returned($order_id)){
            
            redirect('delivery/shippingorders');
        }
        else{
            die('Something went wrong');
        }
    }
    public function message(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
        $user_id = $_SESSION['user_id'];
        $deliveryDetails = $this->deliveryModel->findDeliveryById($user_id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'sender_name'=>$deliveryDetails[0]->name,
                'sender_id' =>$user_id,
                'topic'=> trim($_POST['topic']),
                'message' => trim($_POST['message']),
                'user_id' => trim($_POST['receiver_id']),
                'message_err' => '',
                'topic_err' => '',
            ];

            if (empty($data['message'])) {
                $data['message_err'] = 'Please enter a message';
            }
            if (empty($data['topic'])) {
                $data['topic_err'] = 'Please enter a topic';
            }

            if (empty($data['message_err']) && empty($data['topic_err'])) {
                if ($this->deliveryModel->addMessage($data)) {
                    flash('Successfully Added');
                    redirect('delivery/processedorders');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('delivery/message', $data);
            }
        } else {
            $data = [

                'sender_id'=>'',
                'topic'=>'',
                'message' => '',
                'user_id' => '',
                'message_err' => '',
                'topic_err'=>''
            ];

            $this->view('delivery/message', $data);
        }
       
    }

    public function viewMessage($message_id){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
        $deliveryid = null;
    
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            
            $deliveryDetails = $this->deliveryModel->findDeliveryById($user_id);
           
            if ($deliveryDetails) {
               
                $deliveryid = $deliveryDetails[0]->delivery_id;
              
                $messageDetails = $this->deliveryModel->findMessageByUserId($user_id);
                $messageDetails2 = $this->deliveryModel->getMessageById($message_id);
                
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a publisher";
        }
    
        $data = [
            'deliveryid' => $deliveryid,
            'deliveryDetails' => $deliveryDetails,
            'messageDetails' => $messageDetails,
            'messageDetails2' => $messageDetails2,
            'deliveryName'  =>$deliveryDetails[0] ->name
        ];
    

        $this->view('delivery/viewMessage',$data);
    }
    
    

}