<?php
    if(!isset($_SESSION['adminName']))
    {
        $_SESSION['no-login-message'] = "<div class ='error text-center'> Please login to access the Admin Panel. </div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>
