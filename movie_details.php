<?php
include 'admin/db_connect.php';
$movies = $conn->query("SELECT * FROM movies  limit 10");
?>

<head>
    <link rel="stylesheet" href="css/addmovie.css" />
    <style>
    * {
        font-family: "Open Sans", sans-serif;
    }

    .detailsInfo {
        color: #ff5f00;
        font-size: 150%;
    }

    .detailsInfo2 {
        color: #D8F0F7;
        font-size: 150%;
    }

    .details_content {
        padding: 10px;
        margin: 10%;
        margin-left: 25%;
        margin-right: 25%;
        width: 50%;
        border: 5px solid Black;
        border-radius: 8px;
    }

    .footer {
        text-align: center;
        width: 100%;
        color: #fff;
        font-size: 180%;
    }

    .editmovie {
        margin-left: 33.5%;
    }
    </style>
</head>

<div class="all_movies">
    <center>
        <h3 class="text-primary">Now Showing</h3>
    </center>
    <div id="movie-carousel-field">
        <div class="list-prev list-nav">
            <a href="javascript:void(0)" class="text"><i class="fa fa-angle-left"></i></a>
        </div>
        <div class="list">
            <?php while ($row = $movies->fetch_assoc()) : ?>
            <div class="movie-item">
                <img class="" src="assets/img/<?php echo $row['poster_image']  ?>" alt="<?php echo $row['title'] ?>">
                <div class="mov-det">
                    <button class="btn btn-primary details">Details <?php $movieName=$row['title'] ?></button> <button
                        class="btn btn-primary edit">Edit</button>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="list-next list-nav">
            <a href="javascript:void(0)" class="text"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>

<div class="movie_details">
    <center>
        <h3 class="text-primary">Details</h3>
    </center>
    <?php
          $sql = ("SELECT * FROM movies WHERE `title`='{$movieName}'");
          $result = mysqli_query($conn, $sql) or die("Unsuccessful Movie Selection.");
          $fetched_movie_id = mysqli_fetch_array($result);
          if ($fetched_movie_id) {
            $movie_id = $fetched_movie_id[0];
            $title = $fetched_movie_id[1];
            $duration = $fetched_movie_id[2];
            $date = $fetched_movie_id[3];
            // $startTime = $fetched_movie_id[0];
            // $endTime = $fetched_movie_id[0];
            $startTime ="Start Time";
            $endTime = "End Time";
            $screeningRoom = $fetched_movie_id[4];
            $posterImage = $fetched_movie_id[5];

            // echo $movie_id.'<br>';
            // echo $title.'<br>';
            // echo $duration.'<br>';
            // echo $date.'<br>';
            // echo $screeningRoom.'<br>';
            // echo $posterImage.'<br>';
            
          } else {
              echo "Failed to retrieve '".$movieName."'.<br>";
              return;
          }
    ?>
    <div class="details_content">
        <label class="detailsInfo">Name: </label> <span class="detailsInfo2"><?php echo $title.'<br>'; ?></span>
        <label class="detailsInfo">Show date: </label> <span class="detailsInfo2"><?php echo $date.'<br>'; ?></span>
        <label class="detailsInfo">Start Time: </label> <span
            class="detailsInfo2"><?php echo $startTime.'<br>'; ?></span>
        <label class="detailsInfo">End Time: </label> <span class="detailsInfo2"><?php echo $endTime.'<br>'; ?></span>
        <label class="detailsInfo">Duration: </label> <span class="detailsInfo2"><?php echo $duration.'<br>'; ?></span>
        <label class="detailsInfo">Screening Room: </label> <span
            class="detailsInfo2"><?php echo $screeningRoom.'<br>'; ?></span>
        <label class="detailsInfo">Poster Image: </label> <span
            class="detailsInfo2"><?php echo $posterImage.'<br>'; ?></span>
    </div>
    <center>
        <h3 class="footer">Refresh To Go Back</h3>
    </center>
</div>

<div class="edit_movie">
    <center>
        <h3 class="text-primary">Edit</h3>
    </center>
    <div class="editmovie">
        <form action="add_movie.php" method="GET" id="editmovie" onsubmit="return verify_modification()">
            <div class="form_container" style="margin: 5%">
                <p class="heading" style="opacity: 0;">ADD A MOVIE</p>

                <div class="input_div">
                    <input type="text" class="input_data" placeholder="Movie Title" name="title" id="title" />
                    <input type="date" class="input_data" placeholder="Movie Date" name="date" id="date" />
                    <input type="time" class="input_data" placeholder="Start Time" name="startTime" id="startTime" />
                    <input type="time" class="input_data" placeholder="End Time" name="endTime" id="endTime" />
                    <input type="text" class="input_data" placeholder="Screening Room" name="screeningRoom"
                        id="screeningRoom" />
                    <input type="file" class="input_data" placeholder="Poster Image" name="posterImage" id="posterImage"
                        accept="image/*" style="padding-bottom: 35px;" />
                    <br />
                    <br />
                </div>

                <button type="submit" form="editmovie" class="btn_add">EDIT</button>
            </div>
        </form>
    </div>
    <center>
        <h3 class="footer">Refresh To Go Back</h3>
    </center>
</div>

<script>
$(document).ready(function() {
    $('.movie_details').hide();
    $('.edit_movie').hide();
})

$('.details').click(function() {
    $('.movie_details').show();
    $('.all_movies').hide();
    $('.edit_movie').hide();
})

$('.edit').click(function() {
    $('.edit_movie').show();
    $('.all_movies').hide();
    $('.movie_details').hide();
})

$('#movie-carousel-field .list-next').click(function() {
    $('#movie-carousel-field .list').animate({
        scrollLeft: $('#movie-carousel-field .list').scrollLeft() + ($('#movie-carousel-field .list')
            .find('img').width() * 3)
    }, 'slow');
})

$('#movie-carousel-field .list-prev').click(function() {
    $('#movie-carousel-field .list').animate({
        scrollLeft: $('#movie-carousel-field .list').scrollLeft() - ($('#movie-carousel-field .list')
            .find('img').width() * 3)
    }, 'slow');
})
</script>