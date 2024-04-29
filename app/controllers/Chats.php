
<?php
class Chats extends Controller{
    private $chatModel;
    
    private $userModel;
  
    private $db;
    public function __construct(){
        $this->chatModel=$this->model('Chat');
        // $this->adminModel=$this->model('Admins');
        $this->userModel=$this->model('User');
        $this->db = new Database();
    }
    public function chat($incoming_id){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } 
        $isActiveNow = 0;
        $lastLogoutTime = null;
        $user_id = $_SESSION['user_id'];
        if ($this->chatModel->isActiveNow($incoming_id)) {
            $isActiveNow = 1;
        }
        $lastLogoutTime = $this->chatModel->lastLogoutTime($incoming_id);
        
        $incomingUserDetails = $this->chatModel->findUserById($incoming_id);
        $data = [
            'user_id' => $user_id,
            'incoming_id' => $incoming_id,
            'profile_img' => $incomingUserDetails[0]->profile_img,
            'name' => $incomingUserDetails[0]->name,
            'lastLogoutTime' => $lastLogoutTime, // Pass last logout time to the view
            'isActiveNow' => $isActiveNow // Pass active status to the view
        ];
        // print_r($lastLogoutTime);
        // print_r($isActiveNow);
        // Uncomment the following line to render the view
        $this->view('customer/chat', $data);
    }
    
    public function insertChat() {
        if (!isLoggedIn()) {
            redirect('landing/login');
        }

        $user_id = $_SESSION['user_id'];
        $userDetails=$this->chatModel->findUserById($user_id);
        // $customerDetails = $this->customerModel->findCustomerById($user_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                // 'name' => $customerDetails[0]->name,
                'incoming_msg_id' => trim($_POST['incoming_id']),
                'outgoing_msg_id' => $user_id,
                'message' =>trim($_POST['message']),
            ];

            if (!empty($data)) {
                if ($this->chatModel->insertChat($data)) {
                    flash('Successfully Added');
                    echo "<script>function getChat() {
                        document.querySelector('.chat-container').scrollTop = document.querySelector('.chat-container').scrollHeight;
                    }</script>";// Call JavaScript function to update chat window

                    redirect('customer/chat');
                } else {
                    die('Something went wrong');
                  
                }
            } else {
                $this->view('customer/chat', $data);
               
            }
        } else {
            $data = [
                'incoming_id' => '',
                'outgoing_id' => '',
                'message' =>'',
            ];

            $this->view('customer/chat', $data);
        }
    }


    
    public function getChat() {
        if (!isLoggedIn()) {
            redirect('landing/login');
        }

        $user_id = $_SESSION['user_id'];
        // $customerDetails = $this->customerModel->findCustomerById($user_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                // 'name' => $customerDetails[0]->name,
                'incoming_msg_id' => trim($_POST['incoming_id']),
                'outgoing_msg_id' => $user_id
                
            ];
            if (!empty($data)) {
                $messages=$this->chatModel->getChat($data);
            //    print_r($messages) ;
                $output = '';
                if($messages){
                    foreach ($messages as $message):
                        if($message->outgoing_msg_id === $data['outgoing_msg_id']){
                            $output .= '<div class="chat outgoing">
                                        <div class="details">
                                            <p>'. $message->msg .'</p>
                                        </div>
                                        </div>';
                        }else{
                            $output .= '<div class="chat incoming">
                                        <img src="'.URLROOT.'/assets/images/landing/profile/'.$message->profile_img .'" alt="">
                                        <div class="details">
                                            <p>'. $message->msg .'</p>
                                        </div>
                                        </div>';
                        }

                    endforeach;

                }else{
                    $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
                }
                echo $output;
                    
                   
            } else {
                    die('Something went wrong');
                  
            }
        } else {
                $this->view('customer/chat', $data);
               
            }
        }

       
       
       
        
    

}

