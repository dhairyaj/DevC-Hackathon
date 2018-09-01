<?php

    $link = mysqli_connect("localhost","root","123456","storelot");
    if(isset($_GET['email']) && !empty($_GET['email'])) {
        $query = "UPDATE `users` SET status=1 WHERE email ='".mysqli_real_escape_string($link, $_GET['email'])."'";
        mysqli_query($link, $query);
        echo "<script> alert('Email address verified.'); </script>";
        echo "<script> location.href='index.php' </script>";
    }

?>