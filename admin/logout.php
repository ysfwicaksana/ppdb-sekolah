<?php
    session_start();

    // cek session berdasarkan role
    if ( isset($_SESSION['login']) ) {
        if ( $_SESSION['login'] === 'admin' ) {
            $_SESSION = [];
            session_unset();
            session_destroy();
        
            header("Location: ../index.php");
            exit;
        }
    }
?>