<?php
    require '../libraries/conn.php';

    $students = show_data("SELECT * FROM user WHERE role = 'user' ORDER BY id DESC");

    if ( isset($_POST['submit-keyword']) ) {
      $students = accountSearch($_POST['keyword']);
    }

    // header
    require '../layouts/header-admin.php';

?>

    <div class="student-account-contents" style="margin-top: 70px;">
      <div class="container d-flex flex-column mb-3">

        <form action="" method="post" class="d-flex flex-row mb-3 gap-2" style="width: 100%;">
          <input type="text" class="form-control" name="keyword" placeholder="Masukkan nama...">
          <button type="submit" name="submit-keyword" class="btn btn-primary">search</button>
        </form>

        <p>Daftar Akun Siswa</p>

        <div class="table-container" style="overflow: auto;">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Email</th>
              </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach ( $students as $student ) : ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $student['nama'] ?></td>
                        <td><?= $student['email'] ?></td>
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
    require '../layouts/footer.php';

?>