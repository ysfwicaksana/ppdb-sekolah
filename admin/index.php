<?php
    require '../libraries/conn.php';

    session_start();   
    
    // cek session berdasarkan role
    if ( $_SESSION['login'] !== 'admin' ) {
        header("Location: ../index.php");
        exit;
    } 

    $registrasi = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_registrasi FROM registrasi r ;");
    $jumlah_registrasi = mysqli_fetch_assoc($registrasi);
    
    $terima = mysqli_query($conn, "SELECT COUNT(*) AS terima from registrasi r where r.status = 'accept'");
    $jumlah_terima = mysqli_fetch_assoc($terima);
    
    $tolak = mysqli_query($conn, "SELECT COUNT(*) AS tolak FROM registrasi r WHERE r.status = 'reject'");
    $jumlah_tolak = mysqli_fetch_assoc($tolak);
    
    $pending = mysqli_query($conn, "SELECT COUNT(*) AS pending FROM registrasi r WHERE r.status = 'pending'");
    $jumlah_pending = mysqli_fetch_assoc($pending);

    require '../layouts/header-admin.php';
?>

    <div class="dashboard-contents" style="margin-top: 70px;">
        <div class="container d-flex flex-column mb-3">
            <div class="d-lg-flex gap-2" style="width: 100%;">
                <div class="card d-flex flex-column mb-3 justify-content-center align-items-center" style="flex:1; min-height: 200px;">
                    <h1 style="color: #424242;"><?= $jumlah_registrasi['jumlah_registrasi'] ?></h1>
                    <p>Berkas administrasi</p>
                </div>
                <div class="card d-flex flex-column mb-3 justify-content-center align-items-center" style="flex:1; min-height: 200px;">
                    <h1 style="color: #424242;"><?= $jumlah_pending['pending'] ?></h1>
                    <p>Pending</p>
                </div>
                <div class="card d-flex flex-column mb-3 justify-content-center align-items-center" style="flex:1; min-height: 200px;">
                    <h1 style="color: #424242;"><?= $jumlah_terima['terima'] ?></h1>
                    <p>Diterima</p>
                </div>
                <div class="card d-flex flex-column mb-3 justify-content-center align-items-center" style="flex:1; min-height: 200px;">
                    <h1 style="color: #424242;"><?= $jumlah_tolak['tolak'] ?></h1>
                    <p>Ditolak</p>
                </div>
            </div>
        </div>
    </div>

<?php
    // footer
    require '../layouts/footer.php';
?>