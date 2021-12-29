<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  signup();
} else {
  signin();
}

include 'admin/db_connect.php';
$username = $_GET["username"];
$sql = ("SELECT username FROM users WHERE username='{$username}'");
$result = mysqli_query($conn, $sql) or die("Query unsuccessful");

// if (mysqli_num_rows($result) > 0) {

function signin()
{
  global $result;
  if ($result) {
    // setcookie("LoggedIn", "true", time() + 7200, "/");
    include("home.php");
  } else
    // setcookie("LoggedIn", "", time() - 7200, "/");
    header("Location:login.html");
  return;
}
function signup()
{
  $fname = $_POST["firstName"];
  $lname = $_POST["lastName"];
  $email = $_POST["email"];
  $pass = $_POST["pass_us"];
}
