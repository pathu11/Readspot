
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require APPROOT . '\vendor\autoload.php';
class PurchaseOrder extends Controller{
    private $customerModel;
    private $deliveryModel;
    private $publisherModel;
    private $ordersModel;
    private $userModel;
    private $adminModel;
    private $chatModel;
  
    private $db;
    public function  __construct(){
        $this->customerModel=$this->model('Customers');
        $this->deliveryModel=$this->model('Deliver');
        $this->userModel=$this->model('User');
        $this->ordersModel=$this->model('Orders');
        $this->publisherModel=$this->model('Publishers')  ;
        $this->adminModel=$this->model('Admins')  ;
        $this->chatModel=$this->model('Chat')  ;
        $this->db = new Database();
    }
    

public function purchase($book_id) {
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {    
            $user_id = $_SESSION['user_id'];
            $bookDetails=$this->customerModel->findBookById($book_id);
            $customerDetails = $this->customerModel->findCustomerById($user_id); 
            $deliveryDetails=$this->deliveryModel->finddeliveryCharge(); 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
                                             // sanitize post data
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $data=[
                    'book_id'=>$book_id,
                    'customer_id' => $customerDetails[0]->customer_id,
                    'postal_name' => trim($_POST['postal_name']),
                    'street_name' => trim($_POST['street_name']),
                    'town' => trim($_POST['town']),
                    'district' => trim($_POST['district']),
                    'postal_code' => trim($_POST['postal_code']),
                    'contact_no'=>trim($_POST['contact_no']),
                    'total_cost' => trim($_POST['totalCost']),
                    'total_weight'=>trim($_POST['totalWeight']),
                    'totalDelivery'=>trim($_POST['totalDelivery']),
                    'quantity' => trim($_POST['quantity']), 
                    'postal_name_err' => '',
                    'street_name_err' => '',
                    'town_err' => '',
                    'district_err' => '',
                    'postal_code_err' => '',
                    'contact_no_err'=>''
                ];
                $_SESSION['PurchaseOrderData']=$data;
                // var_dump($data);
                 
                if(empty($data['postal_name'])){
                    $data['postal_name_err']='Please enter the  name';      
                }
                
                if(empty($data['street_name'])){
                    $data['street_name_err']='Please enter street name';      

                }
                
                if(empty($data['town'])){
                    $data['town_err']='Please enter the town';      
                }
                if(empty($data['contact_no'])){
                    $data['contact_no_err']='Please enter the contact number';      
                }else if(strlen($data['contact_no'])<10){
                    $data['contact_no_err']='Please enter a valid contact number';
                }
                if(empty($data['district'])){
                    $data['district_err']='Please select the district';      
                }
                if(empty($data['postal_code'])){
                    $data['postal_code_err']='Please enter the postal code';      
                }

                if( empty($data['postal_name_err']) && empty($data['street_name_err']) && empty($data['town_err']) &&empty($data['district_err']) && empty($data['postal_code_err'])  && empty($data['contact_no_err'])   ){  
                    // print_r($data);
                    // if($this->customerModel->addOrder($data)){
                    //     $orderId = $this->customerModel-> getLastInsertedOrderId();
                    redirect('PurchaseOrder/checkout2/');
                    // }else{
                    //   echo  '<script>alert("Error")</script>';
                    // }

                }else{
                    
                    echo  '<script>alert("Error")</script>';
                    }       
              
            } else {
                // Your existing code for displaying the form
                $customerDetails = $this->customerModel->findCustomerById($user_id);
               
                 if($customerDetails)   {
                    $data = [
                        'deliveryDetails'=>$deliveryDetails,
                        'bookDetails'=>$bookDetails,
                        'book_id'=>$book_id,
                        'postal_name' => $customerDetails[0]->postal_name,
                        'street_name' => $customerDetails[0]->street_name,
                        'town' => $customerDetails[0]->town,
                        'district' => $customerDetails[0]->district,
                        'postal_code' => $customerDetails[0]->postal_code,
                        'contact_no'=>'',
                        'contact_no_err'=>'',
                        'postal_name_err'=>'',
                        'street_name_err'=>'',
                        'town_err'=>'',
                        'district_err'=>'',
                        'postal_code_err'=>'',
                        'customerDetails' => $customerDetails,
                        'customerName' => $customerDetails[0]->name
                    ];
                 }  else{
                    echo "Not found data";
                 }  
                
                // print_r($data);
            $this->view('customer/purchase',$data);
        }
    }
} 

