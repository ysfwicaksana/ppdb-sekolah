<?php

    // koneksi ke database
    $conn = mysqli_connect("Localhost", "root", "", "ppdb_sekolah");

    // fungsi untuk menampilkan data
    function show_data($query) {
        global $conn;

        $result = mysqli_query($conn, $query);

        $rows = [];
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    //  fungsi untuk mendaftarkan akun
    function registerAccount($data) {
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
        mysqli_query($conn, "INSERT INTO user VALUES(
            '',
            '$email',
            '$nama',
            '$password',
            'user',
            '$created_at',
            '$updated_at'
        )");

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk login akun
    function loginAccount($data) {
        global $conn;

        $email = $data['email'];
        $password = $data['password'];

        $result = mysqli_query($conn, "SELECT * from user WHERE email = '$email'");

        // cek user ada atau tidak
        if ( mysqli_num_rows($result) === 1 ) {
            // cek password
            $user = mysqli_fetch_assoc($result);

            if ( password_verify($password, $user['password']) ) {
                // cek role

                if ( $user['role'] === 'user' ) {
                    $_SESSION['login'] = true;

                    // set cookie
                    setcookie('xyz', $user['id'], time() + 3600);
                    setcookie('zyx', hash('sha256', $user['email']), time() + 3600);

                    header("Location: dashboard.php");
                    exit;
                }
            }
        }

        $error = true;

        if ( isset($error) ) {
            echo "
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            icon: 'error',
                            title: 'error', 
                            html: '<p class="."p-popup".">Email atau password salah!</p>',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    })
                </script>
            ";
        }
        
    }

    // fungsi untuk daftar administrasi
    function administration($data, $id) {
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

        mysqli_query($conn, "INSERT INTO registrasi VALUE(
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
        )");
        return mysqli_affected_rows($conn);
    }

    // fungsi untuk upload berkas
    function uploadBerkas() {
        $file_name = $_FILES['file']['name'];
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

        // cek apakah yang diupload adalah dokumen
        $valid_image_extension = ['pdf'];
        $image_extension = explode('.', $file_name);
        $image_extension = strtolower(end($image_extension));

        if (!in_array($image_extension, $valid_image_extension)) {
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

    // fungsi untuk administrasi lanjutan
    function advancedAdministration($data, $user_id) {
        global $conn;
        $registrasi_table = mysqli_query($conn, "SELECT * FROM registrasi WHERE user_id = '$user_id'");
        $registrasi = mysqli_fetch_assoc($registrasi_table);
        $registrasi_id = $registrasi['id'];
        $nama_berkas = htmlspecialchars($data['nama_berkas']);
        $file = uploadBerkas();
        $created_at = date('Y-m-d H:i:s', time());
        $updated_at = $created_at;

        if ( !$file ) {
            return false;
        }

        mysqli_query($conn, "INSERT INTO berkas_registrasi VALUES(
            '',
            '$registrasi_id',
            '$nama_berkas',
            '$file',
            '$created_at',
            '$updated_at'
        )");

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk hapus berkas
    function deleteFile($id) {
        global $conn;

        // query untuk mendapatkan file berdasarkan id
        $result = mysqli_query($conn, "SELECT br.file FROM berkas_registrasi br WHERE id = $id");

        // di ubah menjadi array assosiative
        $filename =  mysqli_fetch_assoc($result);
        
        // fungsi untuk menghapus file pada directori server 
        unlink('uploads/'.$filename['file']);

        // query untuk mengapus file berdasarkan id
        mysqli_query($conn, "DELETE br FROM berkas_registrasi br LEFT JOIN registrasi r ON br.registrasi_id = r.id WHERE br.id = $id");

        return mysqli_affected_rows($conn);
    }

?>