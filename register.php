<?php 
  session_start();
  require './libraries/conn.php';

  // cek cookie
  if ( isset($_COOKIE['xyz']) && isset($_COOKIE['zyx']) ) {
    $xyz = $_COOKIE['xyz'];
    $zyx = $_COOKIE['zyx'];

    // ambil email berdasarkan id
    $result = mysqli_query($conn, "SELECT email FROM user WHERE id = $xyz");
    
    // ubah data yang di dapat menjadi array assosiatif
    $user = mysqli_fetch_assoc($result);

    // cek cookie dan email
    if ( $xyz === hash('sha256', $user['email']) ) {
      $_SESSION['login'] = true;
    }
  }

  if ( isset($_SESSION['login']) ) {
    header("Location: dashboard.php");
    exit;
  }

  if ( isset($_POST['submit']) ) {
    if ( registerAccount($_POST) > 0 ) {
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
      
      header("Location: login.php");
    }
  }

  // header
  include './layouts/header-landing-page.php';
?>
  <div class="register-contents" style="margin-top: 70px;">
    <div class="container d-flex justify-content-center">
      <form action="" method="post" class="d-flex flex-column mb-3 gap-2 register-form">
        <input type="text" class="form-control" placeholder="Nama" name="nama">
        <input type="text" class="form-control" placeholder="Email" name="email">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <input type="password" class="form-control" placeholder="Konfirmasi Password" name="konfirmasi-password">
        <button type="submit" name="submit" class="btn btn-primary">Daftar</button>
        <p>Sudah mempunyai akun? <a href="login.php" style="text-decoration: none;">Masuk</a></p>
      </form>
    </div>    
  </div>
    
<?php
  // footer
  require './layouts/footer.php';
?>