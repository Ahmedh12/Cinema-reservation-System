<?php
include "./admin/db_connect.php";

if (isset($_COOKIE["LoggedIn"])) {
    //fetching the cookie that contains the reserved seats
    $seats = $_COOKIE["cancelled"];
    $hall = $_POST["hall"];
    $movie = $_POST["movie"];
    $username = $_COOKIE["user"];
    //Cookie is sent as a comma separated string , so explode it and store the returned array
    $seats = explode(",", $seats, -1);

    //Convert the arry of string to integers
    $counter = 0;
    foreach ($seats as $s) {
        $seats[$counter] = intval($s);
        $counter += 1;
    }

    //Cancelling the reservation for the selected seats
    foreach ($seats as $s) {
        $sql = "Delete from `reservations` where `user_name` = '$username' && `movie_id` = $movie && `room_id` = $hall && `chair_id`= $s";
        mysqli_query($conn, $sql);
    }

    echo <<<EOL
        <html>
        <head>
        <meta http-equiv="refresh" content="3;url=index.php?page=loggedin" />
        <title></title>
        </head>
        <body>
        <h1>Reservation Canceled -- Redirecting to home Page...</h1>
        </body>
        </html>
    EOL;

} else {
    echo <<<EOL
    <html>
    <head>
    <meta http-equiv="refresh" content="3;url=index.php" />
    <title></title>
    </head>
    <body>
    <h1>You are Not logged in-- Redirecting to home Page...</h1>
    </body>
    </html>
    EOL;
}
