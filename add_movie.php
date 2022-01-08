<!-- 
    POST => insert movie 
    GET  => edit movie -->

<?php
include 'admin/db_connect.php';

function insert_movie($conn)
{
    $title = $_POST["title"];
    $date = $_POST["date"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];
    $screeningRoom = $_POST["screeningRoom"];
    $image = $_POST["posterImage"];

    $status = verifications($title, $date, $startTime, $endTime, $screeningRoom, $image);

    if($status) {
        
        $sql1 = ("SELECT * FROM rooms WHERE `room_number`='{$screeningRoom}'");
        $result = mysqli_query($conn, $sql1) or die("Unsuccessful Room Selection.");
        $fetched_room_id = mysqli_fetch_array($result);
        if ($fetched_room_id) {
            $room_id = $fetched_room_id[0];
        } else {
            echo "Such room doesn't exist.<br>ABORTING REQUEST<br>";
            return;
        }

        //   if($fetched_room_id[1] != $screeningRoom)
        //   {
        //       echo "Such room doesn't exist.<br><br>ABORTING REQUEST<br>";
        //       return;
        //   }

        //   echo $title."<br>";
        //   echo $date."<br>";
        //   echo $startTime."<br>";
        //   echo $endTime."<br>";
        //   echo $screeningRoom."<br>";
        //   echo $image."<br>";
        //   echo $fetched_room_id[0]."<br>";
        //   echo $fetched_room_id[1]."<br>";

        $sql2 = "INSERT INTO `movies` (`title`, `room`, `poster_image`) VALUES ('$title', '$screeningRoom', '$image')";
        if(mysqli_query($conn, $sql2)) {
            echo "Successful insertion into the movies table.<br>";

            $sql3 = ("SELECT * FROM movies WHERE `title`='{$title}' AND `room`='{$screeningRoom}'");
            $result = mysqli_query($conn, $sql3) or die("Unsuccessful Movie Selection. ABORTING REQUEST<br>");
            $fetched_movie_id = mysqli_fetch_array($result);
            if ($fetched_movie_id) {
                $movie_id = $fetched_movie_id[0];
            } else {
                return;
            } 
            
            $sql4 = "INSERT INTO `show_times` (`movie_id`, `start_time`, `end_time`, `show_date`, `room_id`) VALUES ('$movie_id', '$startTime', '$endTime', '$date', '$room_id')";
            if(mysqli_query($conn, $sql4)) {
                echo "Successful insertion into the showTimes table.<br>You Can Go Back Now.";
            }
        } else {
            echo "Failed to insert the movie.<br>ABORTING REQUEST<br>";
        }
    }

    
}

function verifications($title, $date, $startTime, $endTime, $screeningRoom, $image)
{
    date_default_timezone_set('Egypt');

    // echo "title: ".$title."<br>";
    // echo "date: ".$date."<br>";
    // echo "startTime: ".$startTime."<br>";
    // echo "endTime: ".$endTime."<br>";
    // echo "screeningRoom: ".$screeningRoom."<br>";
    // echo "image: ".$image."<br>";
    
    if(!$title) {
        echo "A title is required.<br>ABORTING REQUEST<br>";
        return false;
    }

    if(!$date) {
        echo "A date is required.<br>ABORTING REQUEST<br>";
        return false;
    }

    if(!$startTime) {
        echo "A start time is required.<br>ABORTING REQUEST<br>";
        return false;
    }

    if(!$endTime) {
        echo "A end time is required.<br>ABORTING REQUEST<br>";
        return false;
    }

    if(!$screeningRoom) {
        echo "A screening room is required.<br>ABORTING REQUEST<br>";
        return false;
    }

    if(!$image) {
        echo "An image is required.<br>ABORTING REQUEST<br>";
        return false;
    }

    if($endTime <= $startTime) {
        echo "End time can't be less than start time.<br>ABORTING REQUEST<br>";
        return false;
    }

    if($date < date("Y-m-d")) {
        echo "Show's date can't be before today's date.<br>ABORTING REQUEST<br>";
        return false;
    }

    if(($startTime < date("H:i:s")) && ($date < date("Y-m-d"))) {
        echo "Show's start time can't be before current start time.<br>ABORTING REQUEST<br>";
        return false;
    }
    
    // $timezone = date_default_timezone_get();
    // echo "The current server timezone is: " . $timezone . "<br>";
    // echo "Now is " . date("H:i:s") . "<br>";

    // (date("Y-m-d") > date("Y-m-d")) ? 1 : 0;

    return true;
}

