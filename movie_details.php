<?php
include 'admin/db_connect.php';
$movies = $conn->query("SELECT * FROM movies  limit 20");

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

    .options {
        display: inline;
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
                    <form action="amovie_details.php" method="GET" id="<?php echo $row['title'];?>">
                        <input type="text" class="input_data hidden" name="title" id="title"
                            value="<?php echo $row['title'] ?>" />
                        <button type="submit" form="<?php echo $row['title'];?>"
                            class="btn btn-primary details options">Details</button>
                    </form>
                    <form action="amovie_edit.php" method="GET" id="<?php echo $row['id'];?>">
                        <input type="text" class="input_data hidden" name="id" id="id"
                            value="<?php echo $row['id'] ?>" />
                        <button style="position:relative; left:80px; bottom:158px;" type="submit"
                            form="<?php echo $row['id'];?>" class="btn btn-primary details options">Edit</button>
                    </form>

                    <!-- <button class="btn btn-primary edit options"
                        style="position:relative; left:200px; bottom:62px;">Edit</button> -->
                    <button class="btn btn-primary shows options"
                        style="position:relative; bottom:350px; ; left:30px">Seats Status</button>

                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="list-next list-nav">
            <a href="javascript:void(0)" class="text"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>

<!-- <div class="edit_movie">
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
</div> -->

<script>
$(document).ready(function() {
    // $('.edit_movie').hide();
    $('.hidden').hide();
})

// $('.edit').click(function() {
//     $('.edit_movie').show();
//     $('.all_movies').hide();
// })

// $('.details').click(function() {
//     // var title = $(this).data("title");
//     $.get("amovie_details.php", {
//         title: $(this).data("title")
//     });
//     header("location:amovie_details");
//     // location.replace('index.php?page=amovie_details.php?title=' + $(this).attr('data-title'))
// })

$('#movie-carousel-field .list-next').click(function() {
    $('#movie-carousel-field .list').animate({
        scrollLeft: $('#movie-carousel-field .list').scrollLeft() + ($(
                '#movie-carousel-field .list')
            .find('img').width() * 3)
    }, 'slow');
})

$('#movie-carousel-field .list-prev').click(function() {
    $('#movie-carousel-field .list').animate({
        scrollLeft: $('#movie-carousel-field .list').scrollLeft() - ($(
                '#movie-carousel-field .list')
            .find('img').width() * 3)
    }, 'slow');
})
</script>