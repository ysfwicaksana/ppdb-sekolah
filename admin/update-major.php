<?php
    require '../libraries/conn.php';

    $id = $_GET['id'];

    $jurusan = show_data("SELECT * FROM jurusan WHERE id = '$id'")[0];

    if ( isset($_POST['submit-data']) ) {
        if ( updateMajor($_POST) > 0  ) {
            echo "
            <script type='text/javascript'>
              document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                  icon: 'success',
                  title: 'success', 
                  html: '<p class="."p-popup".">Jurusan Berhasil Diubah!</p>',
                  showConfirmButton: false,
                  timer: 2000
                })
              })
            </script>
          ";

          header("Location: list-major.php");
        }
    }

    // header
    require '../layouts/header-admin.php';

?>

    <div class="add-major-contents" style="margin-top: 70px;">
        <div class="container d-flex flex-column mb-3 gap-2">
            <p>Ubah Jurusan</p>

            <form action="" method="post" class="d-flex flex-column mb-3 gap-2 form" style="width: 370px; max-width: 100%">
                <input type="text" name="id" class="form-control" readonly value="<?= $id ?>" style="display: none;">
                <input type="text" name="nama_jurusan" class="form-control" required value="<?= $jurusan['nama_jurusan'] ?>">
                <button type="submit" name="submit-data" class="btn btn-warning">Ubah Jurusan</button>
            </form>
        </div>
    </div>

<?php

    // footer
    require '../layouts/footer.php';

?>