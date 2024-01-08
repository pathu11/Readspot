<?php
class Controller{
    public function model($model){
        require_once '../app/model/' . $model .'.php';
        return new $model();
    }

    public function view( $view, $data=[]){
        if(file_exists('../app/views/'. $view .'.php')){
            require_once '../app/views/'. $view .'.php';
        }else{
            die('View file not exists');
        }
    
    }

    public  function generateUniqueToken($length = 32)
    {
        // Generate random bytes using openssl_random_pseudo_bytes
        $randomBytes = openssl_random_pseudo_bytes($length / 2);

        // Convert to hexadecimal
        $token = bin2hex($randomBytes);

        return $token;
    }

    public function setRememberMeCookie($token)
{
    // Set a cookie with the unique token
    setcookie('userToken', $token, time() + 30 * 24 * 60 * 60, '/', '', false, true); // 30 days expiration, domain set to '/'
}
}

