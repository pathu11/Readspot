
<?php
class Charity extends Controller{
    public function  __construct(){
       
    }
    public function index(){

        
        $this->view('charity/index');
    }
    public function event(){
        $this->view('charity/event-management');
    }
    public function test(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
            // sanitize post data
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $data=[
           
            'name' => trim($_POST['name']),
            'age' => trim($_POST['age']),
            ];
            
            $_SESSION['data'] = $data;

        }

        $this->view('charity/test');
    }
    public function test2(){
        $data1 = $_SESSION['data'];
        $data=[
            'data1'=>$data1

        ];
        // print_r($data['name']);
        $this->view('charity/test2',$data);
    }

}
