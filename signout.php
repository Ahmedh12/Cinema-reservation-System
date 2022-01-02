<?php
setcookie("LoggedIn", "", time() - 7200, "/");
setcookie("user", "", time() - 7200, "/");
include("home.php");
?>