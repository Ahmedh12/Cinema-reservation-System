<?php
include 'admin/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  signup($conn);
} else {
  signin($conn);
}


function signin($conn)
{
  $username = $_GET["username"];
  $pass = $_GET["pass_us"];
  $Role = $_GET["Role"];
  $sql = ("SELECT * FROM users WHERE `username`='{$username}' AND `password`='{$pass}'");
  $result = mysqli_query($conn, $sql) or die("Query unsuccessful");
  if (mysqli_fetch_array($result)) {
    setcookie("LoggedIn", "true", time() + 7200, "/");
    setcookie("user", "$username", time() + 7200, "/");
    header("Location:index.php?page=loggedin");
  } else {
    header("Location:index.php?page=login");
    echo '"invalid account data"';
  }
  return;
}
function signup($conn)
{
  $fname = $_POST["firstName"];
  $lname = $_POST["lastName"];
  $email = $_POST["Email"];
  $pass = $_POST["pass_us"];
  $role = $_POST["Role"];
  $username = $_POST["username"];
  if ($role == "manager") {
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
  } elseif (mysqli_fetch_array($result2)) {
    header("Location:index.php?page=login");
  } else {
    $sql = "INSERT INTO `users` (`username`, `password`, `email`, `first_name`, `last_name`, `admin`, `request_admin`) VALUES ('$username', '$pass', '$email', '$fname', '$lname', 0, $request)";
    mysqli_query($conn, $sql);
    setcookie("LoggedIn", "true", time() + 7200, "/");
    setcookie("user", "$username", time() + 7200, "/");
    header("Location:index.php?page=loggedin");
  }
}
