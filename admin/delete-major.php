<?php
    require '../libraries/conn.php';

    session_start();

    // cek session berdasarkan role
    if ( $_SESSION['login'] !== 'admin' ) {
        $_SESSION = [];
        session_unset();
        session_destroy();
    
        header("Location: ../index.php");
        exit;
      }

    $id = $_GET['id'];

    if ( deleteMajor($id) > 0 ) {
        echo "
            <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                html: '<p class="."p-popup".">Jurusan berhasil dihapus!</p>',
                showConfirmButton: false,
                timer: 2000
                })
            })
            </script>
        ";

        header("Location: list-major.php");
    }
?>