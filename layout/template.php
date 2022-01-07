<?php
if (!isset($_SESSION)) {
    session_set_cookie_params(0);
    session_start();
} ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Money Manager</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">

    <meta name="theme-color" content="#fafafa">
</head>

<body>

    <header class="bg-dark text-white text-center ">
        <h1 class="m-0 p-2">Money Manager</h1>
        <?php
        $namesResult = "";
        if (!empty($_SESSION["userID"])) {
            require_once "./model/entity/user.class.php";
            $user = new User($_SESSION["userID"]);
            $namesResult = $user->getUserNames();
        }
        $names = $namesResult ? $namesResult["prenom"] . " " . $namesResult["nom"] : "";
        ?>
        <span class="d-flex gap-4 justify-content-end">
            <?php echo $names;
            echo (!empty($_SESSION["logged_in"]) && $_SESSION["logged_in"]) ? "<button onclick='logOut()'> Log out </button>" : "<button onclick='signIn()'> Sign in </button>";
            ?>
        </span>
        <script>
            // ------------------------------------ SIGN IN/ LOG OUT -------------------------------------------
            function logOut() {
                document.location.href = '<?php echo "./logout.php"; ?>';
            }

            function signIn() {
                document.location.href = '<?php echo "./login.php"; ?>';
            }
        </script>
    </header>
    <!------------------------------------------------- NAVBAR ------------------------------------------------->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="acceuil.php">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stat.php">Statistique</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="operation.php">Opération</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <body>
        <main class="container-fluid d-flex justify-content-center align-content-center flex-column flex-lg-wrap flex-lg-rowp-3 bg-info">
            <?= $content ?>
        </main>
    </body>
    <footer>
        <h1>Footer</h1>
    </footer>

    <script src="js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/stat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/ulg/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('set', 'anonymizeIp', true);
        ga('set', 'transport', 'beacon');
        ga('send', 'pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async></script>
</body>

</html>