<?php
  session_start();

  require './libraries/conn.php';

  if ( !isset($_COOKIE['xyz']) && !isset($_COOKIE['zyx']) ) {
    $_SESSION = [];
    session_unset();
    session_destroy();

    setcookie('xyz', '', time() - 3600);
    setcookie('zyx', '', time() - 3600);

    header("Location: login.php");
    exit;
  } 

  // ambil user berdasarkan id
  $user_id = $_COOKIE['xyz'];
  $registrasi_table = mysqli_query($conn, "SELECT * FROM registrasi WHERE user_id = '$user_id'");
  $registrasi = mysqli_fetch_assoc($registrasi_table);
  $registrasi_id = $registrasi['id'];
  $result = mysqli_query($conn, "SELECT * FROM berkas_registrasi WHERE registrasi_id = '$registrasi_id'");

  if ( isset($_POST['submit-data']) ) {
    if ( advancedAdministration($_POST, $user_id) > 0 ) {
      echo "
      <script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', () => {
          Swal.fire({
            icon: 'success',
            title: 'success', 
            html: '<p class="."p-popup".">Data berhasil disimpan!</p>',
            showConfirmButton: false,
            timer: 2000
          })
        })
      </script>
    ";
    }
  }

  $files = show_data("SELECT u.nama, r.tempat_lahir, r.tanggal_lahir, r.jenis_kelamin, br.id, br.nama_berkas, br.file, r.status, j.nama_jurusan FROM berkas_registrasi br
  LEFT JOIN registrasi r ON br.registrasi_id = r.id
  LEFT JOIN jurusan j ON r.jurusan_id = j.id
  LEFT JOIN user u ON r.user_id = u.id WHERE u.id = '$user_id'");

  // header
  require './layouts/header.php';
?>
    
    <div class="advanced-administration-contents">
      <div class="container">
        <?php if ( mysqli_fetch_assoc($result) ) : ?>
          
        <div class="table-container">
          <p>Data Berkas Anda</p>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Nama Berkas</th>
                <th scope="col">File Berkas</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1 ?>
              <?php foreach ( $files as $file ) : ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $file['nama'] ?></td>
                  <td><?= $file['nama_berkas'] ?></td>
                  <td><?= $file['file'] ?></td>
                </tr>
              <?php $i++ ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        
        <?php endif; ?>

        <div class="form-container">
          <form action="" method="post" class="form" enctype="multipart/form-data">
            <input type="text" name="nama_berkas" class="form-control" placeholder="Nama Berkas" required>
            <input type="file" name="file" class="form-control" placeholder="File Berkas" required>
            <button type="submit" name="submit-data" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>


<!-- footer -->
<?php 
  require './layouts/footer.php';
?>