
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
    public function index(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/index', $data);
        }
    }
    public function purchaseMultiple(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
            // $deliveryDetails = $this->deliveryModel->finddeliveryCharge();
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
               
                if(isset($_POST['selectedItems']) && is_array($_POST['selectedItems'])) {
                    $selectedCartIds = $_POST['selectedItems'];
                    $bookDetails = [];
                    foreach($selectedCartIds as $cartId) {
                        $cart_id[]=$cartId;
                        $bookDetails[] = $this->customerModel->findDetailsByCartId($cartId);
                    }
                   
                } else { 
                    
                    echo "Error: No books selected" ; 
                    return;
                }
                $_SESSION['purchaseMultipleBookDetails'] = $bookDetails;
                $_SESSION['cart_id']=$cart_id;
                if($bookDetails){
                    redirect('PurchaseOrder/purchaseMultipleView');
                   
                }      
            }
}
    }   
    public function purchaseMultipleView(){
      
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {    
            $user_id = $_SESSION['user_id'];
            $bookDetails=$_SESSION['purchaseMultipleBookDetails'];
            $cart_id=$_SESSION['cart_id'];
            $bookIds = [];
            foreach ($bookDetails as $book) {
                $bookIds[] = $book[0]->book_id;
            }
            $customerDetails = $this->customerModel->findCustomerById($user_id); 
            $customer_id=$customerDetails[0]->customer_id;
            $redeem_points=$this->customerModel->FindRedeemPoints($customer_id);
            // print_r($redeem_points);
            $deliveryDetails=$this->deliveryModel->finddeliveryCharge(); 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {                                              

                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $data=[
                    'redeempoint'=>$redeem_points,
                    'cart_id'=>$cart_id,
                    'bookDetails'=>$bookDetails,
                    'book_id'=>$bookIds,
                    'customer_id' => $customerDetails[0]->customer_id,
                    'postal_name' => trim($_POST['postal_name']),
                    'street_name' => trim($_POST['street_name']),
                    'town' => trim($_POST['town']),
                    'district' => trim($_POST['district']),
                    'postal_code' => trim($_POST['postal_code']),
                    'contact_no'=>trim($_POST['contact_no']),
                    'subTotalPrice'=>trim($_POST['subTotalPrice']),
                    'total_cost' => trim($_POST['totalCost']),
                    'total_weight'=>trim($_POST['totalWeight']),
                    'totalDelivery'=>trim($_POST['totalDelivery']),
                    'bookQuantities' => $_POST['book_quantities'],
                    'totalRedeem'=>trim($_POST['totalRedeem']),
                    'postal_name_err' => '',
                    'street_name_err' => '',
                    'town_err' => '',
                    'district_err' => '',
                    'postal_code_err' => '',
                    'contact_no_err'=>''
                ];
             
                
                $_SESSION['PurchaseOrderData']=$data;
                // print_r($data);
               
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
                   
                    redirect('PurchaseOrder/checkout2/');   
                }else{
                    
                    echo  '<script>alert("Error")</script>';
                    redirect('PurchaseOrder/purchaseMultipleView/');
                    }       
              
            } else {
                // Your existing code for displaying the form
                $customerDetails = $this->customerModel->findCustomerById($user_id);
                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
               
                 if($customerDetails)   {
                    $data = [
                        'redeempoint'=>$redeem_points,
                        'book_id'=>$bookIds,
                        'deliveryDetails'=>$deliveryDetails,
                        'bookDetails'=>$bookDetails,
                        'postal_name' => $customerDetails[0]->postal_name,
                        'street_name' => $customerDetails[0]->street_name,
                        'town' => $customerDetails[0]->town,
                        'district' => $customerDetails[0]->district,
                        'postal_code' => $customerDetails[0]->postal_code,
                        'contact_no'=>$customerDetails[0]->contact_number,
                        'contact_no_err'=>'',
                        'postal_name_err'=>'',
                        'street_name_err'=>'',
                        'town_err'=>'',
                        'district_err'=>'',
                        'postal_code_err'=>'',
                        'customerDetails' => $customerDetails,
                        'customerName' => $customerDetails[0]->first_name,
                        'customerImage'=>$customerDetails[0]->profile_img,
                        'unreadNotification' => $unreadNotification
                    ];
                    // print_r($data['book_id']);
                 }  else{
                    echo "Not found data";
                 }  
              
                $this->view('customer/purchaseMultipleView',$data);
        }
    }
        // print_r($bookId);
        $this->view('customer/purchaseMultipleView',$data);
    }


