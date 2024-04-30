<?php
// require_once 'libraries/Core.php';
class Publisher extends Controller{
    
    private $publisherModel;
    private $orderModel;
    private $userModel;
    private $adminModel;
    private $db;
    public function __construct(){
        $this->publisherModel=$this->model('Publishers');
        $this->userModel=$this->model('User');
        $this->orderModel=$this->model('Orders');
        $this->adminModel=$this->model('Admins');
        $this->db = new Database();      
        
    }
    
    public function index(){
        if (!isLoggedInPublisher()) {
            redirect('landing/login');
        } else {

            $user_id = $_SESSION['user_id'];
            $publisherDetails = $this->publisherModel->findPublisherById($user_id);
            $publisher_id =$publisherDetails[0]->publisher_id;
            $publisher_name =$publisherDetails[0]->name;
            $bookCount=$this->publisherModel->countBooks($publisher_id);
            $orderCount=$this->orderModel->countOrders($publisher_id);
            $paymentCount=$this->orderModel->countPayment($user_id);
            $orderProCount=$this->orderModel->countProOrders($publisher_id);
            $orderDelCount=$this->orderModel->countDelOrders($publisher_id);
            $orderShipCount=$this->orderModel->countShipOrders($publisher_id);
            $orderReturnedCount=$this->orderModel->countReturnedOrders($publisher_id);
            $weeklyPayments = $this->orderModel->getTotalPaymentsForCurrentMonthByWeek($user_id);
            $weeklyPaymentsJson = json_encode($weeklyPayments);

            $bookCategoryCount=$this->orderModel->getBookCategoryCountsByPublisher($publisher_id);
            $bookCategoryCountBuy=$this->orderModel->getBookCategoryCountsByPublisherBuy($publisher_id);
            $pendingPayment=$this->orderModel->getPendingPayment($user_id);
            $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
            $data = [
                'publisherDetails' => $publisherDetails, 
                'publisherName' => $publisher_name, 
                'bookCount'    =>$bookCount,
                'orderCount'    =>$orderCount,
                'paymentCount'    =>$paymentCount,
                'orderProCount'    =>$orderProCount,
                'orderDelCount'    =>$orderDelCount,
                'orderReturnedCount' =>$orderReturnedCount,
                'orderShipCount'    =>$orderShipCount,
                'publisher_id'   =>$publisher_id ,
                'publisherName'  =>$publisherDetails[0] ->name,
                'weeklyPaymentsJson'=>$weeklyPaymentsJson,
                'bookCategoryCount'=>$bookCategoryCount,
                'bookCategoryCountBuy'=>$bookCategoryCountBuy,
                'pendingPayment'=>$pendingPayment,
                'unreadCount'=>$unreadCount
            ];
        //    print_r($pendingPayment);
            $this->view('publisher/index', $data);
        } 
    }
    
    public function editPostalForBooks($book_id) {
        if(!isLoggedInPublisher()){
            redirect('landing/login');
        }else{                  
            $user_id = $_SESSION['user_id'];
            $publisherDetails = $this->publisherModel->findPublisherById($user_id);
            $storeDetails = $this->publisherModel->getPublisherStoreDetails($publisherDetails[0]->publisher_id);
            $bookDetails = $this->publisherModel->findBookById($book_id);
            $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
                    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check the value of the form_type field
            $formType = $_POST['form_type'];
            if ($formType === 'addStoreToBooks') {
                // Handle "Edit Postal for Books" form submission
                $this->handleaddStoreToBooksForm($book_id);
            } elseif ($formType === 'default_address') {
                
                $this->handleDefaultAddressForm($book_id);
            }elseif ($formType === 'selectStore') {
                
                $this->handleselectStoreForm($book_id);
            }
        } else {
            $publisher_id=$publisherDetails[0]->publisher_id;
            // Your existing code for displaying the form
            $publishers = $this->publisherModel->findPublisherBypubId($publisher_id);
                    
            $data = [
                 'book_id'=>$book_id,
                 'bookDetails'=>$bookDetails,
                 'storeDetails'=>$storeDetails,
                 'publisherDetails' => $publisherDetails,
                 'publisher_id' =>$publisher_id,
                 
                 'postal_name' => $publishers->postal_name,
                 'street_name' => $publishers->street_name,
                 'town' => $publishers->town,
                 'district' => $publishers->district,
                 'postal_code' => $publishers->postal_code,
                 
                 'postal_name_err'=>'',
                 'street_name_err'=>'',
                 'town_err'=>'',
                 'district_err'=>'',
                 'postal_code_err'=>'',
                 'publisherName'  =>$publishers ->name,
                 'unreadCount'=>$unreadCount
            ];
    
            $this->view('publisher/editpostalForBooks', $data);
        }
    }
}
    private function handleselectStoreForm($book_id){
       
        $user_id = $_SESSION['user_id'];
        $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
        $publisherDetails = $this->publisherModel->findPublisherById($user_id);
        $publisher_id=$publisherDetails[0]->publisher_id;
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $store_id=trim($_POST['selectedStore']);
        $storeDetails=$this->publisherModel->findStoreById($store_id);

        $data = [ 
            'publisher_id' => $publisher_id,
            'book_id'=>$book_id,
            'postal_name' => $storeDetails[0]->postal_name,
            'street_name' => $storeDetails[0]->street_name,
            'town' =>$storeDetails[0]->town ,
            'district' => $storeDetails[0]->district,
            'postal_code' => $storeDetails[0]->postal_code,
            'unreadCount'=>$unreadCount
            
        ];
        if( $this->publisherModel->editpostalInBooks($data)){
            flash('update_success','You are added the store  successfully');
            redirect('publisher/editAccountForBooks/'.$book_id);
        }else{
            redirect('publisher/editpostalForBooks/'.$book_id);
        }
    }

    private function handleaddStoreToBooksForm($book_id) {
       
        $user_id = $_SESSION['user_id'];
        $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
        $publisherDetails = $this->publisherModel->findPublisherById($user_id);
        $publisher_id=$publisherDetails[0]->publisher_id;
        // $storeDetails = $this->publisherModel->getPublisherStoreDetails($publisherDetails[0]->publisher_id);
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'publisher_id' => $publisherDetails[0]->publisher_id,
            'book_id'=>$book_id,
            'postal_name' => trim($_POST['postal_name']),
            'street_name' => trim($_POST['street_name']),
            'town' => trim($_POST['town']),
            'district' => trim($_POST['district']),
            'postal_code' => trim($_POST['postal_code']),
            
            'postal_name_err' => '',
            'street_name_err' => '',
            'town_err' => '',
            'district_err' => '',
            'postal_code_err' => '',
            'unreadCount'=>$unreadCount
        ];
        
            if(empty($data['postal_name'])){
                $data['postal_name_err']="Please enter the sender's name";      
            }
            //validate ISBN
            if(empty($data['street_name'])){
                $data['street_name_err']='Please enter street name';      
            }
            //validate password
            if(empty($data['town'])){
                $data['town_err']='Please enter the town';      
            }

            
            if(empty($data['district'])){
                $data['district_err']='Please select the district';      
            }
            if(empty($data['postal_code'])){
                $data['postal_code_err']='Please enter the postal code';      
            }
        

            //make sure errors are empty
            if(  empty($data['postal_name_err']) && empty($data['street_name_err']) && empty($data['town_err']) &&empty($data['district_err']) && empty($data['postal_code_err'])   ){

        
                if($this->publisherModel->addStore($data) && $this->publisherModel->editpostalInBooks($data)){
                    flash('update_success','You are added the store  successfully');
                    redirect('publisher/editAccountForBooks/'.$book_id);
                }else{
                    die('Something went wrong');
                }
            }else{
                    $this->view('publisher/editpostalForBooks',$data);
                }
    }
    
    private function handleDefaultAddressForm($book_id) {
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'book_id'=>$book_id,
            'publisher_id' => $publisher_id,
            'postal_name' => trim($_POST['postal_name']),
            'street_name' => trim($_POST['street_name']),
            'town' => trim($_POST['town']),
            'district' => trim($_POST['district']),
            'postal_code' => trim($_POST['postal_code']),
            'postal_name_err' => '',
            'street_name_err' => '',
            'town_err' => '',
            // 'district_err' => '',
            'postal_code_err' => '',
        ];
           
            //validate book name
            if(empty($data['postal_name'])){
                $data['postal_name_err']='Please enter the  name';      
            }
            //validate ISBN
            if(empty($data['street_name'])){
                $data['street_name_err']='Please enter street name';      
            }
            //validate password
            if(empty($data['town'])){
                $data['town_err']='Please enter the town';      
            }

            
            //  if(empty($data['district'])){
            //     $data['district_err']='Please select the district';      
            // }
            if(empty($data['postal_code'])){
                $data['postal_code_err']='Please enter the postal code';      
            }
           

            //make sure errors are empty
            if( empty($data['postal_name_err']) && empty($data['street_name_err']) && empty($data['town_err']) &&empty($data['postal_code_err'])   ){                   
                if( $this->publisherModel->editpostalInBooks($data)){
                    flash('update_success','You are added the book  successfully');
                    redirect('publisher/editAccountForBooks/'.$book_id);
                }else{
                    die('Something went wrong');
                }
            }else{
                    $this->view('publisher/editpostalForBooks',$data);
                }

    }


