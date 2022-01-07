 <!-- Masthead-->
 <header class="masthead">

     <head>
         <link rel="stylesheet" href="css/addmovie.css" />
         <script src="js/addmovie.js"></script>
     </head>

     <body id="page-top">
         <div class="show_movie">
             <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
                 <div class="container">
                     <a class="navbar-brand js-scroll-trigger" href="#page-top">Movie Theater Seat Reservation</a>
                     <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                         data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                         aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                     <div class="collapse navbar-collapse" id="navbarResponsive">
                         <ul class="navbar-nav ml-auto my-2 my-lg-0">
                             <li class="nav-item welcomePage"><a class="nav-link "
                                     href="#"><?php echo "Welcome " . $_COOKIE["user"]?></a></li>
                             <li class="nav-item addingMovie"><a class="nav-link " href="#">add a movie</a></li>
                             <li class="nav-item"><a class="nav-link " href="index.php?page=signout">sign-out</a></li>
                         </ul>
                     </div>
                 </div>
             </nav>
             <div class="container h-100">
                 <?php include 'movie_details.php' ?>
             </div>
         </div>

         <div class="add_movie">
             <form action="add_movie.php" method="POST" id="addmovie" onsubmit="return verify_data()">
                 <div class="form_container">
                     <p class="heading">ADD A MOVIE</p>

                     <div class="input_div">
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

                     <button type="submit" form="addmovie" class="btn_add">ADD</button>
                 </div>
             </form>
         </div>
     </body>
 </header>

 <script>
$(document).ready(function() {
    $('.add_movie').hide();
})

$('.addingMovie').click(function() {
    $('.add_movie').show();
    $('.show_movie').hide();
})

$('.welcomePage').click(function() {
    $('.add_movie').hide();
    $('.show_movie').show();
})
 </script>