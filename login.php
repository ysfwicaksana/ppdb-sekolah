<!-- header -->
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
      $email = $_POST['email'];
      $password = $_POST['password'];

      $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

      // cek username ada atau tidak
      if ( mysqli_num_rows($result) === 1 ) {
        // cek password
        $user = mysqli_fetch_assoc($result);

        if ( password_verify($password, $user['password']) ) {
          
          // cek role
          if ( $user['role'] === 'user' ) {
            $_SESSION['login'] = true;

            // cookie
            setcookie('xyz', $user['id'], time() + 3600);
            setcookie('zyx', hash('sha256', $user['email']));

            header("Location: dashboard.php");
            exit;
          }
        }
      }

      $error = true;

      if ( isset($error) ) {
        echo "
              <script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', () => {
                  Swal.fire({
                    icon: 'error',
                    title: 'error', 
                    html: '<p class="."p-popup".">Email atau password salah!</p>',
                    showConfirmButton: false,
                    timer: 2000
                  })
                })
              </script>
            ";
      }
    }

    include './layouts/header-landing-page.php';
  ?>
    <div class="login-contents">
      <div class="container">
        <form action="" method="post" class="login-form">
            <input type="text" class="form-control" placeholder="Email" name="email">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <button type="submit" name="submit" class="btn btn-primary">Masuk</button>
            <p>Sudah mempunyai akun? <a href="register.php">Daftar</a></p>
        </form>
      </div>
    </div>
    
<!-- footer -->
<?php
  require './layouts/footer.php';
?>