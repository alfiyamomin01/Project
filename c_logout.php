<?php

    //include costant.php
    include('config/constant.php');
    include('partials-frontend/c-login-check.php');
    
    //destroy the session 
    session_destroy();   //unset  $_SESSION['user']

    //redirect to login page
    header('location:'.SITEURL.'c_login.php');

?>