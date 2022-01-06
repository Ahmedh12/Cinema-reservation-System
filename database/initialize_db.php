<?php
error_reporting(-1);
ini_set('display_errors', 'On');

$conn = mysqli_connect("localhost", "root", "mira2000");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_errno());
}
if (mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS theater_db")) {
    //echo "Database created";
    mysqli_select_db($conn, "theater_db");
    $sqlqueries = array(
        "CREATE TABLE IF NOT EXISTS  `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`),
    `username` varchar(50) NOT NULL,
    `password` varchar(50) NOT NULL,
    `email` varchar(50) NOT NULL,
    `first_name` varchar(50) NOT NULL,
    `last_name` varchar(50) NOT NULL,
    `admin` bit NOT NULL, /* 1-> Admin. 0 -> Normal user*/
    `request_admin` bit NOT NULL /*v->requested, 0-> rejected or not requested.*/
);",

        "CREATE TABLE IF NOT EXISTS `movies` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`),
    `title` varchar(50) NOT NULL,
    /*`description` varchar(50) NOT NULL*/
    `duration` int(11) NOT NULL,
    `release_date` date NOT NULL,
    /*`start_time` time NOT NULL,*/
    /*`end_time` time NOT NULL,*/
    `room` varchar(50) NOT NULL,
    `poster_image` varchar(255) NOT NULL
);",

        "CREATE TABLE IF NOT EXISTS `rooms` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`),
    `room_number` int(11) NOT NULL,
    `totalchairs` int(11) NOT NULL
    /*--`room_capacity` int(11) NOT NULL*/
);",

        "CREATE TABLE IF NOT EXISTS `reservations` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`),
    `user_id` int(11) NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
    `room_id` int(11) NOT NULL,
    FOREIGN KEY (`room_id`) REFERENCES `rooms`(`id`),
    `chair_id` int(11) NOT NULL
)",
        "CREATE TABLE IF NOT EXISTS `show_times` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`),
    `movie_id` int(11) NOT NULL,
    Foreign Key (`movie_id`) References `movies`(`id`),
    `start_time` time NOT NULL,
    `end_time` time NOT NULL,
    `show_date` date NOT NULL,
    `room_id` int(11) NOT NULL
)"
    );
    foreach ($sqlqueries as $sql)
        mysqli_query($conn, $sql);

    $sampleMovieData = "INSERT INTO `movies` (`id`, `title`, `poster_image`, `duration`, `release_date`,`room`) VALUES
(1, 'The Matrix', '1600221180_matrix.jpg', 2.5, '2020-09-15',1),
(4, 'The Wolf of Wall Street', '1600221240_img 2.jpg', 3.75, '2020-09-17',2),
(5, 'Greatest Showman', '1600221900_images.jpg', 3, '2020-09-01',1),
(6, 'Jaws', '1600221900_download.jpg', 2.75, '2020-07-22',2),
(7, 'Extractions', '1600222080_extraction-20200423134825-19294.jpg', 3, '2020-09-02',1),
(8, 'Avengers End Game', '1600222200_avengersendgame-20190417122917-18221.jpg', 3, '2020-05-12',1),
(9, 'White House Down', '1600237980_download (1).jpg', 3, '2020-09-08',2);";
    mysqli_query($conn, $sampleMovieData);

    $sampleRoomData = "INSERT INTO `rooms` (`id`, `room_number`, `totalchairs`) VALUES
    (1, 3, 20);";
    mysqli_query($conn, $sampleRoomData);

    $update = "UPDATE `movies` SET `room`='3' WHERE `id`=1;";
    mysqli_query($conn, $update);

    $updateshow = "UPDATE `show_times` SET `start_time`='08:00', `end_time`='10:00', `movie_id`=1, `room_id`=1 WHERE `id`=1;";
    mysqli_query($conn, $updateshow);

    // $sampleShowData = "INSERT INTO `show_times` (`id`, `movie_id`, `start_time`, `end_time`, `room_id`) VALUES
    // (1, 1, 08:00, 10:30, 1);";
    // mysqli_query($conn, $sampleShowData);

} else
    echo "Error creating database: " . mysqli_error($conn);

    mysqli_close($conn);