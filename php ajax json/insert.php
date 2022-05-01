<?php
    include 'connection.php';
   
    session_start();
    $username = $_SESSION['username'];
    $id = $connection->query("SELECT id FROM users WHERE username='$username'");

    $id = $id->fetch_array();

    $id = intval($id[0]);

    extract($_POST);
    if(isset($_POST['url']) && isset($_POST['description']) && isset($_POST['category']))
    {  
        $query="insert into `urls` (url,description,category) values ('$url','$description','$category');";
        $result = mysqli_query($connection,$query);
        $urlid= $connection->query("select id FROM `urls` WHERE url='$url'");
        $urlid = $urlid->fetch_array();
        $urlid = intval($urlid[0]);
        $query2="insert into `users_url` (urlID,userID) values ('$urlid','$id')";
        $res2 = mysqli_query($connection,$query2);
    }

?>