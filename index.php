<!-- header -->
  <?php
    session_start();
    include './libraries/conn.php';

    if ( isset($_SESSION['login']) ) {
      header("Location: dashboard.php");
    }
    
    include './layouts/header-landing-page.php';
  ?>
      <div class="home-contents">
        <div class="container">
          <p>Data Seluruh Siswa</p>
          <div class="table-container">
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
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Karawang</td>
                  <td>24 Januari 2005</td>
                  <td>Laki Laki</td>
                  <td><span>Diterima</span></td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Jacob</td>
                  <td>Karawang</td>
                  <td>24 Januari 2005</td>
                  <td>Laki Laki</td>
                  <td><span>Diterima</span></td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>Larry the Bird</td>
                  <td>Karawang</td>
                  <td>24 Januari 2005</td>
                  <td>Perempuan</td>
                  <td><span>Diterima</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    
<!-- footer -->
<?php
  require './layouts/footer.php';
?>