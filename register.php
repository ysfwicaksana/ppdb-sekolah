<?php 

  session_start();
  require './libraries/conn.php';

  $db = new Ppdb("localhost", "root", "", "ppdb_sekolah");
  $conn = $db->connect();

  if ( isset($_SESSION['login']) ) {
    header("Location: dashboard.php");
  }

  if ( isset($_POST['submit']) ) {
    if ( $db->registerAccount($conn, $_POST) > 0 ) {
      echo "
          <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', () => {
              Swal.fire({
                icon: 'success',
                title: 'success', 
                html: '<p class="."p-popup".">Akun berhasil terdaftar!</p>',
                showConfirmButton: false,
                timer: 2000
              })
            })
          </script>
        ";
    }
  }

  // header
  include './layouts/header-landing-page.php';

?>
    <div class="register-contents">
      <div class="container">
        <form action="" method="post" class="register-form">
          <input type="text" class="form-control" placeholder="Nama" name="nama">
          <input type="text" class="form-control" placeholder="Email" name="email">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <input type="password" class="form-control" placeholder="Konfirmasi Password" name="konfirmasi-password">
          <button type="submit" name="submit" class="btn btn-primary">Daftar</button>
          <p>Sudah mempunyai akun? <a href="login.php">Masuk</a></p>
        </form>
      </div>    
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="main.js"></script>
  </body>
</html>