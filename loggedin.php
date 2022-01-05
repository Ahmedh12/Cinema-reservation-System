 <!-- Masthead-->
 <header class="masthead">

     <body id="page-top">
         <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
             <div class="container">
                 <a class="navbar-brand js-scroll-trigger" href="#page-top">Movie Theater Seat Reservation</a>
                 <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                 <div class="collapse navbar-collapse" id="navbarResponsive">
                     <ul class="navbar-nav ml-auto my-2 my-lg-0">
                         <li class="nav-item"><a class="nav-link " href="#"><?php echo "Welcome " . $_COOKIE["user"]?></a></li>
                         <li class="nav-item"><a class="nav-link " href="index.php?page=signout">sign-out</a></li>
                     </ul>
                 </div>
             </div>
         </nav>
         <div class="container h-100">
             <?php include 'movie_carousel.php' ?>
         </div>
 </header>