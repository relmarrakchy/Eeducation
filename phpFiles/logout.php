<?php
    session_start();
    session_unset();
    header('location:../login/login.php')
?>