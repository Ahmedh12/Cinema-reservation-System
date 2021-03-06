<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Movie Theater | Seat Reservation</title>
    <link src="admin/assets/font-awesome/css/all.js" />
    <script src="admin/assets/vendor/jquery/jquery.min.js"></script>
    <script src="admin/assets/font-awesome/js/all.js"></script>

    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <?php
                if (!isset($_COOKIE["LoggedIn"]) && !isset($_COOKIE["manager"])) {
                    echo '<a class="navbar-brand js-scroll-trigger" href="index.php?page=home">Movie Theater Seat Reservation</a>';
                } else if(isset($_COOKIE["manager"])) {
                    echo '<a class="navbar-brand js-scroll-trigger" href="index.php?page=manager">Movie Theater Seat Reservation</a>';
                } else if(isset($_COOKIE["LoggedIn"])) {
                    echo '<a class="navbar-brand js-scroll-trigger" href="index.php?page=home">Movie Theater Seat Reservation</a>';
                }
            ?>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <?php
                    if (!isset($_COOKIE["LoggedIn"]) && !isset($_COOKIE["manager"])) {
                        echo '<li class="nav-item"><a class="nav-link" href="index.php?page=login">Login/Signup</a></li>';
                    } else if(isset($_COOKIE["manager"])) {
                        echo '<li class="nav-item"><a class="nav-link " href="#">' . "Welcome " . $_COOKIE["user"] .'</a></li>';
                        echo '<li class="nav-item"><a class="nav-link " href="index.php?page=add_movie">add a movie</a></li>';
                        echo '<li class="nav-item"><a class="nav-link " href="index.php?page=signout">sign-out</a></li>';
                    } else if(isset($_COOKIE["LoggedIn"])) {
                        echo '<li class="nav-item"><a class="nav-link " href="#">' . "Welcome " . $_COOKIE["user"] .'</a></li>';
                        echo '<li class="nav-item"><a class="nav-link " href="index.php?page=signout">sign-out</a></li>';
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>
    <?php

    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    include($page . '.php');
    ?>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>