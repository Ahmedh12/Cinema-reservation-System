 <?php

    if (isset($_COOKIE["LoggedIn"])) {
        include("home.php");
    } else {
        include("login.html");
    }

    ?>