public function editAccountForBooks($book_id) {
    if (!isLoggedInPublisher()) {
        redirect('landing/login');
    }else{

    $user_id = $_SESSION['user_id'];
    $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
    $publisherDetails = $this->publisherModel->findPublisherById($user_id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Form submitted, process the data

        // Sanitize post data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'publisher_id'=>$publisherDetails[0]->publisher_id,
             'book_id' => $book_id,
            'account_name' => trim($_POST['account_name']),
            'account_no' => trim($_POST['account_no']),
            'bank_name' => trim($_POST['bank_name']),
            'branch_name' => trim($_POST['branch_name']),
            'account_name_err' => '',
            'account_no_err' => '',
            'bank_name_err' => '',
            'branch_name_err' => '',
        ];

        if (empty($data['account_name_err']) && empty($data['account_no_err']) && empty($data['bank_name_err']) && empty($data['branch_name_err'])) {
            // If validation succeeds, update account details
            if ( $this->publisherModel->editAccountInBooks($data)  && $this->publisherModel->AddBookApproval($data)) {
                // Now add book approval

                $_SESSION['showModal'] = true;
                
                redirect('publisher/editAccountForBooks/'.$book_id);
               
            } else {
                die('Something went wrong with updating account details');
            }
        } else {
            // Validation failed, show the form with errors
            $this->view('publisher/editAccountForBooks', $data);
        }
    } else {
        // Display the form with current account details
        $publishers = $this->publisherModel->findPublisherBypubId($publisherDetails[0]->publisher_id);
        $data = [
            'book_id' => $book_id,
            'publisher_id' => $publisherDetails[0]->publisher_id,
            'account_name' => $publishers->account_name,
            'account_no' => $publishers->account_no,
            'bank_name' => $publishers->bank_name,
            'branch_name' => $publishers->branch_name,
            'account_name_err' => '',
            'account_no_err' => '',
            'bank_name_err' => '',
            'branch_name_err' => '',
            'unreadCount'=>$unreadCount
        ];
        $this->view('publisher/editAccountForBooks', $data);
    }
}
}
   
    public function customerSupport(){
        if (!isLoggedInPublisher()) {
            redirect('landing/login');
        }else{
            $publisherid = null;
        
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                
                $publisherDetails = $this->publisherModel->findPublisherById($user_id);
                $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
                if ($publisherDetails) {
                
                    $publisherid = $publisherDetails[0]->publisher_id;
                
                    $messageDetails = $this->publisherModel->findMessageByUserId($user_id);
                    $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
                    
                    
                } else {
                    echo "Not found";
                }
            } else {
                echo "Not a publisher";
            }
        
            $data = [
                'unreadCount'=>$unreadCount,
                'publisherid' => $publisherid,
                'publisherDetails' => $publisherDetails,
                'messageDetails' => $messageDetails,
                'publisherName'  =>$publisherDetails[0] ->name,
                'unreadCount'=>$unreadCount
            ];
        

            $this->view('publisher/customerSupport',$data);
    }
}

    public function viewMessage($message_id){
        if (!isLoggedInPublisher()) {
            redirect('landing/login');
        }else{
            $publisherid = null;
        
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
                $publisherDetails = $this->publisherModel->findPublisherById($user_id);
            
                if ($publisherDetails) {
                
                    $publisherid = $publisherDetails[0]->publisher_id;
                
                    $messageDetails = $this->publisherModel->findMessageByUserId($user_id);
                    $messageDetails2 = $this->publisherModel->getMessageById($message_id);
                    if($messageDetails && $messageDetails2){
                        if($this->publisherModel->changeStatus($message_id)){
                            flash('post_message', 'change status');
                        }else {
                            echo "Not found";
                        }
                    }
                } else {
                    echo "Not found";
                }
            } else {
                echo "Not a publisher";
            }
        
            $data = [
                'publisherid' => $publisherid,
                'publisherDetails' => $publisherDetails,
                'messageDetails' => $messageDetails,
                'messageDetails2' => $messageDetails2,
                'publisherName'  =>$publisherDetails[0] ->name,
                'unreadCount'=>$unreadCount
            ];
        

            $this->view('publisher/viewMessage',$data);
    }
}
    public function changeStatus($message_id){
        if($this->publisherModel->changeStatus($message_id)){
            echo json_encode(['success' => true]);
        }else{
            echo json_encode(['success' => false]);
        }
    }
    
    public function deliveredorders()
{
    if (!isLoggedInPublisher()) {
        redirect('landing/login');
    }else{

        $publisherid = null;
        $publisherDetails = null;
        $orderDetails = null;
        $customerName = null;
        $publisherName = null;

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
            $publisherDetails = $this->publisherModel->findPublisherById($user_id);

            if ($publisherDetails) {
                $publisherid = $publisherDetails[0]->publisher_id;
                $publisherName = $publisherDetails[0]->name;

                if ($publisherid) {
                    $orderDetails = $this->orderModel->findNewBookDeliveredOrdersBypubId($publisherid);

                    if ($orderDetails) {
                        foreach ($orderDetails as $order) {
                            $customerName = $order->customer_name;
                            // Additional processing if needed
                        }
                    } else {
                        // echo "No orders found";
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
            'customerName' => $customerName,
            'publisherName' => $publisherName,
            'unreadCount'=>$unreadCount
        ];

        $this->view('publisher/deliveredorders', $data);
}
}
public function processingorders()
{
    if (!isLoggedInPublisher()) {
        redirect('landing/login');
    }else{

        $publisherid = null;
        $publisherDetails = null;
        $orderDetails = null;
        $customerName = null;
        $publisherName = null;

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
            $publisherDetails = $this->publisherModel->findPublisherById($user_id);

            if ($publisherDetails) {
                $publisherid = $publisherDetails[0]->publisher_id;
                $publisherName = $publisherDetails[0]->name;

                if ($publisherid) {
                    $orderDetails = $this->orderModel->findNewBookProOrdersBypubId($publisherid);

                    if ($orderDetails) {
                        foreach ($orderDetails as $order) {
                            $customerName = $order->customer_name;
                            // Additional processing if needed
                        }
                    } else {
                        // echo "No orders found";
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
            'customerName' => $customerName,
            'publisherName' => $publisherName,
            'unreadCount'=>$unreadCount
        ];

        $this->view('publisher/processingorders', $data);
}
}

   
    public function shippedorders(){
        if (!isLoggedInPublisher()) {
            redirect('landing/login');
        }else{
            $publisherid = null;
        
            $publisherDetails = null;
            $orderDetails = null;
            $customerName = null;
            $publisherName = null;
        
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
                $publisherDetails = $this->publisherModel->findPublisherById($user_id);
        
                if ($publisherDetails) {
                    $publisherid = $publisherDetails[0]->publisher_id;
                    $publisherName = $publisherDetails[0]->name;
                    if ($publisherid) {
                        $orderDetails = $this->orderModel->findNewBookShippingOrdersBypubId($publisherid);
        
                        if ($orderDetails) {
                            // Assuming findBrandNewBookProOrdersBypubId returns an array of orders
                            foreach ($orderDetails as $order) {
                                // $publisherName = $order->publisher_name;
                                $customerName = $order->customer_name;

                            }
                        } else {
                            // echo "No orders found";
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
                'customerName' => $customerName,
                
                'publisherName'  =>$publisherName,
                'unreadCount'=>$unreadCount
            ];
            $this->view('publisher/shippedorders',$data);
    }
}
    
    public function returnedorders(){
        if (!isLoggedInPublisher()) {
            redirect('landing/login');
        }else{
            $publisherid = null;
            
            $publisherDetails = null;
            $orderDetails = null;
            $customerName = null;
            $publisherName = null;
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
                $publisherDetails = $this->publisherModel->findPublisherById($user_id);
        
                if ($publisherDetails) {
                    $publisherid = $publisherDetails[0]->publisher_id;
                    $publisherName = $publisherDetails[0]->name;
                    if ($publisherid) {
                        $orderDetails = $this->orderModel->findNewBookReturnedOrdersBypubId($publisherid);
        
                        if ($orderDetails) {
                            // Assuming findBrandNewBookProOrdersBypubId returns an array of orders
                            foreach ($orderDetails as $order) {
                                // $publisherName = $order->publisher_name;
                                $customerName = $order->customer_name;

                            }
                        } else {
                            // echo "No orders found";
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
                'customerName' => $customerName,
                
                'publisherName'  =>$publisherName,
                'unreadCount'=>$unreadCount
            ];
            $this->view('publisher/returnedorders',$data);
    }
}
    
    
    
    
    
    public function setting(){
        if (!isLoggedInPublisher()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
            // Fetch publisher details and render the view
            $publisherDetails = $this->publisherModel->findPublisherById($user_id); // Ensure the method exists in the UserModel
            $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
            $data = [
                'publisherDetails' => $publisherDetails,
                'publisherName'  =>$publisherDetails[0] ->name,
                'unreadCount'=>$unreadCount
            ];
            $this->view('publisher/setting', $data); // Ensure you are using the correct view file
        }
      
    }
    public function editpostal($publisher_id){
        if(!isLoggedInPublisher()){
            redirect('landing/login');
        }
    
        $user_id = $_SESSION['user_id'];

        $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form submitted, process the data
    
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'publisher_id' => $publisher_id,
                'postal_name' => trim($_POST['postal_name']),
                'street_name' => trim($_POST['street_name']),
                'town' => trim($_POST['town']),
                'district' => trim($_POST['district']),
                'postal_code' => trim($_POST['postal_code']),
                'postal_name_err' => '',
                'street_name_err' => '',
                'town_err' => '',
                'district_err' => '',
                'postal_code_err' => '',
            ];
               
                //validate book name
                if(empty($data['postal_name'])){
                    $data['postal_name_err']='Please enter the  name';      
                }
                //validate ISBN
                if(empty($data['street_name'])){
                    $data['street_name_err']='Please enter street name';      
                }
                //validate password
                if(empty($data['town'])){
                    $data['town_err']='Please enter the town';      
                }
    
                
                 if(empty($data['district'])){
                    $data['district_err']='Please select the district';      
                }
                if(empty($data['postal_code'])){
                    $data['postal_code_err']='Please enter the postal code';      
                }
               
    
                //make sure errors are empty
                if( empty($data['postal_name_err']) && empty($data['street_name_err']) && empty($data['town_err']) &&empty($data['district_err']) && empty($data['postal_code_err'])   ){

                   
                    
                    
                    if($this->publisherModel->editpostal($data)){
                        flash('update_success','You are added the book  successfully');
                        redirect('publisher/setting');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                        $this->view('publisher/editpostal',$data);
                    }
    
                   
            }else{
                     
                $publishers = $this->publisherModel->findPublisherBypubId($publisher_id);
               
                
                $data = [
                    'unreadCount'=>$unreadCount,
                    'publisher_id' => $publisher_id,
                    'postal_name' => $publishers->postal_name,
                    'street_name' => $publishers->street_name,
                    'town' => $publishers->town,
                    'district' => $publishers->district,
                    'postal_code' => $publishers->postal_code,
                    'postal_name_err'=>'',
                    'street_name_err'=>'',
                    'town_err'=>'',
                    'district_err'=>'',
                    'postal_code_err'=>'',
                    'publisherName'  =>$publishers ->name,
                   
                   
                ];


                $this->view('publisher/editpostal',$data);
    
            }  
    }

    public function editAccount($publisher_id){
        if(!isLoggedInPublisher()){
            redirect('landing/login');
        }
    
        $user_id = $_SESSION['user_id'];

        $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form submitted, process the data
    
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'publisher_id' => $publisher_id,
                'account_name' => trim($_POST['account_name']),
                'account_no' => trim($_POST['account_no']),
                'bank_name' => trim($_POST['bank_name']),
                'branch_name' => trim($_POST['branch_name']),
                
                'account_name_err' => '',
                'account_no_err' => '',
                'bank_name_err' => '',
                'branch_name_err' => '',
            ];
               
                //validate book name
                if(empty($data['account_name'])){
                    $data['account_name_err']='Please enter the account holder name';      
                }
                //validate ISBN
                if(empty($data['account_no'])){
                    $data['account_no_err']='Please enter correct account number';      
                }
                //validate password
                if(empty($data['bank_name'])){
                    $data['bank_name_err']='Please enter the bank name';      
                }
    
                
                 if(empty($data['branch_name'])){
                    $data['branch_name_err']='Please enter the branch name';      
                }
                
               
    
                //make sure errors are empty
                if( empty($data['account_name_err']) && empty($data['account_no_err']) && empty($data['bank_name_err']) &&empty($data['branch_name_err'])   ){

                   
                    
                    
                    if($this->publisherModel->editAccount($data)){
                        flash('update_success','You are added the book  successfully');
                        redirect('publisher/setting');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                        $this->view('publisher/editAccount',$data);
                    }
    
                   
            }else{
                     
                $publishers = $this->publisherModel->findPublisherBypubId($publisher_id);
                $data = [
                    
                    'publisher_id' => $publisher_id,
                    'account_name' => $publishers->account_name,
                    'account_no' => $publishers->account_no,
                    'bank_name' => $publishers->bank_name,
                    'branch_name' => $publishers->branch_name,
                    
                    'account_name_err' => '',
                    'account_no_err' => '',
                    'bank_name_err' => '',
                    'branch_name_err' => '',  
                    'unreadCount'=>$unreadCount
                ];
                $this->view('publisher/editAccount',$data);
            }  
    }

    public function editProfile($publisher_id){
        if(!isLoggedInPublisher()){
            redirect('landing/login');
        }
    
        $user_id = $_SESSION['user_id'];
        $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form submitted, process the data
    
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'publisher_id' => $publisher_id,
                'profile_img'=>'',
                'name' => trim($_POST['name']),
                'contact_no' => trim($_POST['contact_no']),    
                // 'profile_img_err' => '',
                'name_err' => '',
                'contact_no_err' => '',
               
            ];
               
                //validate book name
                // if(empty($data['profile_img'])){
                //     $data['profile_img_err']='Please enter the profile picture';      
                // }
                //validate ISBN
                if(empty($data['name'])){
                    $data['name_err']='Please enter the name';      
                }
                //validate password
                if(empty($data['contact_no'])){
                    $data['contact_no_err']='Please enter the contact_no';      
                }
                //make sure errors are empty
                if(  empty($data['name_err']) && empty($data['contact_no_err'])    ){
                    // Handle profile image upload
            if (isset($_FILES['profile_img']['name']) && !empty($_FILES['profile_img']['name'])) {

                $img_name = $_FILES['profile_img']['name'];
                $tmp_name = $_FILES['profile_img']['tmp_name'];
                $error = $_FILES['profile_img']['error'];

                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);

                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        $new_img_name = $user_id . $data['name'] . '-profile_img.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/profile/" . $new_img_name;

                        if (!move_uploaded_file($tmp_name, $img_upload_path)) {
                            // Handle file upload error
                            $data['profile_img_err'] = 'Error uploading profile picture';
                        } else {
                            $data['profile_img'] = $new_img_name;
                        }
                    } else {
                        $data['profile_img_err'] = 'Invalid file format. Only JPEG, JPG, and PNG files are allowed.';
                    }
                } else {
                    // Handle file upload error based on the error code
                    switch ($error) {
                        case UPLOAD_ERR_INI_SIZE:
                            $data['profile_img_err'] = 'The uploaded file exceeds the maximum upload size.';
                            break;
                        case UPLOAD_ERR_FORM_SIZE:
                            $data['profile_img_err'] = 'The uploaded file exceeds the maximum form size.';
                            break;
                        case UPLOAD_ERR_PARTIAL:
                            $data['profile_img_err'] = 'The uploaded file was only partially uploaded.';
                            break;
                        case UPLOAD_ERR_NO_FILE:
                            // No file was uploaded
                            break;
                        default:
                            $data['profile_img_err'] = 'An unknown error occurred while uploading the profile picture.';
                    }
                }
            }        
                    if($this->publisherModel->editProfile($data)){
                        flash('update_success','You are added the book  successfully');
                        redirect('publisher/setting');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                        $this->view('publisher/editProfile',$data);
                    }
    
                   
            }else{
                     
                $publishers = $this->publisherModel->findPublisherBypubId($publisher_id);
                $publisherDetails = $this->publisherModel->findPublisherById($user_id);
               
                $data = [
                    'publisherDetails' => $publisherDetails,
                    'publisherName' => $publisherDetails[0]->name,
                    'publisher_id' => $publisher_id,
                    'profile_img' => $publishers->profile_img,
                    'name' => $publishers->name,
                    'contact_no' => $publishers->contact_no,
                    'profile_img_err' => '',
                    'name_err' => '',
                    'contact_no_err' => '',
                    'unreadCount'=>$unreadCount
                   
                ];


                $this->view('publisher/editProfile',$data);
    
            }  
    }
    public function message(){
        if (!isLoggedInPublisher()) {
            redirect('landing/login');
        }
        $user_id = $_SESSION['user_id'];
        $publisherDetails = $this->publisherModel->findPublisherById($user_id);
        $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'sender_name'=>$publisherDetails[0]->name,
                'sender_id' =>$user_id,
                'parent_id'=>trim($_POST['parent_id']),
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
                if ($this->publisherModel->addMessage($data)) {
                    flash('Successfully Added');
                    redirect('publisher/customerSupport');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('publisher/message', $data);
            }
        } else {
            $data = [
                
                'sender_id'=>'',
                'parent_id'=>'',
                'topic'=>'',
                'message' => '',
                'user_id' => '',
                'message_err' => '',
                'topic_err'=>''
            ];

            $this->view('delivery/message', $data);
        }
    }
    
    

    public function markMessagesAsRead($messageIds) {
        print_r($messageIds);
        foreach ($messageIds as $messageId) {
            if($this->publisherModel->changeStatus($messageId)){
                return ['success' => true];
            }
            // Update the status of the message with $messageId to 'read'
        }
    }
   
    


    public function events(){
        if(!isLoggedInPublisher()){
            redirect('landing/login');
        }
        else{
            $user_id = $_SESSION['user_id'];
            $publisherDetails = $this->publisherModel->findPublisherById($user_id);
            $eventDetails = $this->publisherModel->getPublisherEventDetails($user_id);
            $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
            $data = [
                'publisherDetails' => $publisherDetails,
                'publisherName' => $publisherDetails[0]->name,
                'eventDetails' => $eventDetails,
                'unreadCount'=>$unreadCount
            ];
            $this->view('publisher/events',$data);
        }
    }

    public function addEvent(){
        if(!isLoggedInPublisher()){
            redirect('landing/login');
        }
       
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];
                $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
                $publisherDetails = $this->publisherModel->findPublisherById($user_id);
                $eventCategoryDetails = $this->adminModel->getEventCategories();
            }

            $data=[
                'publisherName' => $publisherDetails[0]->name,
                'user_type'=> 'Publisher',
                'user_id'=>trim($user_id),
                'title'=>trim($_POST['title']),
                'description'=>trim($_POST['description']),
                'location'=>trim($_POST['location']),
                'start_date'=>trim($_POST['start_date']),
                'end_date'=>trim($_POST['end_date']),
                'start_time'=>trim($_POST['start_time']),
                'end_time'=>trim($_POST['end_time']),
                'category'=>trim($_POST['category']),
                'poster'=>'',
                'poster1'=>'',
                'poster2'=>'',
                'poster3'=>'',
                'poster4'=>'',
                'poster5'=>'',
                'title_err'=>'',
                'description_err'=>'',
                'location_err'=>'',
                'start_date_err'=>'',
                'end_date_err'=>'',
                'start_time_err'=>'',
                'end_time_err'=>'',
                'category_err'=>''
            ];

            if(empty($data['title'])){
                $data['title_err'] = 'Please enter event title';
            }
            if(empty($data['description'])){
                $data['description_err'] = 'Please enter event description';
            }
            if(empty($data['location'])){
                $data['location_err'] = 'Please enter event location';
            }
            if(empty($data['start_date'])){
                $data['start_date_err'] = 'Please enter event date';
            }
            if(empty($data['end_date'])){
                $data['end_date_err'] = 'Please enter event end date';
            }
            if(empty($data['start_time'])){
                $data['start_time_err'] = 'Please enter event start time';
            }
            if(empty($data['end_time'])){
                $data['end_time_err'] = 'Please enter event end time';
            }
            if(empty($data['category'])){
                $data['category_err'] = 'Please select event category';
            }

            if(empty($data['title_err']) && empty($data['description_err']) && empty($data['location_err']) && empty($data['start_date_err']) && empty($data['end_date_err']) && empty($data['category_err'])){
                if (isset($_FILES['poster']['name']) AND !empty($_FILES['poster']['name'])) {
            
            
                    $img_name = $_FILES['poster']['name'];
                    $tmp_name = $_FILES['poster']['tmp_name'];
                    $error = $_FILES['poster']['error'];
                    
                    if($error === 0){
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
        
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if(in_array($img_ex_to_lc, $allowed_exs)){
                        $new_img_name = $data['title'].$data['user_id'] .'-img1.'. $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/".$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $data['poster']=$new_img_name;
                    }
                    }
                }
                if (isset($_FILES['poster1']['name']) AND !empty($_FILES['poster1']['name'])) {
            
            
                    $img_name = $_FILES['poster1']['name'];
                    $tmp_name = $_FILES['poster1']['tmp_name'];
                    $error = $_FILES['poster1']['error'];
                    
                    if($error === 0){
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
        
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if(in_array($img_ex_to_lc, $allowed_exs)){
                        $new_img_name = $data['title'].$data['user_id'] .'-img2.'. $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/".$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $data['poster']=$new_img_name;
                    }
                    }
                }
                if (isset($_FILES['poster2']['name']) AND !empty($_FILES['poster2']['name'])) {
            
            
                    $img_name = $_FILES['poster2']['name'];
                    $tmp_name = $_FILES['poster2']['tmp_name'];
                    $error = $_FILES['poster2']['error'];
                    
                    if($error === 0){
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
        
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if(in_array($img_ex_to_lc, $allowed_exs)){
                        $new_img_name = $data['title'].$data['user_id'] .'-img3.'. $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/".$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $data['poster']=$new_img_name;
                    }
                    }
                }
                if (isset($_FILES['poster3']['name']) AND !empty($_FILES['poster3']['name'])) {
            
            
                    $img_name = $_FILES['poster3']['name'];
                    $tmp_name = $_FILES['poster3']['tmp_name'];
                    $error = $_FILES['poster3']['error'];
                    
                    if($error === 0){
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
        
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if(in_array($img_ex_to_lc, $allowed_exs)){
                        $new_img_name = $data['title'].$data['user_id'] .'-img4.'. $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/".$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $data['poster']=$new_img_name;
                    }
                    }
                }
                if (isset($_FILES['poster4']['name']) AND !empty($_FILES['poster4']['name'])) {
            
            
                    $img_name = $_FILES['poster4']['name'];
                    $tmp_name = $_FILES['poster4']['tmp_name'];
                    $error = $_FILES['poster4']['error'];
                    
                    if($error === 0){
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
        
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if(in_array($img_ex_to_lc, $allowed_exs)){
                        $new_img_name = $data['title'].$data['user_id'] .'-img5.'. $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/".$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $data['poster4']=$new_img_name;
                    }
                    }
                }
                if (isset($_FILES['poster5']['name']) AND !empty($_FILES['poster5']['name'])) {
            
            
                    $img_name = $_FILES['poster5']['name'];
                    $tmp_name = $_FILES['poster5']['tmp_name'];
                    $error = $_FILES['poster5']['error'];
                    
                    if($error === 0){
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
        
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if(in_array($img_ex_to_lc, $allowed_exs)){
                        $new_img_name = $data['title'].$data['user_id'] .'-img6.'. $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/".$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $data['poster5']=$new_img_name;
                    }
                    }
                }

                if($this->publisherModel->addEvent($data)){

                    // flash('add_success','You are added the event successfully');
                    $_SESSION['showModal'] = true;
                    redirect('publisher/addEvent');
                }else{

                    die('Something went wrong');
                }
            }else{
                $this->view('publisher/addEvent',$data);
            }
        }
        
        else{
            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];
                $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
                $eventCategoryDetails = $this->adminModel->getEventCategories();
                $publisherDetails = $this->publisherModel->findPublisherById($user_id);
            }
            $data=[
                'publisherDetails' => $publisherDetails,
                'publisher_id' => $publisherDetails[0]->publisher_id,
                'publisherName' => $publisherDetails[0]->name,
                'unreadCount'=>$unreadCount,
                'eventCategoryDetails'=>$eventCategoryDetails,
                'user_type'=> 'Publisher',
                'title'=>'',
                'description'=>'',
                'location'=>'',
                'start_date'=>'',
                'end_date'=>'',
                'start_time'=>'',
                'end_time'=>'',
                'category'=>'',

                'title_err'=>'',
                'description_err'=>'',
                'location_err'=>'',
                'start_date_err'=>'',
                'end_date_err'=>'',
                'start_time_err'=>'',
                'end_time_err'=>'',
                'category_err'=>''

            ];
            $this->view('publisher/addEvent',$data);
        }
        
    }

    public function updateEvent($event_id){
        if(!isLoggedInPublisher()){
            redirect('landing/login');
        }
       
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];
                $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
                $publisherDetails = $this->publisherModel->findPublisherById($user_id);
                $eventCategoryDetails = $this->adminModel->getEventCategories();
            }
            $data=[
                'event_id'=>$event_id,
                'publisherName' => $publisherDetails[0]->name,
                'user_type'=> 'Publisher',
                'user_id'=>trim($user_id),
                'title'=>trim($_POST['title']),
                'description'=>trim($_POST['description']),
                'location'=>trim($_POST['location']),
                'start_date'=>trim($_POST['start_date']),
                'end_date'=>trim($_POST['end_date']),
                'start_time'=>trim($_POST['start_time']),
                'end_time'=>trim($_POST['end_time']),
                'category'=>trim($_POST['category']),
                'poster'=>'',
                'poster1'=>'',
                'poster2'=>'',
                'poster3'=>'',
                'poster4'=>'',
                'poster5'=>'',
                'title_err'=>'',
                'description_err'=>'',
                'location_err'=>'',
                'start_date_err'=>'',
                'end_date_err'=>'',
                'start_time_err'=>'',
                'end_time_err'=>'',
                'category_err'=>''
            ];

            if(empty($data['title'])){
                $data['title_err'] = 'Please enter event title';
            }
            if(empty($data['description'])){
                $data['description_err'] = 'Please enter event description';
            }
            if(empty($data['location'])){
                $data['location_err'] = 'Please enter event location';
            }
            if(empty($data['start_date'])){
                $data['start_date_err'] = 'Please enter event date';
            }
            if(empty($data['end_date'])){
                $data['end_date_err'] = 'Please enter event end date';
            }
            if(empty($data['start_time'])){
                $data['start_time_err'] = 'Please enter event start time';
            }
            if(empty($data['end_time'])){
                $data['end_time_err'] = 'Please enter event end time';
            }
            if(empty($data['category'])){
                $data['category_err'] = 'Please select event category';
            }

            if(empty($data['title_err']) && empty($data['description_err']) && empty($data['location_err']) && empty($data['start_date_err']) && empty($data['end_date_err']) && empty($data['category_err'])){
                if (isset($_FILES['poster']['name']) AND !empty($_FILES['poster']['name'])) {
            
            
                    $img_name = $_FILES['poster']['name'];
                    $tmp_name = $_FILES['poster']['tmp_name'];
                    $error = $_FILES['poster']['error'];
                    
                    if($error === 0){
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
        
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if(in_array($img_ex_to_lc, $allowed_exs)){
                        $new_img_name = $data['title'].$data['user_id'] .'-img1.'. $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/".$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $data['poster']=$new_img_name;
                    }
                    }
                }
                if (isset($_FILES['poster1']['name']) AND !empty($_FILES['poster1']['name'])) {
            
            
                    $img_name = $_FILES['poster1']['name'];
                    $tmp_name = $_FILES['poster1']['tmp_name'];
                    $error = $_FILES['poster1']['error'];
                    
                    if($error === 0){
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
        
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if(in_array($img_ex_to_lc, $allowed_exs)){
                        $new_img_name = $data['title'].$data['user_id'] .'-img2.'. $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/".$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $data['poster']=$new_img_name;
                    }
                    }
                }
                if (isset($_FILES['poster2']['name']) AND !empty($_FILES['poster2']['name'])) {
            
            
                    $img_name = $_FILES['poster2']['name'];
                    $tmp_name = $_FILES['poster2']['tmp_name'];
                    $error = $_FILES['poster2']['error'];
                    
                    if($error === 0){
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
        
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if(in_array($img_ex_to_lc, $allowed_exs)){
                        $new_img_name = $data['title'].$data['user_id'] .'-img3.'. $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/".$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $data['poster']=$new_img_name;
                    }
                    }
                }
                if (isset($_FILES['poster3']['name']) AND !empty($_FILES['poster3']['name'])) {
            
            
                    $img_name = $_FILES['poster3']['name'];
                    $tmp_name = $_FILES['poster3']['tmp_name'];
                    $error = $_FILES['poster3']['error'];
                    
                    if($error === 0){
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
        
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if(in_array($img_ex_to_lc, $allowed_exs)){
                        $new_img_name = $data['title'].$data['user_id'] .'-img4.'. $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/".$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $data['poster']=$new_img_name;
                    }
                    }
                }
                if (isset($_FILES['poster4']['name']) AND !empty($_FILES['poster4']['name'])) {
            
            
                    $img_name = $_FILES['poster4']['name'];
                    $tmp_name = $_FILES['poster4']['tmp_name'];
                    $error = $_FILES['poster4']['error'];
                    
                    if($error === 0){
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
        
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if(in_array($img_ex_to_lc, $allowed_exs)){
                        $new_img_name = $data['title'].$data['user_id'] .'-img5.'. $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/".$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $data['poster4']=$new_img_name;
                    }
                    }
                }
                if (isset($_FILES['poster5']['name']) AND !empty($_FILES['poster5']['name'])) {
            
            
                    $img_name = $_FILES['poster5']['name'];
                    $tmp_name = $_FILES['poster5']['tmp_name'];
                    $error = $_FILES['poster5']['error'];
                    
                    if($error === 0){
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
        
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if(in_array($img_ex_to_lc, $allowed_exs)){
                        $new_img_name = $data['title'].$data['user_id'] .'-img6.'. $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/".$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $data['poster5']=$new_img_name;
                    }
                    }
                }
                if($this->publisherModel->updateEvent($data)){  
                    redirect('publisher/events');
                }else{
                    die('Something went wrong');
                }
            }else{
                $this->view('publisher/updateEvent',$data);
            }
        } 
        else{
            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];
                $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
                $eventCategoryDetails = $this->adminModel->getEventCategories();
                $publisherDetails = $this->publisherModel->findPublisherById($user_id);
                $eventDetails=$this->publisherModel->getEventById($event_id);
            }
            $data=[
                'event_id'=>$event_id,
                'publisherDetails' => $publisherDetails,
                'publisher_id' => $publisherDetails[0]->publisher_id,
                'publisherName' => $publisherDetails[0]->name,
                'unreadCount'=>$unreadCount,
                'eventCategoryDetails'=>$eventCategoryDetails,
                'user_type'=> 'Publisher',
                'title'=>$eventDetails[0]->title,
                'description'=>$eventDetails[0]->description,
                'location'=>$eventDetails[0]->location,
                'start_date'=>$eventDetails[0]->start_date,
                'end_date'=>$eventDetails[0]->end_date,
                'start_time'=>$eventDetails[0]->start_time,
                'end_time'=>$eventDetails[0]->end_time,
                'category'=>$eventDetails[0]->category,

                'title_err'=>'',
                'description_err'=>'',
                'location_err'=>'',
                'start_date_err'=>'',
                'end_date_err'=>'',
                'start_time_err'=>'',
                'end_time_err'=>'',
                'category_err'=>''

            ];
            $this->view('publisher/updateEvent',$data);
        }
        
    }
    public function deleteEvent($event_id){
        $success = $this->publisherModel->deleteEvent($event_id);
        $response = array('success' => $success);
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    
    public function addStore(){
        if(!isLoggedInPublisher()){
            redirect('landing/login');
        }else{
    
        $user_id = $_SESSION['user_id'];
        $publisherDetails = $this->publisherModel->findPublisherById($user_id);
        $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form submitted, process the data
    
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'publisher_id' => $publisherDetails[0]->publisher_id,
               
                'postal_name' => trim($_POST['postal_name']),
                'street_name' => trim($_POST['street_name']),
                'town' => trim($_POST['town']),
                'district' => trim($_POST['district']),
                'postal_code' => trim($_POST['postal_code']),
                
                'postal_name_err' => '',
                'street_name_err' => '',
                'town_err' => '',
                'district_err' => '',
                'postal_code_err' => '',
            ];
               
                
                
                if(empty($data['postal_name'])){
                    $data['postal_name_err']="Please enter the sender's name";      
                }
                //validate ISBN
                if(empty($data['street_name'])){
                    $data['street_name_err']='Please enter street name';      
                }
                //validate password
                if(empty($data['town'])){
                    $data['town_err']='Please enter the town';      
                }
    
                
                 if(empty($data['district'])){
                    $data['district_err']='Please select the district';      
                }
                if(empty($data['postal_code'])){
                    $data['postal_code_err']='Please enter the postal code';      
                }
               
    
                //make sure errors are empty
                if( empty($data['postal_name_err']) && empty($data['street_name_err']) && empty($data['town_err']) &&empty($data['district_err']) && empty($data['postal_code_err'])   ){

             
                    if($this->publisherModel->addStore($data) ){
                        flash('update_success','You are added the store  successfully');
                        $_SESSION['showModal'] = true;
                        redirect('publisher/addStore');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                        $this->view('publisher/addStore',$data);
                    }
    
                   
            }else{
                $publisherDetails = $this->publisherModel->findPublisherById($user_id);    
                $publishers = $this->publisherModel->findPublisherBypubId($publisherDetails[0]->publisher_id);
                
                
                $data = [
                    'publisherDetails' => $publisherDetails,
                    'publisher_id' => $publisherDetails[0]->publisher_id,
                    
                    'postal_name' => '',
                    'street_name' => '',
                    'town' => '',
                    'district' => '',
                    'postal_code' => '',
                    
                    'postal_name_err'=>'',
                    'street_name_err'=>'',
                    'town_err'=>'',
                    'district_err'=>'',
                    'postal_code_err'=>'',
                    'publisherName'  =>$publishers ->name,
                    'unreadCount'=>$unreadCount
                   
                ];


                $this->view('publisher/addStore',$data);
    
            }  
    }
}

