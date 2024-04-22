<?php
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location: index.php");
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary p-2 rounded-5 shadow">
    <!-- new nav start -->
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Tugasqw</a>
        <!-- toggle btn start -->
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- toggle btn end -->

        <!-- sidebar start -->
        <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <!-- sidebar header start -->
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                    Tugasqw
                </h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <!-- sidebar header end -->
            <!-- sidebar body start -->
            <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                <ul class="navbar-nav justify-content-center align-items-center flex-grow-1 pe-3">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="todolist.php">To Do List</a>
                    </li>
                </ul>
                <!-- login and sign up start -->
                <span class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-3">
                    <?php
                    if (!isset($_SESSION['is_login'])) { ?>
                        <a class="nav-link p-2 rounded border bg-primary text-light" href="signin.php">Sign in</a>
                        <a class="nav-link" href="signup.php">Sign Up</a>
                    <?php } else { ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <button type="submit" name="logout" class="btn p-0">
                                <img class="p-2 bg-danger rounded" src="./assets/icon/right-from-bracket-solid.svg"
                                    alt="logout icon" width="30px" height="30px">
                            </button>
                        </form>
                    <?php } ?>
                </span>
                <!-- login and sign up end -->
            </div>
            <!-- sidebar body end -->
        </div>
        <!-- sidebar end -->
    </div>
    <!-- new nav end -->
</nav>