<?php
  session_start();

  require './libraries/conn.php';

  // cek cookie
  if ( isset($_SESSION['id']) && isset($_COOKIE['email']) ) {
    if ( $_SESSION['login'] === 'user' ) {
      header("Location: dashboard.php");
      exit;
    } else {
      header("Location: index.php");
      exit;
    }
  }

  if ( isset($_POST['submit']) ) {

    if ( loginAccount($_POST) ) {
      echo "
            <script type='text/javascript'>
              document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil', 
                  html: '<p class="."p-popup".">Email atau password salah!</p>',
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
  <div class="login-contents" style="margin-top: 70px;">
    <div class="container d-flex justify-content-center">
      <form action="" method="post" class="d-flex flex-column mb-3 gap-2 login-form">
          <input type="text" class="form-control" placeholder="Email" name="email" required>
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <button type="submit" name="submit" class="btn btn-primary">Masuk</button>
          <p>Belum mempunyai akun? <a href="register.php" style="text-decoration: none;">Daftar</a></p>
      </form>
    </div>
  </div>
    
<?php
  // footer
  require './layouts/footer.php';
?>