<?php

include './../../config/config.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM idea_box WHERE ID_IDEA = '$id'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);
    $created_at = $data['created_at'];
}

$created_at = date('d F Y', strtotime($created_at));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polinema Innovation Tribe | Home</title> 
    <link rel="stylesheet" href="./../custom.css">
    <link rel="stylesheet" href="./../icon/materialdesignicons.min.css">
    <link rel="shortcut icon" href="./../../public/favicon.png" type="image/x-icon">
</head>

<body class="bg-white">
    <nav class="navbar navbar-expand-lg sticky-lg-top bg-white">
        <div class="container">
            <a href="#" class="navbar-brand text-primary fw-bold fs-3 text-uppercase">
                PIT
            </a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="mdi mdi-menu text-black"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mx-auto" id="navbar-navlist">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="./../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black fw-bold" href="./idea.php">Idea Sandbox</a>
                    </li> 
                </ul>

                <div>
                    <?php if (isset($_SESSION['loginSuccess']) == true) { ?>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle text-black" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="mdi mdi-account-circle"></span>
                                Hello, <?php

                                $name = $_SESSION['nama'];
                                echo $name;

                                        ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="./myidea.php">My Idea</a></li>
                                <li><a class="dropdown-item" href="./testimoni.php">Testimoni</a></li>
                                <li><a class="dropdown-item" href="./controller/logoutAction.php">Logout</a></li>
                            </ul>
                        </div>
                    <?php } else { ?>
                        <a href="./register.php" class="btn btn-primary me-2">Register</a>
                        <a href="./login.php" class="btn btn-outline-primary">Login</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <a href="./idea.php" class="btn btn-outline-primary mt-4">
                    <span class="mdi mdi-arrow-left"></span>
                    Back
                </a>
            </div>
        </div>
        <div class="row">
            <img src="./../img/post/<?= $data['THUMBNAIL'] ?>" class="my-2 img-fluid col-12" alt="..." style="max-height: 400px; object-fit: cover;" />
            <div class="col-12">
                <h1 class="mt-3 fs-3 text-center text-primary fw-bold"> <?= $data['JUDUL'] ?> </h1>
            </div>
        </div>
        <div class="row">
            <p class="text-end text-muted"> Posted at : <?= $created_at ?> </p>
        </div>
        <div class="row mt-5">
            <?= $data['DESKRIPSI'] ?>
        </div>
    </div>

    <div class="container-fluid">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a>
                <span class="mb-3 mb-md-0 text-muted">&copy; 2022 Company, Inc</span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li>
                    <span class="mdi mdi-instagram fs-3 text-muted"></span>
                </li>
                <li class="ms-3">
                    <span class="mdi mdi-youtube fs-3 text-muted"></span>
                </li>
                <li class="ms-3">
                    <span class="mdi mdi-twitter fs-3 text-muted"></span>
                </li>
            </ul>
        </footer>
    </div>
    <script src="./../../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./../../node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="./../js/particles.js"></script>
    <script src="./../js/app.js"></script>
</body>

</html>