public function checkout2()
{
    if (!isLoggedInCustomer()) {
        redirect('landing/login');
    } else {
        $orderDetails=$_SESSION['PurchaseOrderData'];
        $cart_id=$orderDetails['cart_id'];
        $book_details=$orderDetails['bookDetails'];
        $bookQuantities=$orderDetails['bookQuantities'];
        $user_id = $_SESSION['user_id'];
        $customerDetails = $this->customerModel->findCustomerById($user_id);   
        $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
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
                'bookQuantities'=>$bookQuantities,
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->first_name,
                'orderDetails'=>$orderDetails,
                'bookDetails'=>$book_details,
                'customerImage'=>$customerDetails[0]->profile_img,
                'unreadNotification' => $unreadNotification
                
            ];
           
  
            $this->view('customer/checkout2', $data);
        }     
    }
}

private function handleCardPaymentForm($orderDetails1, $formType)
{
    // $redeemPoints=$orderDetails1['totalRedeem'];
    // $customer_id=$orderDetails1['customer_id'];
    if ($this->customerModel->addOrder($orderDetails1)) {
        $order_id = $this->customerModel->getLastInsertedOrderId();
        foreach ($orderDetails1['book_id'] as $index => $bookId) {
            $cart_id=$orderDetails1['cart_id'][$index];
            $quantity = $orderDetails1['bookQuantities'][$index];

           if( $this->ordersModel->addOrderDetails($order_id, $bookId, $quantity)){
                $this->customerModel->deleteFromCart($cart_id);
                // $this->customerModel->updateQuantity( $quantity, $bookId);
                // $this->customerModel->updateRedeem($customer_id,$redeemPoints);
           }
        }
    } else {
        echo '<script>alert("Error")</script>';
    }
    $orderDetails=$this->ordersModel->getOrderById($order_id);
    $amount = $orderDetails[0]->total_price; 
    $merchant_id = MERCHANT_ID;
    $order_id = $order_id; 
    $merchant_secret =MERCHANT_SECRET; 
    $currency = "LKR"; 

    $hash = strtoupper(
        md5(
            $merchant_id . 
            $order_id . 
            number_format($amount, 2, '.', '') . 
            $currency .  
            strtoupper(md5($merchant_secret)) 
        ) 
    );
   
    $paymentDetails = [
        "items" =>$orderDetails[0]->book_name, 
        "first_name" => $orderDetails[0]->first_name,
        "last_name" => $orderDetails[0]->last_name, 
        "email" => $orderDetails[0]->email, 
        "phone" => $orderDetails[0]->contact_no,
        "address" => $orderDetails[0]->c_street_name,
        "city" => $orderDetails[0]->c_town, 
        "amount" => $amount, 
        "merchant_id" => $merchant_id, 
        "order_id" => $order_id, 
        "merchant_secret" => $merchant_secret,
        "currency" => $currency, 
        "hash" => $hash,
    ];
    // Convert payment details to JSON
    $jsonObj = json_encode($paymentDetails);

    // Send JSON response
    echo $jsonObj;
}

