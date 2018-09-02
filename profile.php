<?php 

    session_start();

    $link = mysqli_connect("localhost","root","123456","storelot");
    $query = "SELECT * FROM `users` WHERE name= '".mysqli_real_escape_string($link, $_SESSION['name'])."' AND mobile='".
    mysqli_real_escape_string($link, $_SESSION['mobile'])."'";
      
    $result = mysqli_query($link, $query);

    $row = mysqli_fetch_array($result);

    if(isset($_POST['logout'])) {
        $_SESSION['name']='';
        header("Location: index.php");
    }

    if(isset($_POST['edit'])) {
        header("Location: edit_profile.php");
    }

    if(isset($_POST['buy'])) {
        if(empty($_SESSION['name'])) {
            echo "<script> alert('Login or signup first'); </script>"; 
        }
        $query = "SELECT * FROM `users` WHERE name ='".mysqli_real_escape_string($link, $_SESSION['name'])."' AND mobile = '".
        mysqli_real_escape_string($link, $_SESSION['mobile'])."'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        if($row['idno']=='') {
            echo "<script> alert('Go to profile and verify your identification first.'); </script>";
        } else {
            header("Location: buy_page.php");
        }  
    }

    if(isset($_POST['rent'])) {
        if(empty($_SESSION['name'])) {
            echo "<script> alert('Login or signup first'); </script>"; 
        }
        $query = "SELECT * FROM `users` WHERE name ='".mysqli_real_escape_string($link, $_SESSION['name'])."' AND mobile = '".
        mysqli_real_escape_string($link, $_SESSION['mobile'])."'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        if($row['idno']=='') {
            echo "<script> alert('Go to profile and verify your identification first.'); </script>";
        } else {
            header("Location: rent_page.php");
        }
    }

    if($_SESSION['name']!=''){
        $query = "SELECT * FROM `users` WHERE name='".mysqli_real_escape_string($link, $_SESSION['name'])."' AND mobile='".
        mysqli_real_escape_string($link, $_SESSION['mobile'])."'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);
        $status = $row['status'];
        if($status==0) {
            echo "<div style='text-align: center; font-size: 150%; background-color: #ffcccc; font-weight: none;'><span 
            style='color: black;'>Verify Your Email Address</span></div>";
        }
    }

