<?php

include './../../config/config.php';
session_start();

$query = "SELECT * FROM user WHERE id = '" . $_SESSION['id'] . "'";
$res = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($res);

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
    <style>
        #header {
            z-index: 99;
        }

        main {
            z-index: 99;
        }

        #particles-js {
            position: absolute;
            top: -40rem;
            left: 0;
            width: 100%;
            height: 100%;
        }

        @media (max-width: 512px) {
            #particles-js {
                top: -40rem;
            }
        }
    </style>
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
                        <a class="nav-link text-black" href="./idea.php">Idea Sandbox</a>
                    </li> 
                </ul>

                <div>
                    <?php if (isset($_SESSION['loginSuccess']) == true) { ?>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle text-black fw-bold" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="mdi mdi-account-circle"></span>
                                Hello, <?php

                                $name = $_SESSION['nama'];
                                echo $name;

                                        ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item fw-bold" href="./profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="./idea.php">Idea Sandbox</a></li>
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
    <section class="bg-secondary w-50">
        <div id="particles-js"></div>
    </section>
    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> <?php echo $_SESSION['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <section class="bg-secondary p-3">
        <div class="row justify-content-center text-center">
            <div id="header" class="col-lg-4 col-md-12">
                <p class="text-white fw-light fs-5 mb-0">#StartYourFuture</p>
                <h1 class="fw-bold text-white"> Profile </h1>
                <p class="text-light fw-normal">
                    Selamat datang di halaman profile, <?php echo $_SESSION['nama']; ?>. Di halaman ini kamu bisa melihat data diri kamu, mengubah data diri kamu, dan mengubah password kamu.
                </p>
            </div>
        </div>
    </section>
    <?php if (isset($_SESSION['updateSuccess']) == true) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } else if (isset($_SESSION['updateFailed']) == true) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php

    unset($_SESSION['updateSuccess']);
    unset($_SESSION['updateFailed']);
    unset($_SESSION['error']);

    ?>
    <main class="container-fluid pt-5 pb-5 justify-content-center bg-white">
            <form method="post" class="container" action="./controller/updateAction.php" enctype="multipart/form-data">
            <div class="row">
                <div class="px-2 col-lg-3 col-sm-12">
                    <div class="rounded p-2 mb-2" style="background-color: white;">
                        <div class="row justify-content-center">
                            <?php if ($data['FOTO'] == null) { ?>
                                <img src="https://via.placeholder.com/150" class="img-fluid rounded-circle w-50" alt="...">
                            <?php } else { ?>
                                <img src="./../../src/img/profile/<?php echo $data['FOTO']; ?>" class="img-fluid rounded-circle w-50" alt="...">
                            <?php } ?>
                        </div>
                        <!-- nama -->
                        <div class="row">
                            <h3 class="fw-bold fs-5 mt-2 text-center"><?php echo $data['NAMA']; ?></h3>
                        </div>
                    </div>
                </div>
                <div class="px-2 col-lg-9 col-sm-12">
                    <div class="rounded p-3 justify-content-start align-items-center d-flex" style="background-color: white;">
                        <div class="row col-12">
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['NAMA']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['EMAIL']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="no_telp" class="form-label">No. HP</label>
                                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo $data['NO_TELP']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $data['ALAMAT']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input class="form-control" type="file" id="foto" name="foto">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="./../js/jquery.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        $(document).ready(function() {
            $('#formFile').change(function(e) {
                let fileName = e.target.files[0].name;
                alert('The file "' + fileName + '" has been selected.');
            });

        })

        $('input[name="judul"]').on('keyup', function() {
            let judul = $(this).val();
            let judulLength = judul.length;
            $('#judul-explain').text(judulLength);

            if (judulLength < 10 || judulLength > 255) {
                $('#judul-explain').addClass('text-danger');
                $('#judul-explain').removeClass('text-success');
                $(this).parent().addClass('text-danger');
            } else {
                $('#judul-explain').addClass('text-success');
                $('#judul-explain').removeClass('text-danger');
                $(this).parent().removeClass('text-success');
            }
        });

        $('textarea[name="content"]').on('keyup', function() {
            let content = $(this).val();
            let contentLength = content.length;
            $('#content-explain').text(contentLength);

            if (contentLength < 100 || contentLength > 1000) {
                $('#content-explain').addClass('text-danger');
                $('#content-explain').removeClass('text-success');
                $(this).parent().addClass('text-danger');
            } else {
                $('#content-explain').addClass('text-success');
                $('#content-explain').removeClass('text-danger');
                $(this).parent().removeClass('text-success');
            }
        });
    </script>
    <script src="./../../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./../../node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="./../js/particles.js"></script>
    <script src="./../js/app.js"></script>
</body>

</html>