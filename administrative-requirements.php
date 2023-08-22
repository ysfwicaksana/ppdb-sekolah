<!-- header -->
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
    
    include './layouts/header.php';
  ?>

    <div class="registration-completeness-contents">
      <div class="container">
        <form action="" method="post" class="register-form">
          <select class="form-select" aria-label="Default select example">
            <option selected>Pilih Jurusan</option>
            <option value="1">IPA</option>
            <option value="2">IPS</option>
          </select>
          <select class="form-select" aria-label="Default select example">
            <option selected>Pilih Jenis Kelamin</option>
            <option value="L">Laki - laki</option>
            <option value="P">Perempuan</option>
          </select>
          <input type="text" class="form-control" placeholder="Tempat Lahir">
          <input type="date" class="form-control" placeholder="Tanggal Lahir">
          <input type="text" class="form-control" placeholder="Alamat">
          <button class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="main.js"></script>
  </body>
</html>