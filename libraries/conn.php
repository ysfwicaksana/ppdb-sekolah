<?php

    // connect to database
    $conn = mysqli_connect("Localhost", "root", "", "ppdb_sekolah");

    function show_data($query) {
        global $conn;

        $result = mysqli_query($conn, $query);

        $rows = [];
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    function register($data) {
        global $conn;

        $nama = $data['nama'];
        $email = $data['email'];
        $password = mysqli_real_escape_string($conn, $data['password']);
        $konfirmasi_password = mysqli_escape_string($conn, $data['konfirmasi-password']);

        // cek konfirmasi password
        if ( $password !== $konfirmasi_password ) {
            echo "
                    <script type='text/javascript'>
                        document.addEventListener('DOMContentLoaded', () => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal', 
                                html: '<p class="."p-popup".">Konfirmasi password tidak sesuai!</p>',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        })
                    </script>
                ";

            return false;
        }

        // cek email sudah ada atau belum
        $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

        if (mysqli_fetch_assoc($result)) {
            echo "
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal', 
                            html: '<p class="."p-popup".">Email sudah ada sebelumnya!</p>',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    })
                </script>
            ";

            return false;
        }

        // enkripsi password
        $password = password_hash($password, PASSWORD_BCRYPT);

        $created_at = date('Y-m-d H:i:s', time());
        $updated_at = $created_at;

        // tambah user baru ke database
        $query = "INSERT INTO user VALUES(
            '',
            '$email',
            '$nama',
            '$password',
            'user',
            '$created_at',
            '$updated_at'
        )";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function kelengkapanAdministrasi($data, $id) {
        global $conn;

        $jurusan_id = $data['jurusan_id'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $tempat_lahir = htmlspecialchars($data['tempat_lahir']);
        $tanggal_lahir = $data['tanggal_lahir'];
        $alamat = htmlspecialchars($data['alamat']);
        $created_at = date('Y-m-d H:i:s', time());
        $updated_at = $created_at;

        $result = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
        $user = mysqli_fetch_assoc($result);
        $user_id = $user['id'];

        $query = "INSERT INTO registrasi VALUE(
            '',
            '$user_id',
            '$jurusan_id',
            '$jenis_kelamin',
            '$tempat_lahir',
            '$tanggal_lahir',
            '$alamat',
            'pending',
            '$created_at',
            '$updated_at'
        )";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function uploadBerkas() {
        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $error = $_FILES['file']['error'];
        $tmp_name = $_FILES['file']['tmp_name'];

        // cek apakah tidak ada gambar yang diupload
        if ($error === 4) {
            echo "
                    <script type='text/javascript'>
                        document.addEventListener('DOMContentLoaded', () => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal', 
                                html: '<p class="."p-popup".">Upload berkas terlebih dahulu!</p>',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        })
                    </script>
                ";

            return false;
        }

        // cek apakah yang diupload adalah gambar
        $valid_image_extension = ['pdf'];
        $image_extension = explode('.', $file_name);
        $image_extension = strtolower(end($image_extension));

        if (!in_array($valid_image_extension, $valid_image_extension)) {
            echo "
                    <script type='text/javascript'>
                        document.addEventListener('DOMContentLoaded', () => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal', 
                                html: '<p class="."p-popup".">File yang anda upload bukan pdf!</p>',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        })
                    </script>
                ";

            return false;
        }

        $new_file_name = uniqid();
        $new_file_name .= '.';
        $new_file_name .= $image_extension;

        move_uploaded_file($tmp_name, 'uploads/' . $new_file_name);

        return $new_file_name;
    }



?>