private function handleCODForm($orderDetails1 ,$formType){
    $redeemPoints=$orderDetails1['totalRedeem'];
    $customer_id=$orderDetails1['customer_id'];
    if ($this->customerModel->addOrder($orderDetails1)) {
        $order_id = $this->customerModel->getLastInsertedOrderId();
        // Add order details to the order_details table
        foreach ($orderDetails1['book_id'] as $index => $bookId) {
            $cart_id=$orderDetails1['cart_id'][$index];
            $quantity = $orderDetails1['bookQuantities'][$index];
           if( $this->ordersModel->addOrderDetails($order_id, $bookId, $quantity)){
                $this->customerModel->deleteFromCart($cart_id);
                $this->customerModel->updateQuantity( $quantity, $bookId);
                $this->customerModel->updateRedeem($customer_id,$redeemPoints);
           }    

        }
    } else {
        echo '<script>alert("Error")</script>';
    }

    $user_id = $_SESSION['user_id'];
    $customerDetails = $this->customerModel->findCustomerById($user_id);
    $customer_id=$customerDetails[0]->customer_id;
    $trackingNumber=$this->generateUniqueTrackingNumber($order_id);
    $orderDetails = $this->adminModel->getOrderDetailsById($order_id);
    

    $bookIds = $this->ordersModel->getOrderDetailsFromOrderDetailsById($order_id);


    $ownerEmails = array();
    foreach ($bookIds as $bookIdObj) {
        $bookId = $bookIdObj->book_id;
        // Fetch book details using book ID
        $bookDetails = $this->adminModel->getBookDetailsById($bookId); // Adjust this function based on your model implementation
        // Check book type
        if ($bookDetails[0]->type == 'new') {
            $user_idPub = $bookDetails[0]->publisher_id;
            $ownerDetails = $this->adminModel->getPublisherDetailsById($user_idPub);
           
        } else if ($bookDetails[0]->type == 'used' || $bookDetails[0]->type == 'exchanged') {
            $user_idPub = $bookDetails[0]->customer_id;
            $ownerDetails = $this->adminModel->getCustomerDetailsById($user_idPub);
        }
        // Store owner email in the array
        $ownerEmails[] = $ownerDetails[0]->email;
        $owner_user_id[]=$ownerDetails[0]->user_id;
    }
    
    $orderedCustomerDetails=$this->adminModel->getCustomerDetailsById($orderDetails[0]->customer_id);
   
    $customerEmail=$orderedCustomerDetails[0]->email;
    $customer_user_id=$orderedCustomerDetails[0]->user_id;
    // print_r($customerEmail);
    $topic = "New Order Details";
    $message ="Congratulations! Your order has been processing now. Order will be received at home as soon as possible.";
    $messageToPublisher = "Congratulations! You have a new order. Login to the site and visit your order status by this tracking number " . $orderDetails[0]->tracking_no;

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
        // 'user_idPub' => $ownerDetails[0]->user_id,
        'sender_name'=>'system administration',
        'sender_id'=>130,   
    ];
        //make sure errors are empty
        if( $data['trackingNumber']  ){
            // if($this->customerModel->editOrderCOD($data) &&
            // $this->adminModel->addMessage($data) &&
            // $this->adminModel->addMessageToPublisher($data)){
            if($this->customerModel->editOrderCOD($data) ){
               
                $this->sendEmails($customerEmail, $ownerEmails, $data);
                // $this->sendNotifications($data, $owner_user_id);
                // $this->customerModel->sendnotification($ $data);
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                             
                echo '<script>';
                echo 'setTimeout(function() { sweet(); }, 100);';
                echo 'function sweet() {';
                echo '    Swal.fire({';
                echo '        title: "Correct",';
                echo '        text: "You are placed an order successfully",';
                echo '        icon: "success",';

                echo '        confirmButtonText: "Ok",';
                echo '        confirmButtonColor: "#70BFBA",';
                
                echo '    }).then((result) => {';
                echo '        if (result.isConfirmed) {';
                echo '           window.location.href = "' . URLROOT . '/customer/Order'. '";';
                echo '        }';
                echo '    });';
                echo '    return false;'; // Return false to prevent form submission
                echo '}';
                echo '</script>';
        
                exit;        
                // echo '<script>alert("You are placed an order successfully")</script>';
                // flash('update_success','You are placed an order successfully');
                // redirect('customer/Order');
               
            }else{
                die('Something went wrong');
            }
        }else{
                $this->view('customer/checkout2',$data);
            }
}
private function handleOnlineDepositForm($orderDetails1, $formType)
{
    if ($this->customerModel->addOrder($orderDetails1)) {
        $order_id = $this->customerModel->getLastInsertedOrderId();
        // Add order details to the order_details table
        foreach ($orderDetails1['book_id'] as $index => $bookId) {
            $cart_id=$orderDetails1['cart_id'][$index];
            $quantity = $orderDetails1['bookQuantities'][$index];
           if( $this->ordersModel->addOrderDetails($order_id, $bookId, $quantity)){
                $this->customerModel->deleteFromCart($cart_id);
                $this->customerModel->updateQuantity( $quantity, $bookId);

           }
           

        }
    } else {
        echo '<script>alert("Error")</script>';
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
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                             
                echo '<script>';
                echo 'setTimeout(function() { sweet(); }, 100);';
                echo 'function sweet() {';
                echo '    Swal.fire({';
                echo '        title: "Correct",';
                echo '        text: "You are placed an order successfully,Wait for the verification proccess of your payment",';
                echo '        icon: "success",';

                echo '        confirmButtonText: "Ok",';
                echo '        confirmButtonColor: "#70BFBA",';
                
                echo '    }).then((result) => {';
                echo '        if (result.isConfirmed) {';
                echo '           window.location.href = "' . URLROOT . '/customer/Order'. '";';
                echo '        }';
                echo '    });';
                echo '    return false;'; // Return false to prevent form submission
                echo '}';
                echo '</script>';
        
                exit;        
            // flash('update_success', 'You have placed an order successfully');
            // redirect('customer/Order');
        } else {
            die('Something went wrong');
        }
    } else {
        $this->view('customer/checkout2', $data);
    }
}
private function sendNotifications($data, $owner_user_id)
{
    // Send notification to the customer
    $customerNotificationData = [
        'receiver_id' => $data['user_id'],
        'sender_name' => $data['sender_name'],
        'sender_id' => $data['sender_id'],
        'topic' => $data['topic'],
        'message' => $data['message'],
        'order_id' => $data['order_id'],
    ];
    $this->customerModel->addNotification($customerNotificationData);

    // Send notification to the book seller(s)
    foreach ($owner_user_id as $seller_user_id) {
        $sellerNotificationData = [
            'receiver_id' => $seller_user_id,
            'sender_name' => $data['sender_name'],
            'sender_id' => $data['sender_id'],
            'topic' => $data['topic'],
            'order_id' => $data['order_id'],
            'message' => $data['messageToPublisher']
        ];
        $this->customerModel->addNotification($sellerNotificationData);
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
private function sendEmails($customerEmail, $ownerEmails, $data) {
    foreach ($ownerEmails as $ownerEmail) {
        $this->sendEmail($ownerEmail, $data['topic'], $data['messageToPublisher']);
    }
    $this->sendEmail($customerEmail, $data['topic'], $data['message']);
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
        if (isset($_POST['total_price'], $_POST['order_id'])) {
            $totalPrice = $_POST['total_price'];
            $order_id = $_POST['order_id'];
            $customer_id = $customerDetails[0]->customer_id;

            $trackingNumber = $this->generateUniqueTrackingNumber($order_id);
            $orderDetails = $this->adminModel->getOrderDetailsById($order_id);
            $bookIds = $this->ordersModel->getOrderDetailsFromOrderDetailsById($order_id);
            $ownerEmails = array();

            foreach ($bookIds as $bookIdObj) {
                $bookId = $bookIdObj->book_id;
                $bookDetails = $this->adminModel->getBookDetailsById($bookId);
                
                if ($bookDetails[0]->type == 'new') {
                    $user_idPub = $bookDetails[0]->publisher_id;
                    $ownerDetails = $this->adminModel->getPublisherDetailsById($user_idPub);
                } else if ($bookDetails[0]->type == 'used' || $bookDetails[0]->type == 'exchanged') {
                    $user_idPub = $bookDetails[0]->customer_id;
                    $ownerDetails = $this->adminModel->getCustomerDetailsById($user_idPub);
                }

                $ownerEmails[] = $ownerDetails[0]->email;
                $owner_user_id[] = $ownerDetails[0]->email;

            }
            
            $orderedCustomerDetails = $this->adminModel->getCustomerDetailsById($orderDetails[0]->customer_id);
            $customerEmail = $orderedCustomerDetails[0]->email;

            $topic = "New Order Details";
            $message = "Congratulations! Your order has been processing now. Order will be received at home as soon as possible.";
            $messageToPublisher = "Congratulations! You have a new order. Login to the site and visit your order status by this tracking number " . $orderDetails[0]->tracking_no;

            $data = [
                'customer_id' => $customer_id,
                'order_id' => $order_id,
                'formType' => "cardPayment",
                'trackingNumber' => $trackingNumber,
                'topic' => $topic,
                'messageToPublisher' => $messageToPublisher,
                'message' => $message,
                'user_id' => $orderedCustomerDetails[0]->user_id,
                'sender_name' => 'system administration',
                'sender_id' => 130,   
            ];
            

            if ($this->customerModel->editOrderCardPayment($data)) {
                $this->sendEmails($customerEmail, $ownerEmails, $data);
                $this->sendNotifications($data, $owner_user_id);
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                             
                echo '<script>';
                echo 'setTimeout(function() { sweet(); }, 100);';
                echo 'function sweet() {';
                echo '    Swal.fire({';
                echo '        title: "Correct",';
                echo '        text: "You are placed an order successfully.Thank you for choosing us!",';
                echo '        icon: "success",';

                echo '        confirmButtonText: "Ok",';
                echo '        confirmButtonColor: "#70BFBA",';
                
                echo '    }).then((result) => {';
                echo '        if (result.isConfirmed) {';
                echo '           window.location.href = "' . URLROOT . '/customer/Order'. '";';
                echo '        }';
                echo '    });';
                echo '    return false;'; // Return false to prevent form submission
                echo '}';
                echo '</script>';
        
                exit;        
                // echo '<script>alert("You have placed an order successfully")</script>';
                // flash('update_success', 'You have placed an order successfully');
                // redirect('customer/Order');
                // $this->view('customer/Order', $data);
            } else {
                die('Something went wrong');
            }
        }
    }
}
} 
