<?php
    require '../libraries/conn.php';
    
    session_start();

    $students = show_data("SELECT r.id, u.nama, r.tempat_lahir, r.tanggal_lahir, r.jenis_kelamin, r.status FROM registrasi r
    LEFT JOIN `user` u ON r.user_id = u.id ORDER BY r.id DESC");

    if ( isset($_POST['submit-keyword']) ) {
        $students = search($_POST['keyword']);
    }

    // header
    require '../layouts/header-admin.php';
?>

<div class="dashboard-contents" style="margin-top: 70px;">
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
                <th scope="col">Verifikasi</th>
              </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
              <?php foreach ( $students as $student ) : ?>
                <tr>
                  <th scope="row"><?= $i ?></th>
                  <td><?= $student['nama'] ?></td>
                  <td><?= $student['tempat_lahir'] ?></td>
                  <td><?= $student['tanggal_lahir'] ?></td>
                  <td><?= $student['jenis_kelamin'] ?></td>
                  <?php if ( $student['status'] === 'pending' ) : ?>
                    <td><span class="pending"><?= $student['status'] ?></span></td>
                  <?php elseif ( $student['status'] === 'accept' ) : ?>
                    <td><span class="accept"><?= $student['status'] ?></span></td>
                  <?php else : ?>
                    <td><span class="reject"><?= $student['status'] ?></span></td>
                  <?php endif; ?>
                  <?php if ( $student['status'] !== 'accept' && $student['status'] !== 'reject' ) : ?>
                    <td><a class="btn btn-secondary" href="verification.php?id=<?= $student['id'] ?>">Verifikasi</a></td>
                  <?php else: ?>
                    <td><a class="btn btn-secondary" href="verification.php?id=<?= $student['id'] ?>" style="pointer-events: none; background-color: #8c949c; border: 1px solid #8c949c">Verifikasi</a></td>
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

    require '../layouts/footer.php';

?>