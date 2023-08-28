<?php
    require '../libraries/conn.php';

    session_start();

    // cek session berdasarkan role
    if ( $_SESSION['login'] !== 'admin' ) {
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

    require '../layouts/footer.php';
?>