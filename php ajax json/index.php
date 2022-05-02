<?php
    include 'connection.php';
    if (isset($_POST['login']))
    {
//        $connection = new mysqli('localhost','root','','links');
        $username = $connection->real_escape_string($_POST['user']);
        $password = md5($connection->real_escape_string($_POST['password']));

        $id = $connection->query("SELECT id FROM users WHERE username='$username' AND password='$password'");
        if ($id->num_rows > 0){

           // exit('success');
           session_start();
            $_SESSION['username'] = $username;

            // header(Location: 'main.php');
            // header(Location: 'display.php');
             
        }
        else
            exit('fail');
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./login.css" rel="stylesheet">
    
    <title>login</title>
</head>
<body>
    <div class="main-container">
        <form action="index.php" method="post">
        <label>username:</label>
        <input type="text" id="username"><br><br>
        <label >password:</label>
        <input type="password" id="password"><br><br>
        <input type="button" value="Login" id="login" class="login-button"> 
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
 <script type="text/javascript">
        $(document).ready(function () {
            $("#login").on('click',function(){
                var username = $("#username").val();
                var pass = $("#password").val();

                if(username =="" || password =="")
                    alert('fill in inputs');
                else{
                    $.ajax(
                    {
                        url: 'index.php',
                        method: 'POST',
                        data: {
                            login:1,
                            user: username,
                            password: pass
                        },
                        success: function (response)
                        {
                            console.log(response);
                            if(response === 'fail')
                                alert('WRONG USERNAME OR PASSWORD');
                            else{
                                window.location.href='main.php';
                            }
                        },
                        dataType: 'text'
                    }
                );
                }
             
            });
        });
    </script>
</body>
</html>