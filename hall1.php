<?php
include 'admin/db_connect.php';

$Userseats = array();
//allowing a logged user to edit his reserved seats if any
if (isset($_COOKIE["user"])) {
  $username = $_COOKIE["user"];
  //$res=$conn->query("select chair_id from `reservations`,movies where room_id = 1 && user_name='$username' && movie_id=".$_GET['id']);
  $obj = new DateTime("now");
  $time = $obj->format("h:i:s");
  $res = $conn->query("select chair_id , show_times.start_time,show_times.show_date from `reservations`,`movies` ,`show_times` where reservations.room_id = 1 && user_name= '$username' && reservations.movie_id = movies.id && reservations.movie_id = show_times.movie_id && reservations.movie_id= " . $_GET['id']);
  while ($res && $row = $res->fetch_array()) {

    if ($row[2] == date("Y-m-d")) {
      $start_time = $row[1];
      $diff = abs(strtotime($start_time) - strtotime($time));
      $hours = floor($diff / 3600);
      echo $hours;
      if ($hours > 3)
        array_push($Userseats, $row[0]);
    }else{
      array_push($Userseats, $row[0]);
    }
  }
}

//querying the reserved seats for a specific movie
$res = $conn->query("select chair_id from reservations where room_id = 1 && movie_id=" . $_GET['id']);
$seats = array();
while ($res && $row = $res->fetch_array()) {
  array_push($seats, $row[0]);
}

//getting the movie poster image
$mov = $conn->query("SELECT * FROM movies where id =" . $_GET['id'])->fetch_assoc();
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
  <img style="padding:50px" src="assets/img/<?php echo $mov['poster_image'] ?>" alt="" height=250px>
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
      if (in_array($id, $Userseats)) {
        echo "<div class='seat selected own' id=$id></div>";
      } elseif (in_array($id, $seats)) {
        echo "<div class='seat occupied' id=$id></div>";
      } else {
        echo "<div class='seat ' id=$id></div>";
      }
    }
    echo "</div>";
  }
  ?>
</div>

<?php
  if(!isset($_COOKIE["manager"]))
  {
    echo '<p class="text" style="text-align: center;">You have selected <span id="count">0</span> seats<br></p>';
  }
?>

<form action="" method="post" id="res">
    <input type="text" id="hall" name="hall" hidden value="1">
    <input type="text" id="movie" name="movie" hidden value="<?php echo $_GET['id'] ?>">


    <?php
      if(!isset($_COOKIE["manager"]))
      {
        echo '<button class="btn btn-lg btn-success" id="reserve">Reserve</button>';
      }
    ?>


    <?php if (!empty($Userseats)) {
        echo '<button class="btn btn-lg btn-danger" id="cancel">Cancel</button>';
      }
    ?>

</form>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/hall.js"></script>