public function stores(){
    if(!isLoggedInPublisher()){
        redirect('landing/login');
    }
    else{
        $user_id = $_SESSION['user_id'];
        $publisherDetails = $this->publisherModel->findPublisherById($user_id);
        $storeDetails = $this->publisherModel->getPublisherStoreDetails($publisherDetails[0]->publisher_id);
        $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
        $data = [
            'publisherDetails' => $publisherDetails,
            'publisherName' => $publisherDetails[0]->name,
            'storeDetails' => $storeDetails,
            'unreadCount'=>$unreadCount
        ];
        $this->view('publisher/stores',$data);
    }
}

    public function updateStore($store_id){
        if(!isLoggedInPublisher()){
            redirect('landing/login');
        }else{

            $user_id = $_SESSION['user_id'];
            $publisherDetails = $this->publisherModel->findPublisherById($user_id);
            // $storeDetails=$this->publisherModel->findStoreById($store_id);
            $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'store_id'=>$store_id,
                    'publisher_id' => $publisherDetails[0]->publisher_id,
                    
                    'postal_name' => trim($_POST['postal_name']),
                    'street_name' => trim($_POST['street_name']),
                    'town' => trim($_POST['town']),
                    'district' => trim($_POST['district']),
                    'postal_code' => trim($_POST['postal_code']),
                   
                    'postal_name_err' => '',
                    'street_name_err' => '',
                    'town_err' => '',
                    'district_err' => '',
                    'postal_code_err' => '',
                ];
                
                    
                    if(empty($data['postal_name'])){
                        $data['postal_name_err']='Please enter the  name';      
                    }
                    //validate ISBN
                    if(empty($data['street_name'])){
                        $data['street_name_err']='Please enter street name';      
                    }
                    //validate password
                    if(empty($data['town'])){
                        $data['town_err']='Please enter the town';      
                    }

                    
                    if(empty($data['district'])){
                        $data['district_err']='Please select the district';      
                    }
                    if(empty($data['postal_code'])){
                        $data['postal_code_err']='Please enter the postal code';      
                    }
                

                    //make sure errors are empty
                    if(empty($data['postal_name_err']) && empty($data['street_name_err']) && empty($data['town_err']) &&empty($data['district_err']) && empty($data['postal_code_err'])   ){                    
                        if($this->publisherModel->updateStore($data) ){
                            flash('update_success','You are updated the store details  successfully');
                            redirect('publisher/stores');
                        }else{
                            die('Something went wrong');
                        }
                    }else{
                            $this->view('publisher/updateStore',$data);
                        }

                    
                }else{
                    // $publisherDetails = $this->publisherModel->findPublisherById($user_id); 
                    // $publishers = $this->publisherModel->findPublisherBypubId($publisherDetails [0]->publisher_id);
                    // var_dump()
                    $storeDetails=$this->publisherModel->findStoreById($store_id);
                    
                    $data = [
                        'publisherDetails' => $publisherDetails,
                        'store_id'=>$store_id,
                        'publisher_id' => $storeDetails[0]->publisher_Id,  // Accessing the correct property
                       
                        'postal_name' => $storeDetails[0]->postal_name,
                        'street_name' => $storeDetails[0]->street_name,
                        'town' => $storeDetails[0]->town,
                        'district' => $storeDetails[0]->district,
                        'postal_code' => $storeDetails[0]->postal_code,
                        
                        'postal_name_err'=>'',
                        'street_name_err'=>'',
                        'town_err'=>'',
                        'district_err'=>'',
                        'postal_code_err'=>'',
                        'publisherName'  =>$publisherDetails[0] ->name,
                        'unreadCount'=>$unreadCount
                    
                    ];
                    $this->view('publisher/updateStore',$data);

                }  
            }
    }
    public function deleteStore($store_id){
        if($this->publisherModel->deleteStore($store_id)){
            flash('delete_success','You deleted the store successfully');
            redirect('publisher/stores');
        }
        else{
            die('Something went wrong');
        }
      }
      public function FindOrdersByTracking(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            if (isset($_POST['tracking_no'])) {
                
                $trackingNumber = $_POST['tracking_no'];
        
                $orderDetails = $this->orderModel->FindOrdersByTracking($trackingNumber);
        
                // Return order details as JSON
                header('Content-Type: application/json');
                echo json_encode($orderDetails);
            } else {
                // Handle the case where trackingNumber parameter is not set
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Tracking number is missing in the request.']);
            }
        } else {
            // Handle non-POST requests if needed
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Invalid request method.']);
        }
    }
    public function messages(){
        if(!isLoggedInPublisher()){
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
            $publisherDetails = $this->publisherModel->findPublisherById($user_id);
            $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);

            $ChatDetails=$this->publisherModel->getChatDetailsById($user_id);
            $sender_id=$ChatDetails[0]->name;
           
            $senderDetails=$this->publisherModel->finduserDetails($sender_id);
            // print_r($senderDetails);
            $data=[
                'chatDetails'=>$ChatDetails,
                'user_id'=>$user_id,
                'publisherName'=>$publisherDetails[0]->name,
                'publisherDetails'=>$publisherDetails,
                'senderName'=>$senderDetails->name,
                'unreadCount'=>$unreadCount

//             $ChatDetails = $this->publisherModel->getChatDetailsById($user_id);
//             $senderDetails = [];
            
//             foreach($ChatDetails as $chat){
                
//                 $senderId = $chat->incoming_msg_id;
//                 if (!isset($senderDetails[$senderId])) {
//                     $senderDetails[$senderId] = $this->publisherModel->finduserDetails($senderId);
//                 }
//             }
//             $data = [
//                 'chatDetails' => $ChatDetails,
//                 'user_id' => $user_id,
//                 'publisherName' => $publisherDetails[0]->name,
//                 'publisherDetails' => $publisherDetails,
//                 'senderDetails' => $senderDetails, // Pass the sender details array
//                 'unreadCount' => $unreadCount

            ];
    
            $this->view('publisher/messages', $data);
        }
    }
    
      
