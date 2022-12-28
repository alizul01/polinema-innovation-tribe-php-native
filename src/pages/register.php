<?php

session_start();
if (isset($_SESSION['loginSuccess'])) {
    header('Location: ./../../../index.php');
    exit;
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polinema Innovation Tribe | Home</title>
    <link rel="stylesheet" href="./../../src/custom.css">
    <link rel="stylesheet" href="./../../src/icon/materialdesignicons.min.css">
</head>

<body class="bg-white vh-100 d-flex flex-column justify-content-between">
    <nav class="navbar navbar-expand-lg sticky-lg-top">
        <div class="container">
            <a href="./../../index.php" class="navbar-brand text-primary fw-bold fs-3 text-uppercase">
                PIT
            </a>
            <button class="navbar-toggler text-black" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="mdi mdi-menu"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mx-auto" id="navbar-navlist">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="./../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="./../../src/pages/idea.php">Idea Sandbox</a>
                    </li> 
                </ul>

                <div>
                    <a href="#" class="btn btn-primary me-2">Register</a>
                    <a href="./login.php" class="btn btn-outline-primary">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <main class="container mt-5">
        <h1 class="text-center fw-bold mb-3">Registrasi Akun</h1>
        <form action="./controller/registerAction.php" method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control bg-white" id="nama" name="nama" placeholder="Nama Lengkap">
                <div class="form-text">Masukkan nama lengkap anda, jangan menggunakan nama panggilan.</div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control bg-white" id="email" name="email" placeholder="Email">
                <div hidden class="alert alert-danger alert-dismissible fade show mt-1 " role="alert">
                    <strong>Perhatian!</strong> Email sudah terdaftar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control bg-white" id="password" name="password" placeholder="Password">
                <div hidden class="alert alert-danger alert-dismissible fade show mt-1 " role="alert">
                    <strong>Perhatian!</strong> Password harus terdiri dari 8 karakter, huruf besar, huruf kecil, angka, dan simbol.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <div class="mb-3 position-relative">
                <label for="password2" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control bg-white" id="password2" name="password2" placeholder="Konfirmasi Password">
                <?php if (isset($_SESSION['passwordNotMatch'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-1 " role="alert">
                        <strong>Perhatian!</strong> Password tidak sama.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <?php

                unset($_SESSION['passwordNotMatch']);

                ?>
            </div>
            <button name="submit" type="submit" class="btn btn-primary w-100 text-center">Submit</button>
            <div class="d-flex w-100 align-content-center justify-content-center mt-3">
                <div class="border-bottom w-25"></div>
                <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
                <div class="border-bottom w-25"></div>
            </div>
            <div class="d-flex w-100 align-content-center justify-content-center mt-3">
                <a href="#" class="btn btn-outline-primary d-flex w-100 justify-content-center">
                    <span class="mdi mdi-google me-2"></span>
                    Login with Google
                </a>
            </div>
            <div class="d-flex w-100 align-content-center justify-content-center mt-3">
                <span class="text-muted me-2">Sudah memiliki akun?</span>
                <a href="./login.php" class="text-decoration-none text-primary fw-bold">Login Sekarang</a>
            </div>
            <hr class="my-4">
            <div class="d-flex text-center w-100 align-content-center justify-content-center mt-3">
                <span class="text-muted me-2">Dengan registrasi, Anda menyetujui</span>
                <a href="#" class="text-decoration-none text-primary fw-light text-decoration-underline">Syarat & Ketentuan</a>
            </div>
        </form>

    </main>
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
    <script src="./../../src/js/jquery.js"></script>
    <script>
        if ($(window).width() > 768) {
            $("main").addClass("w-25");
        } else {
            $("main").addClass("w-50");
        }
    </script>
    <script src="./../../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./../../node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>