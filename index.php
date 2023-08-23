<!-- header -->
  <?php
    session_start();
    require './libraries/conn.php';

    if ( isset($_SESSION['login']) ) {
      header("Location: dashboard.php");
    }

    $data = show_data("SELECT u.nama, r.tempat_lahir, r.tanggal_lahir, r.jenis_kelamin, r.status FROM registrasi r
    LEFT JOIN `user` u ON r.user_id = u.id");
    
    // header
    require './layouts/header-landing-page.php';
  ?>
    <div class="home-contents" style="margin-top: 70px;">
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
    
<!-- footer -->
<?php
  require './layouts/footer.php';
?>