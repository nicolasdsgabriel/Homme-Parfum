<?php
    session_start();

    if(isset($_SESSION['cliente_ID'])){
        session_destroy();
        header('location:index.php');
    }
?>