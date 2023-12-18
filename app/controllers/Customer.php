<?php 
class Customer extends Controller {
    private $customerModel;
  
    private $userModel;
  
    private $db;
    public function __construct(){
        $this->customerModel=$this->model('Customers');
        $this->userModel=$this->model('User');  
        $this->db = new Database();
    }
    public function comment() {
        if (!isLoggedIn()) {
            redirect('landing/login');
        }

        $user_id = $_SESSION['user_id'];
        $customerDetails = $this->customerModel->findCustomerById($user_id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => $customerDetails[0]->name,
                'comment' => trim($_POST['comment']),
                'parentComment' => trim($_POST['parentComment']),
                'comment_err' => '',
            ];

            if (empty($data['comment'])) {
                $data['comment_err'] = 'Please enter a comment';
            }

            if (empty($data['comment_err'])) {
                if ($this->customerModel->addComment($data)) {
                    flash('Successfully Added');
                    redirect('customer/comment');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('customer/comment', $data);
            }
        } else {
            $data = [
                'comment' => '',
                'parentComment' => '',
                'comment_err' => '',
            ];

            $this->view('customer/comment', $data);
        }
    }

    public function getComments() {
        header('Content-Type: application/json');
        $comments = $this->customerModel->getComments();
        echo json_encode($comments);
    }

    
    public function test(){
        $this->view('customer/test');
    }
    public function Home(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Home', $data);
        }
    }
    public function AboutUs(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/AboutUs', $data);
        }
    } 
    public function AddCont(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/AddCont', $data);
        }
    } 
    
    public function Addevnt(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Addevnt', $data);
        }
    } 

    public function AddExchangeBook(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/AddExchangeBook', $data);
        }
    } 
    
    public function AddUsedBook(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/AddUsedBook', $data);
        }
    } 
    
    public function BookContents(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/BookContents', $data);
        }
    } 
    
    public function BookDetails(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/BookDetails', $data);
        }
    } 
    
    public function BookEvents(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/BookEvents', $data);
        }
    } 
    
    public function Bookshelf(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Bookshelf', $data);
        }
    } 
    
    public function BuyNewBooks(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/BuyNewBooks', $data);
        }
    } 
    
    public function BuyUsedBook(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/BuyUsedBook', $data);
        }
    } 
    
    public function Cart(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Cart', $data);
        }
    } 
    
    public function ContactUs(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/ContactUs', $data);
        }
    } 
    
    public function Content(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Content', $data);
        }
    } 
    
    public function Dashboard(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Dashboard', $data);
        }
    } 
    
    public function DonateBooks(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/DonateBooks', $data);
        }
    } 

    public function Donatedetails(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Donatedetails', $data);
        }
    } 

    public function Donateform(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Donateform', $data);
        }
    } 

    // public function dropdownmenu(){

    //     $this->view('customer/dropdownmenu');
    // }

    public function Event(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Event', $data);
        }
    } 

    public function ExchangeBook(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/ExchangeBook', $data);
        }
    } 

    public function ExchangeBookDetails(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/ExchangeBookDetails', $data);
        }
    } 

    public function ExchangeBooks(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/ExchangeBooks', $data);
        }
    } 

    // public function Home(){
        
    //     $this->view('customer/Home');
    // } 

    public function Notification(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Notification', $data);
        }
    } 

    public function Profile(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name,
                'customerEmail' => $customerDetails[0]->email
            ];
            $this->view('customer/Profile', $data);
        }
    } 

    public function Services(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Services', $data);
        }
    } 

    // public function sidebar(){

    //     $this->view('customer/sidebar');
    // }

    public function updateusedbook(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/updateusedbook', $data);
        }
    } 

    public function UsedBooks(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/UsedBooks', $data);
        }
    } 

    public function ViewBook(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/ViewBook', $data);
        }
    } 

    public function viewcontent(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/viewcontent', $data);
        }
    } 

    public function viewevents(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/viewevents', $data);
        }
    } 

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
       
        unset($_SESSION['user_pass']);
        session_destroy();
        redirect('landing/index');
    }
}