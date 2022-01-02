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
    print_r($seats);
    echo $hall.$movie.$username;
    echo "<h1>Reservation Canceled -- Redirecting to home Page...</h1>";
    header("Location:index.php?page=loggedin");
    //sleep(3);

} else {
    header("Location:index.php");
}