?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>PROFILE</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.css">
    <link rel="stylesheet" href="css/flexslider.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/queries.css">
    <link rel="stylesheet" href="css/etline-font.css">
    <link rel="stylesheet" href="bower_components/animate.css/animate.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">                        

    <!--Sweet Alert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <style type="text/css">

        .user {
            color: black;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
        }

        th {
            font-size: 120%;
        }

        .tdata {
            font-size: 150%;
            text-align: center;
        }

        @media screen and (max-width: 480px) {
            table {
                overflow-x: auto; 
                display: block;
            }
        }

        .edit {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        tr:hover {
            background-color: #DCDCDC;
        }

        th {
            color: #E40046;
        }

        table {
            background-color: #DEECED;
        }

        th {
            background-color: #FFCBF5;
        }
        .nav-but {
            border: none;
            background-color: Transparent;
        } 

        .but-text-nav {
            color: white;
            font-size: 120%; 
            padding-right: 20px;
        } 

    </style>

</head>
<body id="top">
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!--Landing Home-->
    <section class="cont" style="min-height: 200px; background-image: url('img/hero.jpg');">
        <section class="navigation">
            <header>
                <div class="header-content">
                    <div class="logo"><a href="#"><img src="logo.png" height="75px" width="195px" alt="Sedna logo"></a></div>
                    <div class="header-nav">
                        <nav>
                            <form method="post">
                            <ul class="primary-nav">
                                <li><a href="index.php#locker">Locker</a></li>
                                <li><a href="index.php#rent_it_out">Rent It Out</a></li>
                                <li><a href="index.php#sell">Sell</a></li>
                                <li><a href="index.php#give_it_away">Give It Away</a></li>
                                <li><a href="index.php#about">About</a></li>
                                <li><button class="nav-but" name="buy"><span class="but-text-nav">BUY</span></button></li>
                                <li><button class="nav-but" name="rent"><span class="but-text-nav">RENT</span></button></li>
                            </ul>
                            </form>
                            <ul class="member-actions">
                                <form method="post">
                                <li style="color: white; font-weight: bold;"><a href=""><?php if(isset($_SESSION['name'])) {echo "<button name='logout' class='btn-white btn-small'>LOGOUT</button>";} ?></a></li>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <li style="color: white; font-weight: bold;"><a href="profile.php"><?php if(isset($_SESSION['name'])) {echo $_SESSION['name'];} ?></a></li>
                                </form>
                            </ul>
                        </nav>
                    </div>
                    <div class="navicon">
                        <a class="nav-toggle" href="#"><span></span></a>
                    </div>
                </div>
            </header>
        </section>
    </section>
    <!--Landing Home ends here-->

    <!--Detials-->
    <div class="jumbotron" style="margin-bottom: 0;">
        <form method="post">
        <?php 
            if(isset($row)) {
                echo "<p class='user' style='text-align: right;'><button class='edit' name='edit'><i class='fa fa-pencil'></i></button>&nbsp;&nbsp;Edit Profile</p>";
                if($row['idno']=='') {
                    echo "<p>Verify your identification and start using Storelot Storage <i class='fa fa-hand-o-right'></i><a href='verification.php'>
                    VERIFICATION</a></p>";
                }
                echo "<p class='user'><strong>Name</strong>: ".$row['name']."</p>";
                echo "<p class='user'><strong>Location</strong>: ".$row['location']."</p>";
                echo "<p class='user'><strong>Address</strong>: ".$row['address']."</p>";
                echo "<p class='user'><strong>Mobile Number</strong>: ".$row['mobile']."</p>";
                echo "<p class='user'><strong>Email Address</strong>: ".$row['email']."</p>";
                echo "<p class='user'><strong>Identification Number</strong>: ".$row['idno']."</p>";
                echo "<p class='user'><strong>Identification Picture</strong>: ";   
                $query = "SELECT * FROM `users` WHERE id='".$row['id']."'";
                $result = mysqli_query($link, $query);
                $row1=mysqli_fetch_assoc($result);
                echo '<img src="img/id/'.$row['idpic'].'" width="200" height="150" alt="No Image">';
            }
        ?>
        <?php
            $query = "SELECT * FROM `items` WHERE cname='".mysqli_real_escape_string($link, $_SESSION['name'])."' AND id='".
            mysqli_real_escape_string($link, $row['id'])."'";
            $result = mysqli_query($link, $query);
            if(mysqli_num_rows($result)>0) {    
                echo "<hr><p class='user'><strong>Items in locker:</strong></p>";
                echo "<table><thead><tr><th>Item Id</th><th>Item Name</th><th>Item Type</th><th>
                Item Subtype</th><th>Item Image</th></tr></thead><tbody>";
                while($row1 = mysqli_fetch_assoc($result)) {
                    echo "<tr><td class='tdata'>".$row1['iid']."</td><td class='tdata'>".$row1['iname']."</td><td class='tdata'>".$row1['itype']."</td><td class='tdata'>".
                    $row1['isubtype']."</td><td class='tdata'>";
                    echo '<img src="img/items/' . $row1['iimage'] . '" width="150" height="100" alt="No Image">';
                    echo "</td></tr>";
                }
                echo "</tbody></table><br>";
            }
        ?>
        <div id="screenMob" style="font-size: 140%; display: none;"><i class="fa fa-hand-o-right"></i>
        Scroll right to view complete table.<i class="fa fa-hand-o-right"></i></div>
        <?php

            $query = "SELECT * FROM `items` WHERE cname='".mysqli_real_escape_string($link, $_SESSION['name'])."' AND id='".
            mysqli_real_escape_string($link, $row['id'])."' AND `rent` = 1";
            $result = mysqli_query($link, $query);
            if(mysqli_num_rows($result)>0) {    
                echo "<hr><p class='user'><strong>Items on rent:</strong></p>";
                echo "<table><thead><tr><th>Item Name</th><th>Item Type</th><th>
                Item Subtype</th><th>Duration (in months)</th><th>Price (for 1 month)</th><th>Item Image</th></tr></thead><tbody>";
                while($row1 = mysqli_fetch_assoc($result)) {
                    echo "<tr><td class='tdata'>".$row1['iname']."</td><td class='tdata'>".$row1['itype']."</td><td class='tdata'>".$row1['isubtype'].
                    "</td>";
                    echo "<td class='tdata'>".$row1['duration']."</td><td class='tdata'>";
                    echo $row1['price']."</td><td class='tdata'>";
                    echo '<img src="img/items/' . $row1['iimage'] . '" width="150" height="100" alt="No Image">';
                    echo "</td></tr>";
                }
 
                echo "</tbody></table>";
            }

            $query = "SELECT * FROM `items` WHERE cname='".mysqli_real_escape_string($link, $_SESSION['name'])."' AND id='".
            mysqli_real_escape_string($link, $row['id'])."' AND `sell` = 1";
            $result = mysqli_query($link, $query);
            if(mysqli_num_rows($result)>0) {    
                echo "<hr><p class='user'><strong>Items on sale:</strong></p>";
                echo "<table><thead><tr><th>Item Name</th><th>Item Type</th><th>
                Item Subtype</th><th>Price</th><th>Item Image</th></tr></thead><tbody>";
                while($row1 = mysqli_fetch_assoc($result)) {
                    echo "<tr><td class='tdata'>".$row1['iname']."</td><td class='tdata'>".$row1['itype']."</td><td class='tdata'>".$row1['isubtype'].
                    "</td><td class='tdata'>".$row1['price']."</td><td class='tdata'>";
                    echo '<img src="img/items/' . $row1['iimage'] . '" width="150" height="100" alt="No Image">';
                    echo "</td></tr>";
                }
                echo "</tbody></table>";
            }

            $query = "SELECT * FROM `give` WHERE oname='".mysqli_real_escape_string($link, $_SESSION['name'])."' AND id='".
            mysqli_real_escape_string($link, $row['id'])."'";
            $result = mysqli_query($link, $query);
            if(mysqli_num_rows($result)>0) {    
                echo "<hr><p class='user'><strong>Items you gave to charity:</strong></p>";
                echo "<table><thead><tr><th>Item Name</th><th>Item Type</th><th>
                Item Subtype</th><th>Item Image</th><th>Charity Name</th></tr></thead><tbody>";
                while($row1 = mysqli_fetch_assoc($result)) {
                    echo "<tr><td class='tdata'>".$row1['iname']."</td><td class='tdata'>".$row1['itype']."</td><td class='tdata'>".$row1['isubtype'].
                    "</td><td class='tdata'>";
                    echo '<img src="img/items/' . $row1['iimage'] . '" width="150" height="100" alt="No Image">';
                    echo "</td><td class='tdata'>".$row1['charity']."</td></tr>";
                }
                echo "</tbody></table>";
            }

        ?>
        <div id="screenMob1" style="font-size: 140%; display: none;"><i class="fa fa-hand-o-right"></i>
        Scroll right to view complete table.<i class="fa fa-hand-o-right"></i></div>
        </form>
    </div>
    
    <!--Footer-->
    <section class="to-top">
        <div class="container">
            <div class="row">
                <div class="to-top-wrap">
                    <a href="#top" class="top"><i class="fa fa-angle-up"></i></a>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="footer-links">
                        <ul class="footer-group">
                            <li><a href="index.php#locker">Locker</a></li>
                            <li><a href="index.php#rent_it_out">Rent It Out</a></li>
                            <li><a href="index.php#sell">Sell</a></li>
                            <li><a href="index.php#give_it_away">Give It Away</a></li>
                            <li><a href="index.php#about">About</a></li>
                            <li><a href="#">Buy</a></li>
                            <li><a href="rent_page.php">Rent</a></li>
                        </ul>
                        <p>Copyright &copy; 2018 <a href="#">Storelot Storage</a><br>
                        <a href="">Licence</a> | Crafted with <span class="fa fa-heart pulse2"></span> for <a href="https://tympanus.net/codrops/">India</a>.</p>
                    </div>
                </div>
                <div class="social-share">
                    <p>Share Storelot Storage with your friends</p>
                    <a href="#" class="twitter-share"><i class="fa fa-twitter"></i></a> <a href="#" class="facebook-share"><i class="fa fa-facebook"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!--Footer ends here-->

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="bower_components/retina.js/dist/retina.js"></script>
    <script src="js/jquery.fancybox.pack.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.flexslider-min.js"></script>
    <script src="bower_components/classie/classie.js"></script>
    <script src="bower_components/jquery-waypoints/lib/jquery.waypoints.min.js"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>

        //My code
        if($(window).width()<400) {
            $("#screenMob").show();
            $("#screenMob1").show();
        }

        $("#name").click(function(){
            $("#newName").show();
            $("#submitName").show();
        });

        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','UA-XXXXX-X','auto');ga('send','pageview');
    </script>
</body>
</html>
