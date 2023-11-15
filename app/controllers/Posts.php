<<<<<<< HEAD
<?php 
class Posts extends Controller {
    private $postModel;
    

    private $db;

    public function __construct() {
       
        $this->postModel = $this->model('Post');

        
        if ( !isLoggedIn()) {
            redirect('landing/login');
        }
    }

    
    public function index() {
        if (!isLoggedIn()) {
            // If not logged in, redirect to login page
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
            // Fetch posts and render the view
            $posts = $this->postModel->getPosts($user_id); // Make sure $user_id is defined
            $data = [
                'posts' => $posts
            ];
            $this->view('posts/index', $data);
        }
    }

    public function test() {
        $this->view('posts/test');
    }
}
=======
<?php 
class Posts extends Controller {
    private $postModel;
    

    private $db;

    public function __construct() {
       
        $this->postModel = $this->model('Post');

        
        if ( !isLoggedIn()) {
            redirect('landing/login');
        }
    }

    
    public function index() {
        if (!isLoggedIn()) {
            // If not logged in, redirect to login page
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
            // Fetch posts and render the view
            $posts = $this->postModel->getPosts($user_id); // Make sure $user_id is defined
            $data = [
                'posts' => $posts
            ];
            $this->view('posts/index', $data);
        }
    }

    public function test() {
        $this->view('posts/test');
    }
}
>>>>>>> 46ef4d2bb18a2134244a28ff29e0efe622c4dc2b
