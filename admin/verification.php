<?php
    require '../libraries/conn.php';

    session_start();

    // header
    require '../layouts/header-admin.php';

    $id = $_GET['id'];

    $user = show_data("SELECT r.id, u.id, u.nama, r.status FROM registrasi r
    LEFT JOIN `user` u ON r.user_id = u.id WHERE r.id = '$id'")[0];

    $files = show_data("SELECT r.id, br.nama_berkas, br.file FROM berkas_registrasi br
    LEFT JOIN registrasi r ON br.registrasi_id = r.id WHERE r.id = '$id'");
?>

    <div class="verification-contents" style="margin-top: 70px;">
        <div class="container d-flex flex-column mb-3">
            <div class="d-flex flex-row mb-3 gap-2">
                <p>Detail Berkas</p>
                <p style="font-weight: 600;"><?= $user['nama'] ?></p>
            </div>

            <div class="table-container" style="overflow: auto;">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nama Berkas</th>
                        <th scope="col">File</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ( $files as $file ) : ?>
                        <tr>
                            <td><?= $file['nama_berkas'] ?></td>
                            <td><a href="<?= '../uploads/'.$file['file']; ?>" target="_blank" style="text-decoration: none;"><?= $file['file'] ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-row mb-3 gap-2">
                <a href="accept.php?id=<?= $id; ?>" class="btn btn-secondary">Terima</a>
                <a href="reject.php?id=<?= $id; ?>" class="btn btn-danger">Tolak</a>
            </div>
        </div>
    </div>

<?php
    // footer
    require '../layouts/footer.php';
?>