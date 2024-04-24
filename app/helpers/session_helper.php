<?php
  session_start();

//   Flash message helper
//   EXAMPLE - flash('register_success', 'You are now registered');
//   DISPLAY IN VIEW - echo flash('register_success');
  function flash($name = '', $message = '', $class = 'alert alert-success'){
    if(!empty($name)){
      if(!empty($message) && empty($_SESSION[$name])){
        if(!empty($_SESSION[$name])){
          unset($_SESSION[$name]);
        }

        if(!empty($_SESSION[$name. '_class'])){
          unset($_SESSION[$name. '_class']);
        }

        $_SESSION[$name] = $message;
        $_SESSION[$name. '_class'] = $class;
      } elseif(empty($message) && !empty($_SESSION[$name])){
        $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
        echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
        unset($_SESSION[$name]);
        unset($_SESSION[$name. '_class']);
      }
    }
  }

   function isLoggedIn(){
    if(isset($_SESSION['user_id'])){
        return true;
    }else{
        return false;
    }
   }
    
    function isLoggedInAdmin(){
      if(isset($_SESSION['user_id'])){
          
          $userRole = $_SESSION['user_role']; 
          switch($userRole) {
              case 'admin':
                  return true;
              
              default:
                  return false;
          }
      } else {
          return false;
      }
  }
  function isLoggedInPublisher(){
    if(isset($_SESSION['user_id'])){
        
        $userRole = $_SESSION['user_role']; 
        switch($userRole) {
            case 'publisher':
                return true;
            
            default:
                return false;
        }
    } else {
        return false;
    }
}
function isLoggedInCharity(){
  if(isset($_SESSION['user_id'])){
      
      $userRole = $_SESSION['user_role']; 
      switch($userRole) {
          case 'charity':
              return true;
          
          default:
              return false;
      }
  } else {
      return false;
  }
}
function isLoggedInCustomer(){
  if(isset($_SESSION['user_id'])){
      
      $userRole = $_SESSION['user_role']; 
      switch($userRole) {
          case 'customer':
              return true;
          
          default:
              return false;
      }
  } else {
      return false;
  }
}
function isLoggedInDeliver(){
  if(isset($_SESSION['user_id'])){
      
      $userRole = $_SESSION['user_role']; 
      switch($userRole) {
          case 'deliver':
              return true;
          
          default:
              return false;
      }
  } else {
      return false;
  }
}
function isLoggedInSuperAdmin(){
  if(isset($_SESSION['user_id'])){
      
      $userRole = $_SESSION['user_role']; 
      switch($userRole) {
          case 'super_admin':
              return true;
          
          default:
              return false;
      }
  } else {
      return false;
  }
}
function isLoggedInModerator(){
  if(isset($_SESSION['user_id'])){
      
      $userRole = $_SESSION['user_role']; 
      switch($userRole) {
          case 'moderator':
              return true;
          
          default:
              return false;
      }
  } else {
      return false;
  }



  
}

