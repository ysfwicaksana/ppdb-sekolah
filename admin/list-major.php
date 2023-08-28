<?php
    require '../libraries/conn.php';

    session_start();

    // cek session berdasarkan role
    if ( $_SESSION['login'] !== 'admin' ) {
        $_SESSION = [];
        session_unset();
        session_destroy();
    
        header("Location: ../index.php");
        exit;
    }

    $list_major = show_data("SELECT * FROM jurusan");

    // header
    require '../layouts/header-admin.php';
?>

    <div class="list-major-contents" style="margin-top: 70px;">
        <div class="container d-flex flex-column mb-3 gap-2">
            <p>Daftar Jurusan</p>
            <a href="add-major.php" class="btn btn-primary" style="width: 180px;">Tambah Jurusan</a>
            <div class="table-container" style="overflow: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Jurusan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ( $list_major as $l ) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $l['nama_jurusan'] ?></td>
                                <td><di class="d-flex flex-row mb-3 gap-2">
                                    <a href="update-major.php?id=<?= $l['id'] ?>" class="btn btn-warning">Ubah</a>
                                    <a href="#" onclick="confirmDeleteMajor(<?= $l['id'] ?>)" class="btn btn-danger">Hapus</a>
                                </di></td>
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