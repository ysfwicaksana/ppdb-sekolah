<?php
    session_start();
    if ( isset($_SESSION['login']) ) {
        if ( $_SESSION['login'] === 'user' ) {
            $_SESSION = [];
            session_unset();
            session_destroy();
        
            header("Location: index.php");
            exit;
        }
    }
?>