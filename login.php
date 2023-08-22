<!-- header -->
  <?php
    session_start();
    require './libraries/conn.php';

    $db = new Ppdb("localhost", "root", "", "ppdb_sekolah");
    $conn = $db->connect();

    // cek cookie
    if ( isset($_COOKIE['xyz']) && isset($_COOKIE['zyx']) ) {
      $xyz = $_COOKIE['xyz'];
      $zyx = $_COOKIE['zyx'];

      // get email by id
      $result = mysqli_query($conn, "SELECT email FROM user WHERE id = '$xyz'");
      $user = mysqli_fetch_assoc($result);

      // cek cookie
      if ( $zyx === hash('sha256', $user['email']) ) {
        $_SESSION['login'] = true;
      } 

    }

    if ( isset($_SESSION['login']) ) {
      header("Location: dashboard.php");
    }

    if ( isset($_POST['submit']) ) {
        if ( $db->loginAccount($conn, $_POST) ) {
          echo "
          <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', () => {
              Swal.fire({
                icon: 'success',
                title: 'success', 
                html: '<p class="."p-popup".">Selamat Datang di website PPDB!</p>',
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="main.js"></script>
  </body>
</html>