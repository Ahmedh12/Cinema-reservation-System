 <!-- Masthead-->
 <header class="masthead">
 <?php
if(isset($_COOKIE["LoggedIn"]))
{
    INCLUDE("home.php");
}
else    
{
    INCLUDE("login.html");
}
?>
 </header>