public function checkout2()
{
    if (!isLoggedIn()) {
        redirect('landing/login');
    } else {
        $orderDetails=$_SESSION['PurchaseOrderData'];
        // print_r($PurchaseOrderData);
        // $orderDetails=$this->ordersModel->getOrderById($order_id);
        // print_r($orderDetails->book_name);
   
        $book_details=$this->customerModel->findBookById($orderDetails['book_id']);
        $user_id = $_SESSION['user_id'];
        $customerDetails = $this->customerModel->findCustomerById($user_id);       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formType = $_POST['form_type'];
            if ($formType === 'cardPayment') {
                
                $this->handleCardPaymentForm($orderDetails,$formType);

            } elseif ($formType === 'onlineDeposit') {
               
                $this->handleOnlineDepositForm($orderDetails,$formType);
            }elseif ($formType === 'COD') {
                
                $this->handleCODForm($orderDetails,$formType);
            }

        } else {
            
            $data = [
                // 'order_id'=>$order_id,
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name,
                'orderDetails'=>$orderDetails,
                'bookDetails'=>$book_details
                
            ];
    
            $this->view('customer/checkout2', $data);
        }     
    }
}
private function handleCardPaymentForm($orderDetails, $formType)
{
    if($this->customerModel->addOrder($orderDetails)){
        $order_id = $this->customerModel-> getLastInsertedOrderId();
       
   }else{
       echo  '<script>alert("Error")</script>';
    }
    $orderDetails=$this->ordersModel->getOrderById($order_id);
    // $book_details=$this->customerModel->findBookById($orderDetails['book_id']);
    $amount = $orderDetails[0]->total_price; // You may need to adjust this value
    $merchant_id = MERCHANT_ID; // Your merchant ID
    $order_id = $order_id; // Generate a unique order ID
    $merchant_secret =MERCHANT_SECRET; // Your merchant secret
    $currency = "LKR"; // Currency code

    // Calculate hash for payment
    $hash = strtoupper(
        md5(
            $merchant_id . 
            $order_id . 
            number_format($amount, 2, '.', '') . 
            $currency .  
            strtoupper(md5($merchant_secret)) 
        ) 
    );
    // print_r($hash);

    // Prepare payment details for JSON response
    $paymentDetails = [
        "items" =>$orderDetails->book_name, // Adjust based on your products
        "first_name" => $orderDetails->first_name, // Customer's first name
        "last_name" => $orderDetails->last_name, // Customer's last name
        "email" => $orderDetails->email, // Customer's email
        "phone" => $orderDetails[0]->contact_no, // Customer's phone number
        "address" => $orderDetails[0]->c_street_name, // Customer's address
        "city" => $orderDetails[0]->c_town, // Customer's city
        "amount" => $amount, // Total payment amount
        "merchant_id" => $merchant_id, // Merchant ID
        "order_id" => $order_id, // Order ID
        "merchant_secret" => $merchant_secret, // Merchant secret
        "currency" => $currency, // Currency code
        "hash" => $hash, // Payment hash
    ];

    // Convert payment details to JSON
    $jsonObj = json_encode($paymentDetails);

    // Send JSON response
    echo $jsonObj;
}

