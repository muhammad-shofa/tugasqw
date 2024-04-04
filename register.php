<?php

include "service/connection.php";
// include "service/insert.php";

$status_register = "";

// check login
isset($_SESSION['is_login']) ? header("location: index.php") : "";

// insert data register
if (isset($_POST["regis"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
    $email = htmlspecialchars($_POST["email"]);
    $tanggal_lahir = htmlspecialchars($_POST["tanggal_lahir"]);
    $jenis_kelamin = htmlspecialchars($_POST["jenis_kelamin"]);

    $hash_password = hash('sha256', $password);

    $sql_regis = $insert->selectTable($table_name = "users", $condition = "(username, password, nama_lengkap, email, tanggal_lahir, jenis_kelamin) VALUES ('$username', '$hash_password', '$nama_lengkap', '$email', '$tanggal_lahir', '$jenis_kelamin')");
    $result = $connected->query($sql_regis);
    if ($result) {
        $status_register = "<b>Berhasil mendaftar, silahkan <a href='login.php'>Login!</a></b>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <!-- custom css -->
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>Tugasqw</title>
</head>

<body>
    <!-- register start -->
    <div class="register p-2">
        <!-- navbar start -->
        <?php include "layout/navbar.php" ?>
        <!-- navbar end -->
        <div class="container-task p-5 mx-auto my-3 d-flex justify-content-center rounded-3 shadow">
            <!-- form register start -->
            <form action="register.php" method="POST" class="my-5" style="padding-top: 6px;">
                <div class="border rounded-2 p-4 mt-5 bg-light">
                    <div class="login-form">
                        <a href="index.php" class="mb-4 d-flex">
                            Tugasqw
                        </a>
                        <h5 class="fw-bold mb-3">Register for access all feature.</h5>
                        <p class="text-success">
                            <?= $status_register ?>
                        </p>
                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="Masukkan username" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukkan password" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                                placeholder="Masukkan nama lengkap" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Masukkan email" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select"
                                aria-label="Default select example">
                                <option value="Laki-Laki">Laki - Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div class="form-check m-0">
                                <input class="form-check-input" type="checkbox" id="s&k" required />
                                <label class="form-check-label" for="s&k">Saya menyetujui <a href="pages/s&k.php">syarat
                                        dan ketentuan</a></label>
                            </div>
                        </div>
                        <div class="d-grid py-3 mt-3">
                            <button type="submit" name="daftar" class="btn btn-lg btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModalCenter">
                                Daftar
                            </button>
                        </div>
                        <div class="text-center pt-4">
                            <span>Sudah memiliki akun?</span>
                            <a href="login.php" class="text-blue text-decoration-underline ms-2">
                                Masuk</a>
                        </div>
                    </div>
                </div>
            </form>
            <!-- form register end -->
        </div>
    </div>
    <!-- register end -->
    <!-- js -->
    <!-- bootstrap -->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>