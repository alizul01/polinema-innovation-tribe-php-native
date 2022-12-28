<?php

include './../../config/config.php';
session_start();

$query = "SELECT * FROM idea_box";
$result = mysqli_query($conn, $query);
$ideas = mysqli_fetch_all($result, MYSQLI_ASSOC);
$countIdeas = mysqli_num_rows($result);

$query = "SELECT user.NAMA, user.FOTO, idea_box.THUMBNAIL, idea_box.DESKRIPSI_SINGKAT, idea_box.ID_IDEA, idea_box.KATEGORI, idea_box.JUDUL, idea_box.DESKRIPSI, idea_box.CREATED_AT FROM user INNER JOIN idea_box ON user.id = idea_box.id WHERE user.id = " . $_SESSION['id'];
$result = mysqli_query($conn, $query);
$ideas = mysqli_fetch_all($result, MYSQLI_ASSOC);

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

<body>
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
                        <a class="nav-link text-black fw-bold" href="./idea.php">Idea Sandbox</a>
                    </li> 
                </ul>

                <div>
                    <?php if (isset($_SESSION['loginSuccess']) == true) { ?>
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

    <section class="bg-primary w-50">
        <div id="particles-js"></div>
    </section>
    <section class="bg-info p-3">
        <div class="row justify-content-center text-center">
            <div id="header" class="col-lg-4 col-md-12">
                <p class="text-white fw-light fs-5 mb-0">#CreativeSpace</p>
                <h1 class="fw-bold text-white">My Idea </h1>
                <p class="text-light fw-light">
                    Ide - ide kreatif yang telah kamu buat akan tersimpan di sini. Kamu dapat melihat ide - ide yang telah kamu buat, mengeditnya, dan menghapusnya.
                </p>
            </div>
        </div>
    </section>
    <?php if (isset($_SESSION['deleteSuccess']) == true) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } else if (isset($_SESSION['deleteFailed']) == true) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php

    unset($_SESSION['deleteSuccess']);
    unset($_SESSION['deleteFailed']);
    unset($_SESSION['error']);

    ?>
    <main class="container mt-lg-3">
        <div class="row mb-3 mt-5">
            <div class="col-6 text-start">
                <h2 class="fw-bold text-primary">Ideas</h2>
            </div>
            <div class="col-6 text-end">
                <a href="./create.php" class="btn btn-primary">
                    <span class="mdi mdi-plus"></span>
                    Add Idea
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary" type="button" id="button-addon2">
                                <span class="mdi mdi-magnify"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <div class="input-group align-content-end justify-content-end">
                            <button class="btn btn-outline-primary" type="button" id="button-addon2">
                                <span class="mdi mdi-view-grid"></span>
                            </button>
                            <button class="btn btn-outline-primary" type="button" id="button-addon2">
                                <span class="mdi mdi-view-list"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gap-2">
            <div class="row">
                <?php if ($countIdeas == 0) { ?>
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            No idea found
                        </div>
                    </div>
                <?php } else { ?>
                    <table class="table table-hover table-striped table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Judul</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ideas as $idea) : ?>
                                <tr>
                                    <td class="col-5"><?= $idea['JUDUL'] ?></td>
                                    <td class="col-1"><?= $idea['KATEGORI'] ?></td>
                                    <td class="col-2"><img src="./../img/post/<?= $idea['THUMBNAIL'] ?>" alt="" class="img-fluid"></td>
                                    <!-- substring, ignore the newline case -->
                                    <td><?= substr($idea['DESKRIPSI_SINGKAT'], 0, 50) . '...' ?></td>
                                    <td>
                                        <div class="h-100 gap-2 justify-content-center align-items-center">
                                            <a href="./editPost.php?id=<?= $idea['ID_IDEA'] ?>" class="btn btn-primary">
                                                <span class="mdi mdi-pencil"></span>
                                            </a>
                                            <form class="d-inline" action="./controller/deleteAction.php" method="POST">
                                                <input type="hidden" name="id_idea" value="<?= $idea['ID_IDEA'] ?>">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                                    <span class="mdi mdi-delete"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } ?>
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
    <script src="./../../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./../../node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="./../js/particles.js"></script>
    <script src="./../js/app.js"></script>
</body>

</html>