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
  if (mysqli_fetch_array($result)) {
    setcookie("LoggedIn", "true", time() + 7200, "/");
    header("Location:index.php?page=loggedin");
  } else {
    header("Location:index.php?page=login");
    echo '"invalid account data"';
  }
  // setcookie("LoggedIn", "", time() - 7200, "/");
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
  $usercheck = ("SELECT * FROM users WHERE `username`='{$username}'");
  $result = mysqli_query($conn, $usercheck) or die("Query unsuccessful");
  $emailcheck = ("SELECT * FROM users WHERE `email`='{$email}'");
  $result2 = mysqli_query($conn, $emailcheck) or die("Query unsuccessful");

  if (mysqli_fetch_array($result)) {
    header("Location:index.php?page=login");
    echo '"username exists"';
  } elseif (mysqli_fetch_array($result2)) {
    header("Location:index.php?page=login");
    echo '<script>alert("Email exists")</script>';
  } else {
    $sql = "INSERT INTO users (`username`, `password`, `email`, `first_name`, `last_name`, `admin`, `request_admin`) VALUES ('$username', '$pass', '$email', '$fname', '$lname', 0, '$request')";
    mysqli_query($conn, $sql);
    setcookie("LoggedIn", "true", time() + 7200, "/");
    header("Location:index.php?page=loggedin");
  }
}
