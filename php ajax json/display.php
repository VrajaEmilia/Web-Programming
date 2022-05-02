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
   if($cat==""){
    $query="SELECT urls.url,urls.description,urls.category FROM urls INNER JOIN users_url ON urls.id = users_url.urlID and users_url.userID='$id'LIMIT $start,$limit";

    $result2=$connection->query("SELECT count(urls.url) as no_url FROM urls INNER JOIN users_url ON urls.id = users_url.urlID and users_url.userID='$id'");
}
else{
    
    $query="SELECT urls.url,urls.description,urls.category FROM urls INNER JOIN users_url ON urls.id = users_url.urlID and users_url.userID='$id' WHERE urls.category='$cat' LIMIT $start,$limit";

    $result2=$connection->query("SELECT count(urls.url) as no_url FROM urls INNER JOIN users_url ON urls.id = users_url.urlID and users_url.userID='$id' WHERE urls.category='$cat'");
}  
    $result=mysqli_query($connection,$query);
    
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
        <button class='btn btn-dark' onclick='getDetails(`$url`)'>
          <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
          <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
      </svg>
        </button>
        <button class='btn btn-danger' onclick='deleteUrl(`$url`)'>
          <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
          <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z'/>
          </svg>
        </button>
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

