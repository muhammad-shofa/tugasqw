<?php

include "service/connection.php";
include "service/select.php";
session_start();

$status_signup = "";

// check login
isset($_SESSION['is_login']) ? header("location: index.php") : "";

// matching data
if (isset($_POST['sign-in'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $hash_password = hash('sha256', $password);

    $sql_signin = $select->selectTable($table_name = "users", $fields = '*', $condition = "WHERE username='$username' AND password='$hash_password'");
    $result = $connected->query($sql_signin);
    if ($result->num_rows > 0) {
        $data_user = $result->fetch_assoc();
        $_SESSION["user_id"] = $data_user["user_id"];
        $_SESSION["username"] = $data_user["username"];
        $_SESSION['is_login'] = true;
        header("location: todolist.php");
    } else {
        $status_signup = "Pastikan anda memasukkan username dan password yang benar!";
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
        <!-- container register start -->
        <div class="container-register mx-auto my-3 rounded-3 shadow">
            <!-- form register start -->
            <div class="card-body px-4 py-5 px-md-5">
                <h2 class="text-center p-3">Sign In <b class="text-primary">Tugasqw</b></h2>
                <p class="text-center fw-bold">Sign in for a better experience</p>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <!-- Username input -->
                    <div class="form-outline mb-4">
                        <input type="text" name="username" id="username" class="form-control" />
                        <label class="form-label" for="username">Username</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="password" class="form-control" />
                        <label class="form-label" for="password">Password</label>
                    </div>

                    <!-- Terms and Condition -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="terms&conditions" required>
                        <label class="form-check-label" for="terms&conditions">I agree to the <a href="#0"
                                class="text-primary">Terms & Conditions</a></label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" name="sign-in" class="btn btn-primary btn-block mb-4">
                        Sign in
                    </button>

                    <div class="text-center">
                        <p>Don't have an account yet? <a href="signup.php">Sign Up!</a></p>
                    </div>
                </form>
            </div>
            <!-- form register end -->
        </div>
        <!-- container register start -->
    </div>
    <!-- register end -->
    <!-- js -->
    <!-- bootstrap -->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>