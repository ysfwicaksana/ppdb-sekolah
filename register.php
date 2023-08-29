<?php 
  session_start();

  require_once './libraries/conn.php';

  // cek session berdasarkan role
  if ( isset($_SESSION['login']) ) {
    if ( $_SESSION['login'] === 'user' ) {
      header("Location: dashboard.php");
      exit;
    } else if ( $_SESSION['login'] === 'admin' ) {
      header("Location: admin/index.php");
      exit;
    }
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
      
      header("Location: dashboard.php");
    }
  }

  // header
  include './layouts/header.php';
  include './layouts/sidebar.php';
?>

  <div class="register-contents" style="margin-top: 70px;">
    <div class="container d-flex justify-content-center">
      <form action="" method="post" class="d-flex flex-column mb-3 gap-2 register-form">
        <h4>Registrasi</h4>
        <input type="text" class="form-control" placeholder="Nama" name="nama" required/>
        <input type="text" class="form-control" placeholder="Email" name="email" required/>
        <input type="password" class="form-control" placeholder="Password" name="password" required />
        <input type="password" class="form-control" placeholder="Konfirmasi Password"
              name="konfirmasi-password" required />
        <button type="submit" name="submit" class="btn btn-primary">Daftar</button>
        <p>Sudah mempunyai akun? <a href="login.php" style="text-decoration: none;">Masuk</a></p>
      </form>
    </div>
  </div>
    
<?php
  // footer
  include './layouts/footer.php';
?>