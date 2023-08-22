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

    $jurusan = show_data("SELECT * FROM jurusan");

    // cek apakah user sudah melakukan registrasi atau belum
    $id = $_COOKIE['xyz'];
    $result = mysqli_query($conn, "SELECT * FROM registrasi WHERE user_id = $id");

    if (mysqli_fetch_assoc($result)) {
      header("Location: advanced-administration.php");
      exit;
    }

    if( isset($_POST['submit-data']) ) {
      if ( kelengkapanAdministrasi($_POST, $id) > 0  ) {
        header("Location: advanced-administration.php");
      }
    }
    
    include './layouts/header.php';
  ?>

    <div class="registration-completeness-contents">
      <div class="container">
        <form action="" method="post" class="register-form">
          <select class="form-select" aria-label="Default select example" name="jurusan_id">
            <option selected>Pilih Jurusan</option>
            <?php foreach($jurusan as $j) : ?>
              <option value="<?= $j['id'] ?>"><?= $j['nama_jurusan'] ?></option>
            <?php endforeach; ?>
          </select>
          <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
            <option selected>Pilih Jenis Kelamin</option>
            <option value="L">Laki - laki</option>
            <option value="P">Perempuan</option>
          </select>
          <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir">
          <input type="date" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir">
          <input type="text" class="form-control" placeholder="Alamat" name="alamat">
          <button type="submit" name="submit-data" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
    
<!-- footer -->
<?php 
  require './layouts/footer.php'
?>