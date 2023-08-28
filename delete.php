<?php 
    session_start();

    require './libraries/conn.php';

    // cek session berdasarkan role
    if ( $_SESSION['login'] !== 'user' ) {
        header("Location: index.php");
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