<?php 

    require 'conn.php';

    $id = $_GET['id'];

    if ( accept($id) > 0 ) {
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

        header("Location: ../admin/dashboard.php");
    }

?>