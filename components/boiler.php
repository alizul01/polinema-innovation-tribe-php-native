<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polinema Innovation Tribe | Home</title>
    <link rel="stylesheet" href="./../src/custom.css">
    <link rel="stylesheet" href="./../src/icon/materialdesignicons.min.css">
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
                        <a class="nav-link" href="./../src/pages/idea.php">Idea Sandbox</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#work">Works</a>
                    </li>
                </ul>

                <div>
                    <!-- register button and login button -->
                    <a href="./../src/html/register.php" class="btn btn-primary me-2">Register</a>
                    <a href="./../src/html/login.php" class="btn btn-outline-primary">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <main>
        
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
    <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="./../src/js/particles.js"></script>
    <script src="./../src/js/app.js"></script>
</body>

</html>