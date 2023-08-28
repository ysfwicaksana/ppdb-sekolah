<?php
    require '../libraries/conn.php';

    session_start();

    if ( $_SESSION['login'] !== 'admin' ) {
        $_SESSION = [];
        session_unset();
        session_destroy();
    
        header("Location: ../index.php");
        exit;
    }

    $id = $_GET['id'];

    if ( reject($id) > 0 ) {
        echo "
            <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                icon: 'success',
                title: 'success', 
                html: '<p class="."p-popup".">Verifikasi Berhasil!</p>',
                showConfirmButton: false,
                timer: 2000
                })
            });
            
            </script>
        ";

        header("Location: ../admin/index.php");
    }
?>