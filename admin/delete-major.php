<?php
    require '../libraries/conn.php';

    session_start();

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