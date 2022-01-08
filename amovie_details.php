<!-- 
    GET => movie details
-->

<?php
include 'admin/db_connect.php';
session_start();

function movie_details($conn)
{
    $movieName = $_GET['title'];
    $sql = ("SELECT * FROM movies WHERE `title`='{$movieName}'");
    $result = mysqli_query($conn, $sql) or die("Unsuccessful Movie Selection.");
    $fetched_movie_id = mysqli_fetch_array($result);
    if (!$fetched_movie_id) {
        echo "Failed to retrieve '".$movieName."'.<br>";
        return;
    }      
    $movie_id = $fetched_movie_id[0];
    $title = $fetched_movie_id[1];
    $screeningRoom = $fetched_movie_id[2];
    $posterImage = $fetched_movie_id[3];
        
    $sql = ("SELECT * FROM rooms WHERE `room_number`='{$screeningRoom}'");
    $result = mysqli_query($conn, $sql) or die("Unsuccessful Room Selection.");
    $fetched_room_id = mysqli_fetch_array($result);
    if (!$fetched_room_id) {
        echo "Failed to retrieve Screening Room.<br>";
        return;
    }
    $room_id = $fetched_room_id[0];
            
    $sql = ("SELECT * FROM show_times WHERE `movie_id`='{$movie_id}' AND `room_id`='{$room_id}'");
    // $sql = ("SELECT * FROM show_times WHERE `id`=1");
    $result = mysqli_query($conn, $sql) or die("Unsuccessful Show Time Selection.");
    $fetched_show_id = mysqli_fetch_array($result);
    if (!$fetched_show_id) {
        echo "Failed to retrieve Show Time.<br>";
        return;
    }
    $startTime = $fetched_show_id[2];
    $endTime = $fetched_show_id[3];
    $date = $fetched_show_id[4];
    // $startTime = '11:00:00';
    // $endTime = '12:45:00';
    $duration = (strtotime($endTime) - strtotime($startTime)) / 3600;

    // echo $movie_id.'<br>';
    // echo $title.'<br>';
    // echo $date.'<br>';
    // echo $screeningRoom.'<br>';
    // echo $posterImage.'<br>';
    // echo $room_id.'<br>';

    $_SESSION["title"] = $title;
    $_SESSION["date"] = $date;
    $_SESSION["startTime"] = $startTime;
    $_SESSION["endTime"] = $endTime;
    $_SESSION["duration"] = $duration;
    $_SESSION["screeningRoom"] = $screeningRoom;
    $_SESSION["posterImage"] = $posterImage;
}

function destroy_session()
{
    session_destroy();
}

?>

<html>

<head>
    <link rel="stylesheet" href="css/styles.css" />
    <style>
    * {
        font-family: "Open Sans", sans-serif;
    }

    .detailsInfo {
        color: #ff5f00;
        font-size: 200%;
    }

    .detailsInfo2 {
        color: #D8F0F7;
        font-size: 200%;
    }

    .details_content {
        padding: 10px;
        margin: 8%;
        margin-left: 20%;
        margin-right: 25%;
        width: 50%;
        /* border: 5px solid Black;
        border-radius: 8px; */
        height: 50%
    }

    img {
        position: absolute;
        top: 28%;
        right: 23%;
    }
    </style>
</head>

<header class="masthead">

    <body id="page-top">
        <div class="movie_details">
            <?php movie_details($conn); ?>
            <center>
                <h3 style="font-size: 250%" class="text-primary">Details</h3>
            </center>
            <div class="details_content">
                <label class="detailsInfo">Name: </label> <span
                    class="detailsInfo2"><?php echo $_SESSION["title"].'<br>'; ?></span>
                <label class="detailsInfo">Show date: </label> <span
                    class="detailsInfo2"><?php echo $_SESSION["date"].'<br>'; ?></span>
                <label class="detailsInfo">From: </label> <span
                    class="detailsInfo2"><?php echo $_SESSION["startTime"].'<br>'; ?></span>
                <label class="detailsInfo">To: </label> <span
                    class="detailsInfo2"><?php echo $_SESSION["endTime"].'<br>'; ?></span>
                <label class="detailsInfo">Duration: </label> <span
                    class="detailsInfo2"><?php echo $_SESSION["duration"].'<br>'; ?></span>
                <label class="detailsInfo">Screening Room: </label> <span
                    class="detailsInfo2"><?php echo $_SESSION["screeningRoom"].'<br>'; ?></span>
                <img src="assets/img/<?php echo $_SESSION["posterImage"] ?>" alt="<?php echo $_SESSION["title"] ?>"
                    width="300">

            </div>
            <?php destroy_session(); ?>
        </div>
    </body>
</header>

</html>

<!-- <script>
$(document).ready(function() {
    $('img').animate({
        height: '+=50%',
        width: '+=50%'
    });
})
</script> -->

<!-- <div class="container">
    <p style="font-size: 200%; font-family: sans-serif; color: #fff; margin: 25%; margin-top: 18%; text-align: center;"
        href="#" class="post_method">

        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //     remove_movie($conn);
        // } else {
        //     movie_details($conn);
        // }

    </p>
</div> -->