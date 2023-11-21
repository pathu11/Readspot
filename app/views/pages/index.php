<?php 
 
// echo APPROOT ;
require APPROOT . '/views/inc/header.php';

?>
<a href="<?php echo URLROOT; ?>/pages/about">About</a>
<a href="<?php echo URLROOT; ?>/posts/test">test</a>
<br>
<ul>
    <?php foreach ($data['posts'] as $posts ) : ?>
        <li><?php echo $posts->user_role; ?></li>
    <?php endforeach; ?>
    </ul>
    

my HOME page