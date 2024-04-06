<?php

include "service/connection.php";
include "service/insert.php";

$status_signup = "";

// check login
isset($_SESSION['is_login']) ? header("location: index.php") : "";

// insert data register
if (isset($_POST["sign-up"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $gender = htmlspecialchars($_POST["gender"]);

    $hash_password = hash('sha256', $password);

    $sql_signup = $insert->selectTable($table_name = "users", $condition = "(username, password, name, email, gender) VALUES ('$username', '$hash_password', '$name', '$email', '$gender')");
    $result = $connected->query($sql_signup);
    if ($result) {
        $status_signup = "<b>successfully, please <a href='login.php'>Sign In!</a></b>";
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
                <h2 class="text-center p-3">Sign Up <b class="text-primary">Tugasqw</b></h2>
                <p class="text-center fw-bold">Sign up to access all features</p>
                <p>
                    <?= $status_signup ?>
                </p>
                <form action="register.php" method="POST">
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

                    <!-- Name input -->
                    <div class="form-outline mb-4">
                        <div class="form-outline">
                            <input type="text" name="name" id="name" class="form-control" />
                            <label class="form-label" for="name">Your name</label>
                        </div>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" name="email" id="email" class="form-control" />
                        <label class="form-label" for="email">Email address</label>
                    </div>

                    <!-- Gender input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-select">
                            <option selected>Select one</option>
                            <option value="Male">Male</option>
                            <option value="Famale">Famale</option>
                        </select>
                    </div>

                    <!-- Terms and Condition -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">I agree to the <a href="#0"
                                class="text-primary">Terms & Conditions</a></label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" name="sign-up" class="btn btn-primary btn-block mb-4">
                        Sign up
                    </button>

                    <div class="text-center">
                        <p>Already have an Account? <a href="login.php">Sign In!</a></p>
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