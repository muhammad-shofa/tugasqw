<?php
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location: index.php");
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary p-2 rounded-5 shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Tugasqw</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="todolist.php">To Do List</a>
                </li>
            </ul>
            <span class="navbar-text d-flex gap-2 align-items-center">
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
        </div>
    </div>
</nav>