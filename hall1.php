<?php

include 'admin/db_connect.php';

//TODO 
/*
Query reserved Seats from the DB
add occupied class to reserved seats on creation of seats
*/

$mov = $conn->query("SELECT * FROM movies where id =".$_GET['id'])->fetch_array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Hall 1</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/hall.css">
</head>

  <div>
    <img style="padding:50px" src="assets/img/<?php echo $mov['cover_img'] ?>" alt="" height = 250px>
  </div>

  <ul class="showcase">
    <li>
      <div class="seat"></div>
      <small>Available</small>
    </li>
    <li>
      <div class="seat selected"></div>
      <small>Selected</small>
    </li>
    <li>
      <div class="seat occupied"></div>
      <small>Occupied</small>
    </li>
  </ul>

  <!--Hall Graphical Display Generation-->
  <div class="container-hall">

    <div class="screen"></div>
    <?php
    $row = 5;
    $col = 6;
    $id  = 0;
    for ($i = 0; $i < $row; $i++) {
      echo "<div class='row'>";
      for ($j = 0; $j < $col; $j++) {
        $id++;
        echo "<div class='seat' id=$id></div>";
      }
      echo "</div>";
    }
    ?>
  </div>

  <p class="text">
    You have selected <span id="count">0</span> seats
  </p>

  <div class="reserve">
    <form action="" method="post">
      <button class="btn btn-lg btn-success">
        Reserve
      </button>
    </form>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/hall.js"></script>
