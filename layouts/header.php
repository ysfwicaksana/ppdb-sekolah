<?php

  if (isset($_POST['submit'])) {
    
    $_SESSION = [];
    session_unset();
    session_destroy();
  
    setcookie('xyz', '', time() - 3600);
    setcookie('zyx', '', time() - 3600);
  
    header("Location: login.php");
    exit;
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedaftaran PPDB Sekolah</title>
    
    <!-- bootstrap 5.0.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container">
        <a class="navbar-brand" href="dashboard.php">Hasil Seleksi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="administration.php">Kelengkapan Administrasi</a>
            </li>
            </ul>
            <div class="d-flex">
              <form action="" method="post">
                <button type="submit" name="submit" class="btn btn-danger btn-logout">Keluar</a>
              </form>
            </div>
        </div>
      </div>
    </nav>