<html>

<head>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/addmovie.css" />
    <style>
    .editmovie {
        margin-left: 36.5%;
        height: 80%;
    }
    </style>
</head>

<header class="masthead">

    <body id="page-top">
        <div class="edit_movie">
            <center>
                <h3 class="text-primary">Edit</h3>
            </center>
            <div class="editmovie">
                <form action="add_movie.php" method="GET" id="editmovie" onsubmit="return verify_modification()">
                    <div class="form_container" style="margin: 5%">
                        <p class="heading" style="opacity: 0;">ADD A MOVIE</p>

                        <div class="input_div">
                            <input type="text" class="hidden input_data" name="id" id="id"
                                value="<?php echo $_GET['id']; ?>" />
                            <input type="text" class="input_data" placeholder="Movie Title" name="title" id="title" />
                            <input type="date" class="input_data" placeholder="Movie Date" name="date" id="date" />
                            <input type="time" class="input_data" placeholder="Start Time" name="startTime"
                                id="startTime" />
                            <input type="time" class="input_data" placeholder="End Time" name="endTime" id="endTime" />
                            <input type="text" class="input_data" placeholder="Screening Room" name="screeningRoom"
                                id="screeningRoom" />
                            <input type="file" class="input_data" placeholder="Poster Image" name="posterImage"
                                id="posterImage" accept="image/*" style="padding-bottom: 35px;" />
                            <br />
                            <br />
                        </div>

                        <button type="submit" form="editmovie" class="btn_add">EDIT</button>
                    </div>
                </form>
            </div>

        </div>
    </body>
</header>

</html>

<script>
$(document).ready(function() {
    $('.hidden').hide();
})
</script>