public function payments(){
    if(!isLoggedInPublisher()){
        redirect('landing/login');
    }
    else{

        $user_id = $_SESSION['user_id'];
        $unreadCount = $this->publisherModel->getUnreadMessagesCount($user_id);
        $publisherDetails = $this->publisherModel->findPublisherById($user_id);
        $paymentDetails = $this->publisherModel->getPaymentDetails($user_id);
        $data = [
            'publisherDetails' => $publisherDetails,
            'publisherName' => $publisherDetails[0]->name,
            'paymentDetails' => $paymentDetails
        ];
        $this->view('publisher/payments',$data);
    }
}
public function PaymentDetails(){
    if(!isLoggedInPublisher()){
        redirect('landing/login');
        return; 
    }
    if (!isset($_GET['paymentId'])) {
        // Handle the case where paymentId is not set
        echo json_encode(array('error' => 'Payment ID is not set'));
        return; // Exit the function
    }
    $paymentId = $_GET['paymentId'];
    $paymentDetails = $this->publisherModel->getPaymentDetailsByPayId($paymentId);
    if (!$paymentDetails) {
        echo json_encode(array('error' => 'Payment details not found'));
        return; // Exit the function
    }
    echo json_encode($paymentDetails);
}

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
       
        unset($_SESSION['user_pass']);
        session_destroy();
        redirect('landing/index');
    }
}