function edit_movie($conn)
{
    $id;
    $title = $_GET["title"];
    $date = $_GET["date"];
    $startTime = $_GET["startTime"];
    $endTime = $_GET["endTime"];
    $screeningRoom = $_GET["screeningRoom"];
    $image = $_GET["posterImage"];

    $sql1 = ("SELECT * FROM movies WHERE `title`='{$title}' AND `room`='{$screeningRoom}' AND `poster_image`='{$image}'");
    $result = mysqli_query($conn, $sql1) or die("Unsuccessful Movie id Selection.");
    // if(!mysqli_query($conn, $sql1)) {
    //     echo "Movie not retrieved.<br>";
    //     return;
    // } else {
    //     echo "Movie retrieved.<br>";
    // }
    $fetched_movie_id = mysqli_fetch_array($result);
    echo "Result: ".$fetched_movie_id."<br>";

    if ($fetched_movie_id) {
        $id = $fetched_movie_id[1];
        echo $id;
    } else {
        echo "ID not retrieved.<br>";
    }

    if($title) {
        $update = "UPDATE `movies` SET `title`='{$title}' WHERE `id`='{$id}';";
        // mysqli_query($conn, $update);
        if(!mysqli_query($conn, $update)) {
            echo "Title update Failed.<br>";
            return;
        }
    }

    if($image) {
        $update = "UPDATE `movies` SET `poster_image`='{$image}' WHERE `id`='{$id}';";
        // mysqli_query($conn, $update);
        if(!mysqli_query($conn, $update)) {
            echo "Poster image update Failed.<br>";
            return;
        }
    }
    
    $room;
    if($screeningRoom) {
        $sql1 = ("SELECT * FROM rooms WHERE `room_number`='{$screeningRoom}'");
        $result = mysqli_query($conn, $sql1) or die("Unsuccessful Room Selection.");
        $fetched_room_id = mysqli_fetch_array($result);
        if ($fetched_room_id) {
            $room = $fetched_room_id[1];
            $update = "UPDATE `movies` SET `room`='{$room}' WHERE `id`='{$id}';";
            // mysqli_query($conn, $update);
            if(!mysqli_query($conn, $update)) {
                echo "Room update Failed.<br>";
                return;
            }

        } else {
            echo "Such room doesn't exist.<br>";
            return;
        }
    } else {
        $sql1 = ("SELECT * FROM movies WHERE `id`='{$id}'");
        $result = mysqli_query($conn, $sql1) or die("Unsuccessful Movie Selection.");
        $fetched_room_id = mysqli_fetch_array($result);
        if ($fetched_room_id) {
            $room = $fetched_room_id[2];
        }
    }

    if($date) {
        $update = "UPDATE `show_times` SET `show_date`='{$date}' WHERE `movie_id`='{$id}' AND `room_id`='{$room}';";
        // mysqli_query($conn, $update);
        if(!mysqli_query($conn, $update)) {
            echo "Date update Failed.<br>";
            return;
        }
    }

    if($startTime) {
        $update = "UPDATE `show_times` SET `start_time`='{$startTime}' WHERE `movie_id`='{$id}' AND `room_id`='{$room}';";
        // mysqli_query($conn, $update);
        if(!mysqli_query($conn, $update)) {
            echo "Date update Failed.<br>";
            return;
        }
    }

    if($endTime) {
        $update = "UPDATE `show_times` SET `end_time`='{$endTime}' WHERE `movie_id`='{$id}' AND `room_id`='{$room}';";
        // mysqli_query($conn, $update);
        if(!mysqli_query($conn, $update)) {
            echo "Date update Failed.<br>";
            return;
        }
    }

    echo "Successful Update.<br>You Can Go Back Now.";
}
?>

<html>

<head>
    <link rel="stylesheet" href="css/styles.css" />
</head>
<header class="masthead">

    <body id="page-top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <p style="font-size: 200%; font-family: sans-serif; color: #fff; margin: 24%; margin-top: 18%; text-align: center;"
                    href="#" class="post_method">
                    <?php 
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        insert_movie($conn);
                    }
                    else {
                        edit_movie($conn);
                    }
                    ?>
                </p>
            </div>
        </nav>
    </body>
</header>

</html>

<!-- <script>
$(document).ready(function() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $('.post_method').show();
        $('.get_method').hide();
    } else {
        $('.get_method').show();
        $('.post_method').hide();
    }
})
</script> -->