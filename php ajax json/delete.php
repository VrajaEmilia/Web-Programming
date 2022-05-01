<?php
    include 'connection.php';

if(isset($_POST['url_'])){
    $url=$_POST['url_'];
    $id = $connection->query("SELECT id FROM urls WHERE url='$url'");
    $id = $id->fetch_array();
    $id = intval($id[0]);
    echo $id;
    $query="delete from urls where id='$id'";
    $result=mysqli_query($connection,$query);
}
?>
