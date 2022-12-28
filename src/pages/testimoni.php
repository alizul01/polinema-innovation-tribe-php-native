<?php

session_start();
require_once './../../config/config.php';

if (!($_SESSION['loginSuccess'])) {
    $_SESSION['loginError'] = "Anda harus login terlebih dahulu";
    header("location: ./../../index.php");
}
$id = $_SESSION['id'];
$query = "SELECT * FROM user WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $id = $_SESSION['id'];
    $testimoni = $_POST['testimoni'];
    $query = "INSERT INTO testimoni(id_user, komentar) VALUES ('$id', '$testimoni')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $_SESSION['success'] = "Testimoni berhasil ditambahkan";
        header("location: ./testimoni.php");
    } else {
        $_SESSION['error'] = "Testimoni gagal ditambahkan";
        header("location: ./testimoni.php");
    }
}

$sql = "SELECT * FROM testimoni_view ORDER BY published_at DESC";
$result = mysqli_query($conn, $sql);
$testimoni = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
            <a href="./../../index.php" class="navbar-brand text-primary fw-bold fs-3 text-uppercase">
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
                    <?php if (isset($_SESSION['loginSuccess'])) { ?>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle text-black" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="mdi mdi-account-circle text-primary"></span>
                                Hello, <?php

                                        $name = $_SESSION['nama'];
                                        echo $name;

                                        ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="./myIdea.php">My Idea</a></li>
                                <li><a class="dropdown-item fw-bold" href="./testimoni.php">Testimoni</a></li>
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
    <section class="bg-info p-3">
        <div class="row justify-content-center text-center">
            <div id="header" class="col-lg-4 col-md-12">
                <p class="text-white fw-light fs-5 mb-0">#StartYourFuture</p>
                <h1 class="fw-bold text-white">Testimoni Area</h1>
                <p class="text-light fw-light">
                    Berikan testimoni dan tanggapan kamu mengenai Polinema Innovation Tribe
                </p>
            </div>
        </div>
    </section>
    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } else if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php

    unset($_SESSION['createSuccess']);
    unset($_SESSION['createFailed']);
    unset($_SESSION['error']);

    ?>
    <main class="container-fluid pt-5 pb-5 justify-content-center bg-white">
        <form method="post" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating mb-3  bg-white">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="testimoni"></textarea>
                        <label for="floatingTextarea2">Testimoni</label>
                    </div>
                    <div class="d-grid gap-2">
                        <input name="submit" class="btn btn-primary" type="submit"></input>
                    </div>
                </div>
        </form>

        <!-- other peeps testimoni -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="text-center">Testimoni Lainnya</h5>
                    <div class="row">
                        <?php
                        for ($i = 0; $i < count($testimoni); $i++) {
                        ?>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card border-0 text-center bg-transparent">
                                        <div class="card-body">
                                            <img src="./../img/profile/<?= $testimoni[$i]['FOTO'] ?>" class="img-fluid cover avatar avatar-small rounded-circle mx-auto shadow" alt="" width="100px">
                                            <p class="text-muted mt-4">" <?= $testimoni[$i]['komentar']  ?> "</p>
                                            <h6 class="text-primary">- <?= $testimoni[$i]['NAMA']  ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
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
        // const removeTag = (id) => {
        //     $(id).remove();
        // }

        // function colorHexBrightness(color) {
        //     var r, g, b, hsp;
        //     if (color.match(/^rgb/)) {
        //         color = color.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
        //         r = color[1];
        //         g = color[2];
        //         b = color[3];
        //     } else {
        //         color = +("0x" + color.slice(1).replace(
        //             color.length < 5 && /./g, '$&$&'));
        //         r = color >> 16;
        //         g = color >> 8 & 255;
        //         b = color & 255;
        //     }
        //     hsp = Math.sqrt(
        //         0.299 * (r * r) +
        //         0.587 * (g * g) +
        //         0.114 * (b * b)
        //     );
        //     if (hsp > 127.5) {
        //         return true;
        //     } else {
        //         return false;
        //     }
        // }

        // let tagId = [];
        // $('.tag-container').on('keyup', function(e) {
        //     if (e.keyCode == 32) {
        //         let tag = $(this).val();
        //         let uniqueId = `tag-${Math.floor(Math.random() * 1000)}`;
        //         tagId.push(uniqueId);
        //         let uniqueColorHex = `#${Math.floor(Math.random() * 16777215).toString(16)}`;
        //         let style = `background-color: ${uniqueColorHex}; margin-right: 5px; margin-bottom: 5px; cursor: pointer;`;
        //         let textColor = colorHexBrightness(uniqueColorHex) ? 'color: #fff;' : 'color: #000;';
        //         style += textColor;
        //         let tagHtml = `<span id="${uniqueId}" class="badge rounded-pill p-2" style="${style}">${tag} <span class="mdi mdi-close" onclick="removeTag('#${uniqueId}')"></span></span>`;
        //         $(this).after(tagHtml);
        //         $(this).val('');
        //     }
        // });

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