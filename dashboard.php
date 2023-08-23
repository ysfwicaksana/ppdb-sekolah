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

    $result = show_data("SELECT u.nama, r.tempat_lahir, r.tanggal_lahir, r.jenis_kelamin, r.status FROM registrasi r
    LEFT JOIN `user` u ON r.user_id = u.id");

  // header 
    require './layouts/header.php';
  ?>
    <div class="dashboard-contents" style="margin-top: 70px;">
      <div class="container">
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
    
<!-- footer -->
<?php
  require './layouts/footer.php';
?>