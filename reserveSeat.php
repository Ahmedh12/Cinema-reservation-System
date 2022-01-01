<?php
//fetching the cookie that contains the reserved seats
$seats = $_COOKIE["reserved"];

//Cookie is sent as a comma separated string , so explode it and store the returned array
$seats =explode(",",$seats,-1);

//Convert the arry of string to integers
$counter = 0;
foreach($seats as $s)
{
    $seats[$counter] = intval($s);
    $counter+=1;
}

print_r($seats);
echo $_COOKIE["hall"];


//TODO
/*
 *Query the database to add the reserved seats
 *  
 */
?>