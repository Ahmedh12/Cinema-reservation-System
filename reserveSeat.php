<?php
include "./admin/db_connect.php";

if (isset($_COOKIE["LoggedIn"])) {
    //fetching the cookie that contains the reserved seats
    $seats = $_COOKIE["reserved"];
    $hall = $_POST["hall"];
    $movie = $_POST["movie"];
    $username = $_COOKIE["user"];
    //Cookie is sent as a comma separated string , so explode it and store the returned array
    $seats = explode(",", $seats, -1);

    //canceling old user reservation
    //$conn->query("Delete from `reservations` where `user_name` = '$username' && `movie_id` = $movie && `room_id` = $hall");

    //Convert the arry of string to integers
    $counter = 0;
    foreach ($seats as $s) {
        $seats[$counter] = intval($s);
        $counter += 1;
    }
    foreach ($seats as $s) {
        $sql = "INSERT INTO `reservations` (`user_name`, `room_id`, `movie_id`, `chair_id`) VALUES ('$username', $hall, $movie, $s)";
        mysqli_query($conn, $sql);
    }
    print_r($seats);
    echo $hall.$movie.$username;
    echo "<h1>Reservation Confirmed -- Redirecting to home Page...</h1>";
    header("Location:index.php?page=loggedin");

} else {
    header("Location:index.php");
}
