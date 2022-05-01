<?php
    include 'connection.php';
    if(isset($_POST['url'])){
        $url=$_POST['url'];
        $id = $connection->query("SELECT id FROM urls WHERE url='$url'");
        $id = $id->fetch_array();
        $id = intval($id[0]);
        $response = array();
        $query="Select url,description,category from `urls` where id=$id";
        $result = mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($result)){
            $response = $row;
            
        }
        echo json_encode($response);
    }
    else{
        $response['status']=200;
        $response['message']="not found"; 
    }


    //update
    if(isset($_POST['oldUrl']))
    {
        $oldUrl=$_POST['oldUrl'];
        $id = $connection->query("SELECT id FROM urls WHERE url='$oldUrl'");
        $id = $id->fetch_array();
        $id = intval($id[0]);
        $newUrl=$_POST['newUrl'];
        $newDescription=$_POST['newDescription'];
        $newCategory=$_POST['newCategory'];

        $query = "update urls set url='$newUrl',description='$newDescription'
        , category='$newCategory' where id='$id'";
        $result = mysqli_query($connection,$query);

    }
?>