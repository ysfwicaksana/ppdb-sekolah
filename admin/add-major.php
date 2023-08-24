<?php
    require '../libraries/conn.php';

    if ( isset($_POST['submit-data']) ) {
        if ( addMajor($_POST) > 0 ) {
            echo "
            <script type='text/javascript'>
              document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                  icon: 'success',
                  title: 'success', 
                  html: '<p class="."p-popup".">Jurusan Berhasil Ditambahkan!</p>',
                  showConfirmButton: false,
                  timer: 2000
                })
              })
            </script>
          ";
        }
    }

    // header
    require '../layouts/header-admin.php';

?>

    <div class="add-major-contents" style="margin-top: 70px;">
        <div class="container d-flex flex-column mb-3 gap-2">
            <p>Tambah Jurusan</p>

            <form action="" method="post" class="d-flex flex-column mb-3 gap-2 form" style="width: 370px; max-width: 100%">
                <input type="text" name="nama_jurusan" class="form-control" required>
                <button type="submit" name="submit-data" class="btn btn-primary">Tambah Jurusan</button>
            </form>
        </div>
    </div>

<?php

    // footer
    require '../layouts/footer.php';

?>