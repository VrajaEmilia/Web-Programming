<?php
    include 'connection.php';
   
    if(isset($_POST['displaySend'])){
      $limit = 4;
      $page=intval($_POST['page']);
      $start=($page-1)*$limit;
        $table='<table class="table">
        <thead>
          <tr>
            <th scope="col">url</th>
            <th scope="col">description</th>
            <th scope="col">category</th>
            <th scope="col">action</th>
          </tr>
        </thead>';
    session_start();
    $username = $_SESSION['username'];
    $id = $connection->query("SELECT id FROM users WHERE username='$username'");
    $id = $id->fetch_array();
    $id = intval($id[0]);
    $cat=$_POST['cat'];
   // $query="SELECT urls.url,urls.description,urls.category FROM urls INNER JOIN users_url ON urls.id = users_url.urlID and users_url.userID='$id' LIMIT $start,$limit";
   if($cat==""){
    $query="SELECT urls.url,urls.description,urls.category FROM urls INNER JOIN users_url ON urls.id = users_url.urlID and users_url.userID='$id'LIMIT $start,$limit";

    $result2=$connection->query("SELECT count(urls.url) as no_url FROM urls INNER JOIN users_url ON urls.id = users_url.urlID and users_url.userID='$id'");
}
else{
    
    $query="SELECT urls.url,urls.description,urls.category FROM urls INNER JOIN users_url ON urls.id = users_url.urlID and users_url.userID='$id' WHERE urls.category='$cat' LIMIT $start,$limit";

    $result2=$connection->query("SELECT count(urls.url) as no_url FROM urls INNER JOIN users_url ON urls.id = users_url.urlID and users_url.userID='$id' WHERE urls.category='$cat'");
}  
    $result=mysqli_query($connection,$query);
    //$result2=$connection->query("SELECT count(urls.url) as no_url FROM urls INNER JOIN users_url ON urls.id = users_url.urlID and users_url.userID='$id'");
    
    $pages=ceil(($result2->fetch_all(MYSQLI_ASSOC))[0]['no_url'] / $limit);
    while($row=mysqli_fetch_assoc($result)){
        $url=$row['url'];
        $description=$row['description'];
        $category=$row['category'];
        $table.="<tr>
        <td><a href=$url>$url</a></td>
        <td>$description</td>
        <td class='category'>$category</td>
        </td>
        <td>
        <button class='btn btn-dark' onclick='getDetails(`$url`)'>Edit</button>
        <button class='btn btn-danger' onclick='deleteUrl(`$url`)'>Delete</button>
        </td>
      </tr>";
    }
    $table.='</table>';
    $table.='<nav aria-label="Page navigation example">
    <ul class="pagination">';
    for($i=1;$i<=$pages;$i++){
    $table.="<li class='page-item'><a class='page-link' href='http://localhost/lab7/main.php?page=$i&category=$cat'>$i</a></li>";
  
    }
    $table.='</ul>';

    echo $table;
   
  }
?>

