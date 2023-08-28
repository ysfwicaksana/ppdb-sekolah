<?php 
    session_start();

    require './libraries/conn.php';

    if ( !isset($_SESSION['id']) && !isset($_SESSION['email']) ) {
        $_SESSION = [];
        session_unset();
        session_destroy();
    
        header("Location: login.php");
        exit;
      } 

    $id = $_GET['id'];

    if ( deleteFile($id) > 0 ) {
        echo "
            <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                icon: 'success',
                title: 'Berhasil', 
                html: '<p class="."p-popup".">Berkas berhasil dihapus!</p>',
                showConfirmButton: false,
                timer: 2000
                })
            })
            </script>
        ";

        header("Location: advanced-administration.php");
    } 
?>