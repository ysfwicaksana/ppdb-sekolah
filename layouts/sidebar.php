<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container">


    <?php if(isset($_SESSION['login'])) { ?>
        <?php if( $_SESSION['login'] === 'user' ) { ?>

            <a class="navbar-brand" href="dashboard.php">Hasil Seleksi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="my-2 navbar-nav me-auto my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="administration.php">Kelengkapan Administrasi</a>
                </li>
                </ul>
                <div class="d-flex">
                  <a href="logout.php" class="btn btn-danger btn-logout">Keluar</a>
            </div>
            </div>


        <?php } elseif ( $_SESSION['login'] === 'admin' ) { ?>

            <a class="navbar-brand" href="index.php">Hasil Seleksi</a>
              <button class="navbar-toggler"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#navbarScroll"
                      aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarScroll">
                  <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                  <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="student-account.php">Akun Siswa</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="list-major.php">Daftar Jurusan</a>
                  </li>
                  </ul>
                  <div class="d-flex">
                    <a href="logout.php" class="btn btn-danger btn-logout">Keluar</a>
                  </div>
              </div>

        <?php } ?>


    <?php } else { ?>

        <a class="navbar-brand" href="index.php">Hasil Seleksi</a>
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation"/>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;"></ul>
            <div class="d-flex gap-1">
            <a href="login.php" class="btn btn-primary">Masuk</a>
            <a href="register.php" class="btn btn-secondary">Daftar</a>
            </div>
        </div>

    <?php } ?>
  </div>
</nav>