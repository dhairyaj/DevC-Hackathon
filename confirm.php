<?php

    $link = mysqli_connect("localhost","root","123456","storelot");
    if($_GET['stat']==1) {
        $query = "SELECT * FROM `items` WHERE iid='".mysqli_real_escape_string($link, $_GET['iid'])."' AND `sell` = 1";
        $row = mysqli_fetch_assoc(mysqli_query($link, $query));
    } else if($_GET['stat']==0){
        $query = "SELECT * FROM `items` WHERE iid='".mysqli_real_escape_string($link, $_GET['iid'])."' AND `rent` = 1";
        $row = mysqli_fetch_assoc(mysqli_query($link, $query));
    }
    $to = $_GET['cmail'];
    $subject = "Your proposal has been accepted.";
    $message = '
Dear Customer, 

The owner has confirmed your proposal for the product you showed interest in.

Details of the product:
Item Name: '.$row['iname'].'
Item Type: '.$row['itype'].'
Item Subtype: '.$row['isubtype'].'
Price Quoted: '.$_GET['price'].'

The item will reach as soon as possible. 

This is a system generated mail. Please do not reply. 
    ';
    $headers = 'From:noreply@StorlotStorage.com' . "\r\n"; 
    if(mail($to, $subject, $message, $headers)) {
        echo "<script> alert('Mail sent successfully to customer.'); </script>";
        echo "<script> location.href='index.php' </script>";
        if($_GET['stat']==1) {
            $query = "UPDATE `items` SET status=1 WHERE iid='".mysqli_real_escape_string($link, $_GET['iid'])."'";
        } else if($_GET['stat']==0) {
            $query = "UPDATE `items` SET status=1 WHERE iid='".mysqli_real_escape_string($link, $_GET['iid'])."'"; 
        }
        mysqli_query($link, $query);
    }
?>