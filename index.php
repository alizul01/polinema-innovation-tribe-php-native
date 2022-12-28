<?php

include './config/config.php';
session_start();

$sql = "SELECT COUNT(*) AS total FROM user";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalUser = $row['total'];

$sql = "SELECT COUNT(*) AS total FROM idea_box";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalIdea = $row['total'];

$sql = "SELECT COUNT(*) AS total FROM testimoni";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalTestimoni = $row['total'];

$sql = "SELECT * FROM testimoni_view ORDER BY published_at DESC LIMIT 3";
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
    <link rel="stylesheet" href="./src/custom.css">
    <link rel="stylesheet" href="./src/icon/materialdesignicons.min.css">
    <link rel="shortcut icon" href="./public/favicon.png" type="image/x-icon">
    <style>
        #eye-login {
            cursor: pointer;
        }

        #home-section {
            height: 100vh;
        }

        @media (max-width: 1023px) {
            #home-section {
                height: fit-content;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-lg-top bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand text-primary fw-bold fs-3 text-uppercase">
                PIT
            </a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="mdi mdi-menu"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mx-auto" id="navbar-navlist">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./src/pages/idea.php">Idea Sandbox</a>
                    </li>
                </ul>
                
                <div>
                    <?php if (isset($_SESSION['loginSuccess'])) { ?>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="mdi mdi-account-circle"></span>
                                Hello, <?php

                                        $name = $_SESSION['nama'];
                                        $surname = explode(" ", $name);
                                        if (count($surname) == 1) {
                                            echo $surname[0];
                                        } else {
                                            echo $name;
                                        }
                                        ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="./src/pages/profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="./src/pages/myIdea.php">My Idea</a></li>
                                <li><a class="dropdown-item" href="./src/pages/testimoni.php">Testimoni</a></li>
                                <li><a class="dropdown-item" href="./src/pages/controller/logoutAction.php">Logout</a></li>
                            </ul>
                        </div>
                    <?php } else { ?>
                        <a href="./src/pages/register.php" class="btn btn-primary me-2">Register</a>
                        <a href="./src/pages/login.php" class="btn btn-outline-primary">Login</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <section id="home-section" class="pt-5 pt-lg-0 bg-dark text-white d-flex align-items-center">
            <div id="particles-js"></div>
            <div id="home" class="container pt-5 pt-lg-0">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 align-items-center justify-content-center d-flex flex-column">
                        <h1 class="display-1 fw-bold">Polinema <span class="text-primary">Innovation Tribe</span></h1>
                        <p class="lead fs-4">Polinema Innovation Tribe adalah sebuah wadah menukar ide kreatif mahasiswa dan mencari team untuk mengembangkan ide tersebut.</p>
                        <div class="row text-center d-flex w-100 mb-3 gap-2 justify-content-center align-content-center">
                            <div class="card bg-primary text-black col-lg-5 col-md-12">
                                <div class="card-body position-relative">
                                    <p class="fs-1 fw-bold text-white mb-0">
                                        <span id="total-idea"><?= $totalIdea; ?>+</span>
                                    </p>
                                    <h5 class="card-title fs-4 fw-bold text-white">
                                        Creative Idea
                                    </h5>
                                </div>
                            </div>
                            <div class="card bg-secondary text-black col-lg-5 col-md-12">
                                <div class="card-body">
                                    <p class="fs-1 fw-bold text-white mb-0">
                                        <span id="total-user"><?= $totalUser; ?>+</span>
                                    </p>
                                    <h5 class="card-title fs-4 fw-bold text-white">
                                        Creative Peeps
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary btn-lg w-100">Get Started</a>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <img src="./src/img/hero-img.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
        <section class="container w-100 my-5">
            <section class="pt-4">
                <div class="container">
                    <div class="row">
                        <p class="text-center fs-3 fw-bold"> Berhasil mencetak <span class="text-primary"><?= $totalIdea ?>+</span> ide kreatif mahasiswa Polinema</p>
                    </div>
                    <div class="row justify-content-center">
                        <?php for($i = 1; $i <= 6; $i++) { ?>
                        <div class="col-lg-2 col-md-2 col-6 text-center">
                            <img src="./src/img/ipsum/logo-<?=$i?>.svg" class="img-fluid" alt="logo-<?=$i?>">
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <section class="h-auto w-100 container my-5">
                <div id="feature">
                    <div class="row justify-content-center align-items-center g-2 my-3">
                        <small class="text-primary text-center">Well, welcome!</small>
                        <h1 class="text-center text-secondary fs-3 fw-bold">Apa yang bisa kamu lakukan?</h1>
                    </div>
                    <div class="row mt-2 justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="card bg-transparent p-4 rounded border-0">
                                <div>
                                    <span class="mdi mdi-account-group fs-1 text-secondary"></span>
                                </div>
                                <div>
                                    <p class="fw-bold text-primary">Mencari dan Membentuk Team</p>
                                    <p class="text-muted mt-3">Sebagai wadah untuk mencari dan membentuk team untuk mengembangkan ide kreatif kamu.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card bg-transparent p-4 rounded border-0">
                                <div>
                                    <span class="mdi mdi-lightbulb fs-1 text-secondary"></span>
                                </div>
                                <div>
                                    <p class="fw-bold text-primary">Memamerkan Ide Kreatif</p>
                                    <p class="text-muted mt-3">Tunjukkan dan bagikan ide kreatif kamu kepada orang lain. Siapa tau ada yang tertarik!</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card bg-transparent p-4 rounded border-0">
                                <div>
                                    <span class="mdi mdi-trophy fs-1 text-secondary"></span>
                                </div>
                                <div>
                                    <p class=" fw-bold text-primary">Berkesempatan Menjadi Juara</p>
                                    <p class="text-muted mt-3">Tentu dengan menjadi bagian dari Polinema Innovation Tribe kamu memiliki kesempatan untuk menjadi juara!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row container my-5">
                <section class="row justify-content-between align-items-center ">
                    <div class="col-lg-5 col-md-12 col-sm-12 justify-content-start align-items-center g-2 mt-3">
                        <small class="text-primary"> Testimonial </small>
                        <h1 class="fs-2 fw-bold text-start text-secondary"> What they say? </h1>
                        <p class="fw-normal text-start text-black-50 fw-light">
                            Kata mereka tentang Polinema Innovation Tribe yang telah berhasil membantu mereka mencetak ide kreatif. Dengarkan cerita mereka dan jadilah bagian dari Polinema Innovation Tribe!
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div id="carouselTestimonial" class="carousel carousel-dark slide py-3" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselTestimonial" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselTestimonial" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselTestimonial" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner mb-3 p-5">
                                <?php for ($i = 0; $i < 3; $i++) : ?>
                                    <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
                                        <div class="card border-0 text-center bg-transparent">
                                            <div class="card-body">
                                                <img src="src/img/profile/<?= $testimoni[$i]['FOTO'] ?>" class="img-fluid cover avatar avatar-small rounded-circle mx-auto shadow" alt="" width="100px">
                                                <p class="text-muted mt-4">" <?= $testimoni[$i]['komentar']  ?> "</p>
                                                <h6 class="text-primary">- <?= $testimoni[$i]['NAMA']  ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselTestimonial" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselTestimonial" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </section>
        <section id="faq" class="container">
            <div class="row justify-content-center align-items-center g-2 my-3">
                <small class="text-primary text-center">Curious about us? Here is F.A.Q for u!</small>
                <h1 class="text-center text-secondary fs-3 fw-bold">Frequently Asked Questions</h1>
            </div>
            <div class="accordion accordion-flush row px-2" id="accordionFlushExample">
                <div class="px-2 col-lg-4 col-sm-12">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Apa itu Polinema Innovation Tribe?
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Polinema Innovation Tribe adalah wadah bagi mahasiswa Politeknik Negeri Malang untuk mengembangkan ide kreatifnya. Polinema Innovation Tribe juga merupakan wadah bagi mahasiswa Politeknik Negeri Malang untuk berkolaborasi dengan mahasiswa Politeknik Negeri Malang lainnya.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-2 col-lg-4 col-sm-12 ">
                    <div class="accordion-item ">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Apa saja keuntungan menjadi bagian dari Polinema Innovation Tribe?
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <ul>
                                    <li>Memperoleh pengalaman dalam mengembangkan ide kreatif</li>
                                    <li>Memperoleh pengalaman dalam berkolaborasi dengan mahasiswa Politeknik Negeri Malang lainnya</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="container-fluid">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a>
                <span class="mb-3 mb-md-0 text-muted">&copy; 2022 PTI</span>
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
    <script src="./src/js/jquery.js"></script>
    <script>
        $('#eye-login').click(function() {
            if ($('#eye-login').hasClass('mdi-eye')) {
                $('#eye-login').removeClass('mdi-eye');
                $('#eye-login').addClass('mdi-eye-off');
                $('#password-login').attr('type', 'text');
            } else {
                $('#eye-login').removeClass('mdi-eye-off');
                $('#eye-login').addClass('mdi-eye');
                $('#password-login').attr('type', 'password');
            }
        });
    </script>
    <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="./src/js/particles.js"></script>
    <script src="./src/js/app.js"></script>
</body>

</html>