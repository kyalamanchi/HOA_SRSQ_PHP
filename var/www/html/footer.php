<?php

  ini_set("session.save_path","/var/www/html/session/");

  session_start();

?>

<footer class="main-footer">

    <div class="pull-right hidden-xs"></div>
        
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a target='_blank' href="<?php echo $_SESSION['hoa_community_website_url']; ?>"><?php echo $_SESSION['hoa_community_name']; ?></a>.</strong> All rights reserved.

</footer>