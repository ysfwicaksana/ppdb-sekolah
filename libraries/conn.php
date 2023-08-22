<?php

    class Ppdb {
        public $hostname,
               $username,
               $password,
               $database;

        public function __construct($hostname, $username, $password, $database) 
        {
            $this->hostname = $hostname;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }

        public function connect() {
            return mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
        }

        public function show_data($conn, $query) {
            $result = mysqli_query($conn, $query);
            $data = [];

            while($d = mysqli_fetch_assoc($result)) {
                $data[] = $d;
            }

            return $data;
        }

        public function registerAccount($conn, $data) {
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

        public function loginAccount($conn, $data) {
            $email = $data['email'];
            $password = $data['password'];

            $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
            
            if ( mysqli_num_rows($result) ) {
                // cek email
                if ( mysqli_num_rows($result) === 1 ) {
                    // cek password
                    $user = mysqli_fetch_assoc($result);

                    if ( password_verify($password, $user['password']) ) {
                        // set session
                        $_SESSION['login'] = true;

                        // set cookie
                        setcookie('xyz', $user['id'], time() + 3600);
                        setcookie('zyx', hash('sha256', $user['email']), time() + 3600);

                        header("Location: dashboard.php");
                        exit;
                    }
                }

                $err = true;

                if ( isset($err) ) {
                    echo "
                        <script type='text/javascript'>
                            document.addEventListener('DOMContentLoaded', () => {
                                Swal.fire({
                                icon: 'error',
                                title: 'Gagal', 
                                html: '<p class="."p-popup".">Email atau password salah!</p>',
                                showConfirmButton: false,
                                timer: 2000
                                })
                            })
                        </script>
                    ";
                }
            }
        }

    }

?>