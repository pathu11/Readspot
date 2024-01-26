
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
    public function chat($incoming_id=137){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
        // $outgoing_id=84;
        $user_id = $_SESSION['user_id'];
        $data=[
            'user_id'=>$user_id,
            'incoming_id'=>$incoming_id
        ];
        
        $this->view('customer/chat',$data);
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