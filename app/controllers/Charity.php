
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

}
