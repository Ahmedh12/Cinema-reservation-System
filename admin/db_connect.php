<?php
include 'database/initialize_db.php';

$conn= new mysqli('localhost','root','mira2000','theater_db')or die("Could not connect to mysql".mysqli_error($conn));