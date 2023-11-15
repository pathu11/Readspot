<<<<<<< HEAD
<?php
class Pages extends Controller{
    public function  __construct(){
        $this->postModel= $this->model('Post');
    }
    public function index(){
        $posts= $this->postModel->getPosts();
        $data=[
            'posts' =>$posts
        ];
        
        $this->view('pages/index',$data);
    }
    public function about(){
        $data=[
            'title'=>'About Us'
        ];
        $this->view('pages/about',$data);
    }

=======
<?php
class Pages extends Controller{
    public function  __construct(){
        $this->postModel= $this->model('Post');
    }
    public function index(){
        $posts= $this->postModel->getPosts();
        $data=[
            'posts' =>$posts
        ];
        
        $this->view('pages/index',$data);
    }
    public function about(){
        $data=[
            'title'=>'About Us'
        ];
        $this->view('pages/about',$data);
    }

>>>>>>> 46ef4d2bb18a2134244a28ff29e0efe622c4dc2b
}