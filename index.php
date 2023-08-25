<?php
  session_start();
  require './libraries/conn.php';

  if ( isset($_SESSION['login']) ) {
    header("Location: dashboard.php");
  }

  $data = show_data("SELECT r.id, u.nama, r.tempat_lahir, r.tanggal_lahir, r.jenis_kelamin, r.status FROM registrasi r
  LEFT JOIN `user` u ON r.user_id = u.id ORDER BY r.id DESC");
  
  // fitur pencarian
  if ( isset($_POST['submit-keyword']) ) {
    $data = search($_POST['keyword']);
  }

  // header
  require './layouts/header-landing-page.php';
?>
  <div class="home-contents" style="margin-top: 70px;">
    <div class="container d-flex flex-column mb-3">
      <form action="" method="post" class="d-flex flex-row mb-3 gap-2" style="width: 100%;">
        <input type="text" class="form-control" name="keyword" placeholder="Masukkan nama...">
        <button type="submit" name="submit-keyword" class="btn btn-primary">search</button>
      </form>
      <p>Data Seluruh Siswa</p>
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
            <?php $i = 1 ?>
            <?php foreach ( $data as $d  ) : ?>
            <tr>
              <th scope="row"><?= $i ?></th>
              <td><?= $d['nama'] ?></td>
              <td><?= $d['tempat_lahir'] ?></td>
              <td><?= $d['tanggal_lahir'] ?></td>
              <td><?= $d['jenis_kelamin'] ?></td>
              <?php if ( $d['status'] === 'pending' ) : ?>
                <td><span class="pending"><?= $d['status'] ?></span></td>
              <?php elseif ( $d['status'] === 'accept' ) : ?>
                <td><span class="accept"><?= $d['status'] ?></span></td>
              <?php else : ?>
                <td><span class="reject"><?= $d['status'] ?></span></td>
              <?php endif; ?>
            </tr>
            <?php $i++; ?>
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