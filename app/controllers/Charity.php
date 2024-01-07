
<?php
class Charity extends Controller{
    public function  __construct(){
       
    }
    public function index(){
        
        $this->view('charity/charity-home');
    }
    public function event(){
        $this->view('charity/event-management');
    }

}