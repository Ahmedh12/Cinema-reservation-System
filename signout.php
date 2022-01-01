<?php
setcookie("LoggedIn", "", time() - 7200, "/");
include("login.html");