private function handleCODForm($orderDetails ,$formType){


    if($this->customerModel->addOrder($orderDetails)){
         $order_id = $this->customerModel-> getLastInsertedOrderId();
        
    }else{
        echo  '<script>alert("Error")</script>';
     }

    $user_id = $_SESSION['user_id'];
    $customerDetails = $this->customerModel->findCustomerById($user_id);
    $customer_id=$customerDetails[0]->customer_id;
    $trackingNumber=$this->generateUniqueTrackingNumber($order_id);
    $orderDetails = $this->adminModel->getOrderDetailsById($order_id);
    $orderedCustomerDetails=$this->adminModel->getCustomerDetailsById($orderDetails[0]->customer_id);
    $customerEmail=$orderedCustomerDetails[0]->email;

    echo $customerEmail;
    $topic = "New Order Details";
    $message ="Congratulations! Your order has been processing now. Order will be received at home as soon as possible.";
    $messageToPublisher = "Congratulations! You have a new order. Login to the site and visit your order status by this tracking number " . $orderDetails[0]->tracking_no;

    $book_id = $orderDetails[0]->book_id;
    $bookDetails = $this->adminModel->getBookDetailsById($book_id);

    if ($bookDetails[0]->type == 'new') {
        $user_idPub = $bookDetails[0]->publisher_id;
        $ownerDetails = $this->adminModel->getPublisherDetailsById($user_idPub);
        $ownerEmail = $ownerDetails[0]->email;
    } else if ($bookDetails[0]->type == 'used' || $bookDetails[0]->type == 'exchanged') {
        $user_idPub = $bookDetails[0]->customer_id;
        $ownerDetails = $this->adminModel->getPublisherDetailsById($user_idPub);
        $ownerEmail = $ownerDetails[0]->email;
    }

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $data = [
        'customer_id' => $customer_id,
        'order_id'=>$order_id,
        'formType'=>$formType,
        'trackingNumber'=>$trackingNumber,
        'topic' => $topic,
        'messageToPublisher' => $messageToPublisher,
        'message'=>$message,
        'user_id'=>$orderedCustomerDetails[0]->user_id,
        'user_idPub' => $ownerDetails[0]->user_id,
        'sender_name'=>'system administration',
        'sender_id'=>130,   
    ];
        //make sure errors are empty
        if( $data['trackingNumber']  ){
            if($this->customerModel->editOrderCOD($data) &&
            $this->adminModel->addMessage($data) &&
            $this->adminModel->addMessageToPublisher($data)){

                $this->sendEmails($customerEmail, $ownerEmail, $data);
                echo '<script>alert("You are placed an order successfully")</script>';
                flash('update_success','You are placed an order successfully');
                redirect('customer/Order');
               
            }else{
                die('Something went wrong');
            }
        }else{
                $this->view('customer/checkout2',$data);
            }
}
private function handleOnlineDepositForm($orderDetails, $formType)
{
    if($this->customerModel->addOrder($orderDetails)){
        $order_id = $this->customerModel-> getLastInsertedOrderId();
       
   }else{
       echo  '<script>alert("Error")</script>';
    }

    $user_id = $_SESSION['user_id'];
    $customerDetails = $this->customerModel->findCustomerById($user_id);
    $customer_id = $customerDetails[0]->customer_id;
    $trackingNumber = $this->generateUniqueTrackingNumber($order_id);

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
    // Initialize data array
    $data = [
        'customer_id' => $customer_id,
        'order_id' => $order_id,
        'recipt' => '',
        'formType' => $formType,
        'trackingNumber' => $trackingNumber,
    ];

    // Check if receipt file is uploaded
    if (isset($_FILES['recipt']['name']) && !empty($_FILES['recipt']['name'])) {
        $recipt_name = $_FILES['recipt']['name'];
        $tmp_name = $_FILES['recipt']['tmp_name'];
        $error = $_FILES['recipt']['error'];

        // Check if there is no error in the file upload
        if ($error === 0) {
            $recipt_ex = pathinfo($recipt_name, PATHINFO_EXTENSION);
            $recipt_ex_to_lc = strtolower($recipt_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png', 'pdf');
            
            // Check if the file extension is allowed
            if (in_array($recipt_ex_to_lc, $allowed_exs)) {
                $new_recipt_name = uniqid() . '-' . $recipt_name;
                $recipt_upload_path = "../public/assets/images/customer/orderRecipt/" . $new_recipt_name;
                
                // Move the uploaded file to the destination path
                if (move_uploaded_file($tmp_name, $recipt_upload_path)) {
                    $data['recipt'] = $new_recipt_name;
                } else {
                    // Handle file upload failure
                    echo 'File upload failed';
                    return;
                }
            } else {
                // Handle invalid file type
                echo 'Invalid file type';
                return;
            }
        } else {
            // Handle file upload error
            echo 'File upload error';
            return;
        }
    }

    // Make sure errors are empty
    if ($data['trackingNumber'] && $data['recipt']) {
        if ($this->customerModel->editOrder($data)) {
            flash('update_success', 'You have placed an order successfully');
            redirect('customer/Order');
        } else {
            die('Something went wrong');
        }
    } else {
        $this->view('customer/checkout2', $data);
    }
}

private function generateUniqueTrackingNumber($orderId) {
    do {
        $timestamp = time(); // Current timestamp
        $randomNumber = mt_rand(10000, 99999); // Use a range suitable for your application
        $trackingNumber = $orderId . $timestamp . $randomNumber;
    } while ($this->ordersModel->trackingNumberExists($trackingNumber));

    return $trackingNumber;
}
private function sendEmails($customerEmail, $ownerEmail, $data) {
    $this->sendEmail($customerEmail, $data['topic'], $data['message']);
    $this->sendEmail($ownerEmail, $data['topic'], $data['messageToPublisher']);
}

private function sendEmail($recipientEmail, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = MAIL_HOST;  // Specify your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_USER; // SMTP username
        $mail->Password = MAIL_PASS; // SMTP password
        $mail->SMTPSecure = MAIL_SECURITY;
        $mail->Port = MAIL_PORT;

        // Recipients
        $mail->setFrom('readspot27@gmail.com', 'READSPOT');
        $mail->addAddress($recipientEmail);  // Add a recipient

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
    } catch (Exception $e) {
        die('Something went wrong: ' . $mail->ErrorInfo);
    }
}
public function successCardPaymentOrder(){


    $user_id = $_SESSION['user_id'];
    $customerDetails = $this->customerModel->findCustomerById($user_id);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the total_price and order_id are set in the POST data
        if (isset($_POST['total_price'], $_POST['order_id'])) {
            $totalPrice = $_POST['total_price'];
            $order_id = $_POST['order_id'];

                    
         

            $customer_id=$customerDetails[0]->customer_id;

            $trackingNumber=$this->generateUniqueTrackingNumber($order_id);
            $orderDetails = $this->adminModel->getOrderDetailsById($order_id);
            $orderedCustomerDetails=$this->adminModel->getCustomerDetailsById($orderDetails[0]->customer_id);
            $customerEmail=$orderedCustomerDetails[0]->email;
            echo $customerEmail;
            $topic = "New Order Details";
            $message ="Congratulations! Your order has been processing now. Order will be received at home as soon as possible.";
            $messageToPublisher = "Congratulations! You have a new order. Login to the site and visit your order status by this tracking number " . $orderDetails[0]->tracking_no;

            $book_id = $orderDetails[0]->book_id;
            $bookDetails = $this->adminModel->getBookDetailsById($book_id);

            if ($bookDetails[0]->type == 'new') {
                $user_idPub = $bookDetails[0]->publisher_id;
                $ownerDetails = $this->adminModel->getPublisherDetailsById($user_idPub);
                $ownerEmail = $ownerDetails[0]->email;
            } else if ($bookDetails[0]->type == 'used' || $bookDetails[0]->type == 'exchanged') {
                $user_idPub = $bookDetails[0]->customer_id;
                $ownerDetails = $this->adminModel->getPublisherDetailsById($user_idPub);
                $ownerEmail = $ownerDetails[0]->email;
            }

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'customer_id' => $customer_id,
                'order_id'=>$order_id,
                'formType'=>"cardPayment",
                'trackingNumber'=>$trackingNumber,
                'topic' => $topic,
                'messageToPublisher' => $messageToPublisher,
                'message'=>$message,
                'user_id'=>$orderedCustomerDetails[0]->user_id,
                'user_idPub' => $ownerDetails[0]->user_id,
                'sender_name'=>'system administration',
                'sender_id'=>130,   
            ];
                //make sure errors are empty
                if( $data['trackingNumber']  ){
                    if($this->customerModel->editOrderCardPayment($data) &&
                    $this->adminModel->addMessage($data) &&
                    $this->adminModel->addMessageToPublisher($data)){

                        $this->sendEmails($customerEmail, $ownerEmail, $data);
                        echo '<script>alert("You are placed an order successfully")</script>';
                        flash('update_success','You are placed an order successfully');
                        redirect('customer/Order');
                    
                    }else{
                        die('Something went wrong');
                    }
                }else{
                        $this->view('customer/checkout2',$data);
                    }
            
                    
                }
    }
}
} 
