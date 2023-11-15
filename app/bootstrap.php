<<<<<<< HEAD
<?php 

require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
require_once 'config/config.php';
// require_once 'libraries/Core.php';
// require_once 'libraries/Controller.php';

// autoload classes 
spl_autoload_register(function($className){
    require_once 'libraries/'.$className.'.php';
=======
<?php 

require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
require_once 'config/config.php';
// require_once 'libraries/Core.php';
// require_once 'libraries/Controller.php';

// autoload classes 
spl_autoload_register(function($className){
    require_once 'libraries/'.$className.'.php';
>>>>>>> 46ef4d2bb18a2134244a28ff29e0efe622c4dc2b
});