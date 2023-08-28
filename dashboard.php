<?php 
  session_start();

  require './libraries/conn.php';

  if ( !isset($_SESSION['id']) && !isset($_SESSION['email']) ) {
    $_SESSION = [];
    session_unset();
    session_destroy();

    header("Location: login.php");
    exit;
  } 

  $result = show_data("SELECT r.id, u.nama, r.tempat_lahir, r.tanggal_lahir, r.jenis_kelamin, r.status FROM registrasi r
  LEFT JOIN `user` u ON r.user_id = u.id ORDER BY r.id DESC");

  // fitur pencarian
  if ( isset($_POST['submit-keyword']) ) {
    $result = search($_POST['keyword']);
  }

  // header 
  require './layouts/header.php';
?>
  <div class="dashboard-contents" style="margin-top: 70px;">
    <div class="container d-flex flex-column mb-3">

      <form action="" method="post" class="d-flex flex-row mb-3 gap-2" style="width: 100%;">
        <input type="text" class="form-control" name="keyword" placeholder="Masukkan nama...">
        <button type="submit" name="submit-keyword" class="btn btn-primary">search</button>
      </form>

      <p>Data Seluruh Siswa</p>
      <p><?= $_SESSION['email'] ?></p>

      <div class="table-container" style="overflow: auto;">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Siswa</th>
              <th scope="col">Tempat Lahir</th>
              <th scope="col">Tanggal Lahir</th>
              <th scope="col">Jenis Kelamin</th>
              <th scope="col">Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ( $result as $r ) : ?>
              <tr>
                <th scope="row"><?= $i ?></th>
                <td><?= $r['nama'] ?></td>
                <td><?= $r['tempat_lahir'] ?></td>
                <td><?= $r['tanggal_lahir'] ?></td>
                <td><?= $r['jenis_kelamin'] ?></td>
                <?php if ( $r['status'] === 'pending' ) : ?>
                  <td><span class="pending"><?= $r['status'] ?></span></td>
                <?php elseif ( $r['status'] === 'accept' ) : ?>
                  <td><span class="accept"><?= $r['status'] ?></span></td>
                <?php else : ?>
                  <td><span class="reject"><?= $r['status'] ?></span></td>
                <?php endif; ?>
              </tr>
            <?php $i++ ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
    
<?php
  // footer
  require './layouts/footer.php';
?>