<?php

include './../../config/config.php';
session_start();

$query = mysqli_query($conn, "SELECT * FROM idea_box WHERE ID_IDEA = '" . $_GET['id'] . "'");
$kategori = "SELECT * FROM kategori";
$kategori = mysqli_query($conn, $kategori);
$kategori = mysqli_fetch_all($kategori, MYSQLI_ASSOC);
$idea = mysqli_fetch_assoc($query);
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
    <section class="bg-secondary bg-gradient p-3">
        <div class="row justify-content-center text-center">
            <div id="header" class="col-lg-4 col-md-12">
                <p class="text-white fw-light fs-5 mb-0">#StartYourFuture</p>
                <h1 class="fw-bold text-white">Update Idea Creation Box</h1>
                <p class="text-light fw-light">
                    Update idemu supaya bisa menjadi lebih baik lagi, dan jangan lupa untuk selalu berbagi ide yang kamu punya.
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
        <form method="post" class="container" action="./controller/updatePostAction.php" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <input hidden name="id" value="<?php echo $idea['ID_IDEA']; ?>">
                    <div class="form-floating mb-3  bg-white">
                        <input name="judul" type="text" class="form-control" id="floatingInput" placeholder="Judul Ide" required value="<?php echo $idea['JUDUL']; ?>">
                        <label for="floatingInput">Judul Ide</label>
                    </div>
                    <div class="form-floating mb-3 bg-white">
                        <select name="kategori" id="kategori" class="form-select">
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['KATEGORI'] ?>" <?php if ($k['KATEGORI'] == $idea['KATEGORI']) { ?> selected <?php } ?>><?= $k['KATEGORI'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="floatingInput">Kategori</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="content" class="form-control bg-white" placeholder="Deskripsi Ide" id="editor" style="height: 100px" required><?php echo $idea['DESKRIPSI']; ?></textarea>
                    </div>
                    <img id="previewimg" class="img-thumbnail" src="./../img/post/<?php echo $idea['THUMBNAIL']; ?>" alt="Thumbnail">
                    <div class="form-control bg-white mb-3">
                        <label for="formFile" class="form-label">Upload Thumbnail <span class="text-danger"> (Max 2MB)</span></label>
                        <input class="form-control" name="thumbnail" type="file" id="formFile">
                    </div>
                    <div class="d-grid gap-2">
                        <input name="submit" class="btn btn-primary" type="submit"></input>
                    </div>
                </div>
        </form>
        <div class="col-md-4 bg-white p-3">
            <div class="row">
                <h5 class="text-center fw-bold">Cek Kelengkapan</h5>
                <div class="row gap-2">
                    <div class="text-danger">
                        <div class="row">
                            <div>
                                <span class="mdi mdi-check-circle"></span>
                                <span class="fw-bold">Judul Ide</span>
                            </div>
                        </div>
                        <div class="fw-normal text-info">
                            Minimal 10 karakter, maksimal 255 karakter. Saat ini, karakter yang anda gunakan adalah <span id="judul-explain">0</span> karakter.
                        </div>
                    </div>
                    <div class="text-danger">
                        <div class="row">
                            <div>
                                <span class="mdi mdi-check-circle"></span>
                                <span class="fw-bold">Kategori</span>
                            </div>
                        </div>
                        <div class="fw-normal text-info">
                            Pilih salah satu kategori yang sesuai dengan ide anda.
                        </div>
                    </div>
                    <div class="text-danger">
                        <div class="row">
                            <div>
                                <span class="mdi mdi-check-circle"></span>
                                <span class="fw-bold">Deskripsi Ide</span>
                            </div>
                        </div>
                        <div class="fw-normal text-info">
                            Segera isi deskripsi ide anda. Saat ini, karakter yang anda gunakan adalah <span id="deskripsi-explain">0</span> karakter.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bg-success text-white mt-3 p-2 mb-2 rounded-2">
                <div class="row mb-3">
                    <div class="text-start">
                        <span class="mdi mdi-information-outline"></span>
                        <span class="text-white fw-bold">Informasi</span>
                    </div>
                </div>
                <div class="row text-start fw-normal" id="trivia">
                    Ide yang bagus adalah ide yang dapat menyelesaikan masalah yang ada. Jika anda memiliki ide yang bagus, jangan ragu untuk mengunggahnya di sini.
                </div>
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
    <script src="./../../node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        function previewImage() {
            const thumbnail = document.querySelector('#formFile');
            const previewimg = document.querySelector('#previewimg');
            const file = new FileReader();
            file.readAsDataURL(thumbnail.files[0]);

            file.onload = function(e) {
                previewimg.src = e.target.result;
            }
        }
        $(document).ready(function() {
            $('#formFile').change(function(e) {
                previewImage();
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