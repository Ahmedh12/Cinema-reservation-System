 <?php

    if (isset($_COOKIE["LoggedIn"])) {
        include("loggedin.php");
    } else {
        include("login.html");
    }

    ?>