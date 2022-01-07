 <?php
    if (isset($_COOKIE["LoggedIn"])) {
        include("loggedin.php");
    } else if (isset($_COOKIE["manager"])) {
        include("manager.php");
    } else {
        include("login.html");
    }
?>