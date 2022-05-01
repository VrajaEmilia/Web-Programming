<?php
 $connection = new mysqli('localhost','root','','links');
 if(!$connection){
     die(mysqli_error($connection));
 }
?>