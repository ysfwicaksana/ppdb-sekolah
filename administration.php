<?php
  session_start();

  require './libraries/conn.php';

  // cek session berdasarkan role
  if ( $_SESSION['login'] !== 'user' ) {
    $_SESSION = [];
    session_unset();
    session_destroy();

    header("Location: index.php");
    exit;
  } 

  $jurusan = show_data("SELECT * FROM jurusan");

  // cek apakah user sudah melakukan registrasi atau belum
  $id = $_SESSION['id'];
  $result = mysqli_query($conn, "SELECT * FROM registrasi WHERE user_id = $id");

  if (mysqli_fetch_assoc($result)) {
    header("Location: advanced-administration.php");
    exit;
  }

  if( isset($_POST['submit-data']) ) {
    if ( administration($_POST, $id) > 0  ) {
      header("Location: advanced-administration.php");
    }
  }
  
  // header
  require './layouts/header.php';
?>

  <div class="administration-contents" style="margin-top: 70px;">
    <div class="container d-flex justify-content-center">
      <form action="" method="post" class="d-flex flex-column mb-3 gap-2 administration-form">
        <select class="form-select" aria-label="Default select example" name="jurusan_id" required>
          <option selected>Pilih Jurusan</option>
          <?php foreach($jurusan as $j) : ?>
            <option value="<?= $j['id'] ?>"><?= $j['nama_jurusan'] ?></option>
          <?php endforeach; ?>
        </select>
        <select class="form-select" aria-label="Default select example" name="jenis_kelamin" required>
          <option selected>Pilih Jenis Kelamin</option>
          <option value="L">Laki - laki</option>
          <option value="P">Perempuan</option>
        </select>
        <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" required>
        <input type="date" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir" required>
        <input type="text" class="form-control" placeholder="Alamat" name="alamat" required>
        <button type="submit" name="submit-data" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
    
<?php 
  // footer
  require './layouts/footer.php'
?>