<?php
class Delivery extends Controller{
    public function  __construct(){
        // $this->postModel= $this->model('Post');
    }
    public function index(){
       
        $this->view('delivery/index');
    }
    public function orders(){
       
        $this->view('delivery/orders');
    }
    public function notification(){
       
        $this->view('delivery/notification');
    }
    public function successorders(){
       
        $this->view('delivery/successorders');
    }
    public function returnedorders(){
       
        $this->view('delivery/returnedorders');
    }
    public function processedorders(){
       
        $this->view('delivery/processedorders');
    }
    public function profile(){
       
        $this->view('delivery/profile');
    }
   

}