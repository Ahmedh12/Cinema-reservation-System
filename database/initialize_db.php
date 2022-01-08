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
    `admin` bit NOT NULL, /* 1-> Manager. 0 -> Normal user*/
    `site_admin` bit NOT NULL /*1-> Site Admin, 0-> Normal user or Manager*/
);",

        "CREATE TABLE IF NOT EXISTS `movies` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`),
    `title` varchar(50) NOT NULL,
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
    `room_id` int(11) NOT NULL,
    Foreign Key (`room_id`) References `rooms`(`id`)
)"
    );
    foreach ($sqlqueries as $sql)
        mysqli_query($conn, $sql);

    $sampleMovieData = "INSERT INTO `movies` (`id`, `title`, `poster_image`, `room`) VALUES
        (1, 'The Matrix', '1600221180_matrix.jpg', 1),
        (2, 'The Wolf of Wall Street', '1600221240_img 2.jpg', 2),
        (3, 'Greatest Showman', '1600221900_images.jpg', 1),
        (4, 'Jaws', '1600221900_download.jpg', 2),
        (5, 'Extractions', '1600222080_extraction-20200423134825-19294.jpg', 1),
        (6, 'Avengers End Game', '1600222200_avengersendgame-20190417122917-18221.jpg', 1),
        (7, 'White House Down', '1600237980_download (1).jpg', 2);";
    mysqli_query($conn, $sampleMovieData);

    $sampleRoomData = "INSERT INTO `rooms` (`id`, `room_number`, `totalchairs`) VALUES
        (1, 1, 20), 
        (2, 2, 30);";
    mysqli_query($conn, $sampleRoomData);

    $sampleShowData = "INSERT INTO `show_times` (`id`, `movie_id`, `start_time`, `end_time`, `show_date`, `room_id`) VALUES
        (1, 1, '11:00:00', '13:30:00', '2022-01-14', 1),
        (2, 2, '10:00:00', '13:45:00', '2022-01-12', 2),
        (3, 3, '15:00:00', '18:00:00', '2022-01-19', 1),
        (4, 4, '17:00:00', '19:30:00', '2022-01-16', 2),
        (5, 5, '12:00:00', '15:00:00', '2022-01-11', 1),
        (6, 6, '15:00:00', '18:00:00', '2022-01-13', 1),
        (7, 7, '14:00:00', '17:00:00', '2022-01-31', 2);";
    mysqli_query($conn, $sampleShowData);

    $sampleUsersData = "INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `admin`, `site_admin`) VALUES
        (1, 'user', 'user1234', 'john@test.com', 'John', 'Smith', 0, 0), 
        (2, 'manager', 'manager1', 'bob@test.com', 'Bob', 'Marley', 1, 0);";
    mysqli_query($conn, $sampleUsersData);

} else
    echo "Error creating database: " . mysqli_error($conn);

    mysqli_close($conn);