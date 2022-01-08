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

  $sql1 = ("SELECT * FROM rooms WHERE `room_number`='{$screeningRoom}'");
  $result = mysqli_query($conn, $sql1) or die("Unsuccessful Room Selection.");
  $fetched_room_id = mysqli_fetch_array($result);
  if ($fetched_room_id) {
    $room_id = $fetched_room_id[0];
  } else {
      echo "Such room doesn't exist.<br>";
      return;
  }

  if($fetched_room_id[1] != $screeningRoom)
  {
      echo "Such room doesn't exist.<br>";
      return;
  }
  echo $title."<br>";
  echo $date."<br>";
    //   echo $startTime."<br>";
    //   echo $endTime."<br>";
    //   echo $screeningRoom."<br>";
    //   echo $image."<br>";
    //   echo $fetched_room_id[0]."<br>";
    //   echo $fetched_room_id[1]."<br>";

  $sql2 = "INSERT INTO `movies` (`title`, `room`, `poster_image`) VALUES ('$title', '$screeningRoom', '$image')";
  mysqli_query($conn, $sql2);
  if(mysqli_query($conn, $sql2)) {
      echo "Successful insertion into the movies table.<br>";

      $sql3 = ("SELECT * FROM movies WHERE `title`='{$title}' AND `room`='{$screeningRoom}'");
      $result = mysqli_query($conn, $sql3) or die("Unsuccessful Movie Selection.");
      $fetched_movie_id = mysqli_fetch_array($result);
      if ($fetched_movie_id) {
        $movie_id = $fetched_movie_id[0];
      } else {
          return;
      } 
      
      $sql4 = "INSERT INTO `show_times` (`movie_id`, `start_time`, `end_time`, `show_date`, `room_id`) VALUES ('$movie_id', '$startTime', '$endTime', '$date', '$room_id')";
      mysqli_query($conn, $sql4);
      if(mysqli_query($conn, $sql4)) {
          echo "Successful insertion into the showTimes table.<br>You Can Go Back Now.";
      }
  } else {
      echo "Failed to insert the movie.<br>";
  }
}

function edit_movie($conn)
{
    // To be completed 
    $id = $_GET['id'];
    $title = $_GET["title"];
    $date = $_GET["date"];
    $startTime = $_GET["startTime"];
    $endTime = $_GET["endTime"];
    $screeningRoom = $_GET["screeningRoom"];
    $image = $_GET["posterImage"];

    if($screeningRoom != "")
    {
        $sql1 = ("SELECT * FROM rooms WHERE `room_number`='{$screeningRoom}'");
        $result = mysqli_query($conn, $sql1) or die("Unsuccessful Room Selection.");
        $fetched_room_id = mysqli_fetch_array($result);
        if ($fetched_room_id) {
            $room = $fetched_room_id[1];
            $update = "UPDATE `movies` SET `room`='{$room}' WHERE `id`='{$id}';";
            mysqli_query($conn, $update);
            if(!mysqli_query($conn, $update)) {
                echo "Update Failed.<br>";
                return;
            }

        } else {
            echo "Such room doesn't exist.<br>";
            return;
        }
    }

    echo $title."<br>";
    echo $date."<br>";
      //   echo $startTime."<br>";
      //   echo $endTime."<br>";
      //   echo $screeningRoom."<br>";
      //   echo $image."<br>";
      //   echo $fetched_room_id[0]."<br>";
      //   echo $fetched_room_id[1]."<br>";
  
    $sql2 = "INSERT INTO `movies` (`title`, `show_date`, `room`, `poster_image`) VALUES ('$title', '$date', '$screeningRoom', '$image')";
    mysqli_query($conn, $sql2);
    if(mysqli_query($conn, $sql2)) {
        echo "Successful insertion into the movies table.<br>";
  
        $sql3 = ("SELECT * FROM movies WHERE `title`='{$title}' AND `show_date`='{$date}' AND `room`='{$screeningRoom}'");
        $result = mysqli_query($conn, $sql3) or die("Unsuccessful Movie Selection.");
        $fetched_movie_id = mysqli_fetch_array($result);
        if ($fetched_movie_id) {
          $movie_id = $fetched_movie_id[0];
        } else {
            return;
        } 
        
        $sql4 = "INSERT INTO `show_times` (`movie_id`, `start_time`, `end_time`, `room_id`) VALUES ('$movie_id', '$startTime', '$endTime', '$room_id')";
        mysqli_query($conn, $sql4);
        if(mysqli_query($conn, $sql4)) {
            echo "Successful insertion into the showTimes table.<br>You Can Go Back Now.";
        }
    } else {
        echo "Failed to insert the movie.<br>";
    }
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
                <p style="font-size: 200%; font-family: sans-serif; color: #fff; margin: 25%; margin-top: 18%; text-align: center;"
                    href="#" class="post_method">
                    <?php 
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        insert_movie($conn);
                        // echo "Successful insertion into the showTimes table.<br>You Can Go Back Now.";
                    }
                    else {
                        // edit_movie($conn);
                        echo "Successful Update.<br>You Can Go Back Now.";
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