 <!-- Masthead-->
 <?php
 
include 'admin/db_connect.php';
$username=$_GET["username"];
$sql = ("SELECT username FROM users WHERE username='{$username}'");
$result = mysqli_query($conn, $sql) or die("Query unsuccessful");

function signin() 
{
    global $result;
      if (mysqli_num_rows($result) > 0) {
        setcookie("LoggedIn","true",time()+7200,"/");
        INCLUDE("home.php");
    }
    else
    setcookie("LoggedIn","",time()-7200,"/");
    INCLUDE("signIn.html");

}
    
?>
  
