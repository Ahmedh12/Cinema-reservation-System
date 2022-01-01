<?php
include 'admin/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  signup($conn);
} else {
  signin($conn);
}
//$sql = ("SELECT username FROM users WHERE username='{$username}'");
//$result = mysqli_query($conn, $sql) or die("Query unsuccessful");

// if (mysqli_num_rows($result) > 0) {

function signin($conn)
{
  $username = $_GET["username"];
  //$email = $_GET["email"];
  $pass = $_GET["pass_us"];
  $sql = ("SELECT * FROM users WHERE `username`='{$username}' AND `password`='{$pass}'");
  $result = mysqli_query($conn, $sql) or die("Query unsuccessful");
  if (count($result)) {
    // setcookie("LoggedIn", "true", time() + 7200, "/");
    header("Location:index.php?page=home");
  } else
    // setcookie("LoggedIn", "", time() - 7200, "/");
    header("Location:index.php?page=login");
  return;
}
function signup($conn)
{
  $fname = $_POST["firstName"];
  $lname = $_POST["lastName"];
  $email = $_POST["Email"];
  $pass = $_POST["pass_us"];
  $role = $_POST["AccountType"];
  $username = $_POST["username"];
  if ($role == "Admin") {
    $request = 1;
  } else {
    $request = 0;
  }
  $sql = "INSERT INTO users (`username`, `password`, `email`, `first_name`, `last_name`, `admin`, `request_admin`) VALUES ('$username', '$pass', '$email', '$fname', '$lname', 0, '$request')";
  mysqli_query($conn,$sql);
  header("Location:index.php?page=home");
}
