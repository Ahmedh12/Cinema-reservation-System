<?php
setcookie("LoggedIn", "", time() - 7200, "/");
setcookie("manager", "", time() - 7200, "/");
setcookie("user", "", time() - 7200, "/");
echo <<<EOL
    <html>
    <head>
    <meta http-equiv="refresh" content="0;url=index.php" />
    <title></title>
    </head>
    </html>
    EOL;
include("home.php");
?>