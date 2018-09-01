<?php

    session_start();

    $link = mysqli_connect("localhost","root","123456","storelot");

    //This will delete rent and sell items after 30 days. Don't uncomment it till it goes online.
    $curTime = time();
    $curTime = date('Y-m-d',$curTime);
    $query = "SELECT * FROM `items` WHERE `rent` = 1";
    $result = mysqli_query($link, $query);
   // while($row = mysqli_fetch_assoc($result)) {
       // $date = $row['puttime'];
        //$put = strtotime("+30 day",strtotime($date));
       // if(date('Y-m-d',$put) == $curTime) {
        //    $id = $row['id'];
         //   $query = "DELETE FROM `rent` WHERE id = $id";
         //   mysqli_query($link, $query);
       // }
   // }
    $query1 = "SELECT * FROM `items` WHERE `sell` = 1";
    $result1 = mysqli_query($link, $query1) or die(mysqli_error($link));
   // while($row1 = mysqli_fetch_assoc($result1)) {
        //$date1 = $row1['puttime'];
        //$put1 = strtotime("+30 day",strtotime($date1));
       // if(date('Y-m-d',$put1) == $curTime) {
         //   $id1 = $row1['id'];
         //   $query = "DELETE FROM `sale` WHERE id = $id1";
         //   mysqli_query($link, $query);
       // }
    //}

    //Sign Up

   if(isset($_POST['signup']) && $_POST['signName'] != "" && $_POST['signLocation'] != "" && $_POST['signAddress'] != "" && $_POST['signMobile'] != "" && $_POST['signEmail'] != "" && $_POST['signPassword'] != "" && $_POST['signCpassword'] != "" && $_POST['terms'] == "check") {

       $query = "SELECT `id` FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['signEmail'])."'";

        $query1 = "SELECT `id` FROM `users` WHERE mobile = '".mysqli_real_escape_string($link, $_POST['signMobile'])."'";

        $error = "";
        if(mysqli_num_rows(mysqli_query($link, $query))>0) {
            $error.= "The email address is already linked to another account.";
        } 
        if(mysqli_num_rows(mysqli_query($link, $query1))>0) {
            $error.= "The mobile number is already taken.";
        } 
        if(!filter_var($_POST['signEmail'], FILTER_VALIDATE_EMAIL)) {
            $error.= "The email address is invalid.";
        } 
        if($_POST['signPassword']!=$_POST['signCpassword']) {
            $error.= "The passwords do not match.";
        } 
        if($error != "") {
            echo "<script> alert('$error'); </script>";  
        } else {
            $query = "INSERT INTO `users`(`name`, `location`, `address`, `mobile`, `email`, `password`) VALUES('".mysqli_real_escape_string($link, $_POST['signName'])."'
            , '".mysqli_real_escape_string($link, $_POST['signLocation'])."', '".mysqli_real_escape_string($link, $_POST['signAddress'])."'
            , '".mysqli_real_escape_string($link, $_POST['signMobile'])."', '".mysqli_real_escape_string($link, $_POST['signEmail'])."'
            , '". mysqli_real_escape_string($link, hash('sha512',$_POST['signPassword']))."')";
            if(mysqli_query($link, $query)) {
                header('refresh:3;url=verification.php');
                echo "<script> alert('Signed up successfully.'); </script>";
                /*$mail = mysqli_real_escape_string($link, $_POST['signEmail']);
                $password = mysqli_real_escape_string($link, $_POST['signPassword']);
                $to = $_POST['signEmail'];
                $subject = "Email Verification";
                $message = '
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

------------------------
Username: '.$mail.'
Password: '.$password.'
------------------------

Please click this link to activate your account:
http://jncpasighat-com.stackstaging.com/vastuKosh/verify.php?email='.$mail.'

This is a system generated mail. Do not reply. 
                ';
                $headers = 'From:noreply@vastukosh.com' . "\r\n"; 
                mail($to, $subject, $message, $headers);
                $_SESSION['name']=$_POST['signName'];
                $_SESSION['mobile']=$_POST['signMobile'];*/
            } else {
                echo "<script> alert('Complete the form.'); </script>";
            }
        } 
    } else if(isset($_POST['signup']) && $_POST['terms'] != "check") {
        echo "<script> alert('Accept terms and conditions'); </script>";
    }
    
    //Login 
    if(array_key_exists('logEmail',$_POST) OR array_key_exists('logPassword', $_POST)) { 
        if($_POST['logEmail']!='' AND $_POST['logPassword']!='') {
            $query = "SELECT `id` FROM `users` WHERE password = '".mysqli_real_escape_string($link, hash('sha512',$_POST['logPassword']))."' AND 
            email = '".mysqli_real_escape_string($link, $_POST['logEmail'])."'";
            if(mysqli_num_rows(mysqli_query($link, $query))>0) {
                echo "<script> alert('Logged in successfully.'); </script>";
                $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['logEmail'])."'";
                $result = mysqli_query($link, $query);
                $row=mysqli_fetch_array($result);
                $name=$row['name'];
                $mobile=$row['mobile'];
                echo "<script> alert('Welcome $name'); </script>";
                echo "<script> location.href = 'index.php'; </script>";
                $_SESSION['name']=$name;
                $_SESSION['mobile']=$mobile;
            } else {
                echo "<script> alert('Wrong Credentials.'); </script>";
            }
        }
    } 

    /*if($_SESSION['name']!=''){
        $query = "SELECT * FROM `users` WHERE name='".mysqli_real_escape_string($link, $_SESSION['name'])."' AND mobile='".
        mysqli_real_escape_string($link, $_SESSION['mobile'])."'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);
        $status = $row['status'];
        if($status==0) {
            echo "<div style='text-align: center; font-size: 150%; background-color: #ffcccc; font-weight: none;'><span 
            style='color: black;'>Verify Your Email Address</span></div>";
        }
        if(isset($_POST['locker']) AND $row['status']==0) {
            echo "<script> alert('Verify your email first.'); </script>";
        }
        if(isset($_POST['rent_it_out']) AND $row['status']==0) {
            echo "<script> alert('Verify your email first.'); </script>"; 
        }
        if(isset($_POST['sell']) AND $row['status']==0) {
            echo "<script> alert('Verify your email first.'); </script>";
        } 
        if(isset($_POST['give']) AND $row['status']==0) {
            echo "<script> alert('Verify your email first.'); </script>";
        } if(isset($_POST['buy']) AND $row['status']==0) {
            echo "<script> alert('Verify your email first.'); </script>";
        } if(isset($_POST['rent']) AND $row['status']==0) {
            echo "<script> alert('Verify your email first.'); </script>";
        }
    }*/

    if(isset($_POST['logout'])) {
        $_SESSION['name']='';
        echo "<script> location.href='index.php' </script>";
    }

    if(isset($_POST['locker'])) {
        if(empty($_SESSION['name'])) {
            echo "<script> alert('Login or signup first'); </script>"; 
            echo "<script> location.href = 'index.php'; </script>";
        } else {
            $query = "SELECT * FROM `users` WHERE name ='".mysqli_real_escape_string($link, $_SESSION['name'])."' AND mobile = '".
            mysqli_real_escape_string($link, $_SESSION['mobile'])."'";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
            if($row['idno']=='') {
                echo "<script> alert('Go to profile and verify your identification first.'); </script>";
            } else {
                header("Location: locker_form.php");
            }
        }
    }

    if(isset($_POST['rent_it_out'])) {
        if(empty($_SESSION['name'])) {
            echo "<script> alert('Login or signup first'); </script>";
            echo "<script> location.href = 'index.php'; </script>";
        } else {
            $query = "SELECT * FROM `users` WHERE name ='".mysqli_real_escape_string($link, $_SESSION['name'])."' AND mobile = '".
            mysqli_real_escape_string($link, $_SESSION['mobile'])."'";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
            if($row['idno']=='') {
                echo "<script> alert('Go to profile and verify your identification first.'); </script>";
            } else {
                header("Location: rent_and_sell_form.php");
            }
        }
    }

    if(isset($_POST['sell'])) {
        if(empty($_SESSION['name'])) {
            echo "<script> alert('Login or signup first'); </script>"; 
            echo "<script> location.href = 'index.php'; </script>";
        } else {
            $query = "SELECT * FROM `users` WHERE name ='".mysqli_real_escape_string($link, $_SESSION['name'])."' AND mobile = '".
            mysqli_real_escape_string($link, $_SESSION['mobile'])."'";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
            if($row['idno']=='') {
                echo "<script> alert('Go to profile and verify your identification first.'); </script>";
            } else {
                header("Location: rent_and_sell_form.php");
            }
        }
    }

    if(isset($_POST['buy'])) {
        if(empty($_SESSION['name'])) {
            echo "<script> alert('Login or signup first'); </script>"; 
            echo "<script> location.href = 'index.php'; </script>";
        } else {
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
    }

    if(isset($_POST['rent'])) {
        if(empty($_SESSION['name'])) {
            echo "<script> alert('Login or signup first'); </script>";
            echo "<script> location.href = 'index.php'; </script>";
        } else {
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
    }

    if(isset($_POST['give'])) {
        if(empty($_SESSION['name'])) {
            echo "<script> alert('Login or signup first'); </script>";
            echo "<script> location.href = 'index.php'; </script>";
        } else {
            $query = "SELECT * FROM `users` WHERE name ='".mysqli_real_escape_string($link, $_SESSION['name'])."' AND mobile = '".
            mysqli_real_escape_string($link, $_SESSION['mobile'])."'";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
            if($row['idno']=='') {
                echo "<script> alert('Go to profile and verify your identification first.'); </script>";
            } else {
                header("Location: give_form.php");
            }
        }
    }

    if(isset($_POST['fpwd'])) {
        if($_POST['myEmail'] != "") {
            $mail = mysqli_real_escape_string($link, $_POST['myEmail']);
            $query = "SELECT `id` FROM `users` WHERE email ='$mail'";
            if(mysqli_num_rows(mysqli_query($link, $query))>0) {
                $to = $mail;
                $subject = "Forgot Password";
                $message = '
Follow this link to reset your password:
http://jncpasighat-com.stackstaging.com/vastuKosh/forgot.php?email='.$mail.'

This is a system generated mail. Please do not reply.
                ';
                $headers = 'From:noreply@vastukosh.com' . "\r\n"; 
                if(mail($to, $subject, $message, $headers)) {
                    echo "<script> alert('Check your mail to reset password.'); </script>";
                    echo "<script> location.href='index.php' </script>";
                }
            }
        }
    }

?>


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>STORLOT STORAGE</title>
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

    <!--Sweet Alert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!--Geolocation-->
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.4.15"></script>

    <!--bttn.css-->
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bttn.css/0.2.4/bttn.css">

    <!--Typewriter JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TypewriterJS/1.0.0/typewriter.min.js"></script>

    <!--Animate Text-->
    <link rel="stylesheet" type="text/css" href="animatetext.css">

    <style type="text/css">
    
    /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                padding-top: 100px; /* Location of the box */
                left: 0;
                top: 0;
                margin-top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.8); /* Black w/ opacity */
            }

            /* Modal Content */
            .modal-content {
                background-color: #fefefe;
                margin: 80px;
                margin-left: auto;
                margin-right: auto;
                padding-left: 20px;
                border: 1px solid #888;
                width: 50%;
            }

            /* The Close Button */
            .close0 {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close0:hover,
            .close0:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }

            .modal_hr {
                border-color: dimgray;
            }

            .sign {
                width: 30%;
            }

            @media only screen and (max-width: 500px) {
                .modal-content {
                    width: 100%;
                }
                .signup-form {
                    width: 50%;
                }
            }

            .forgot {
                border: none;
                background-color: white;
            }

            .nav-but {
                border: none;
                background-color: Transparent;
            } 

            .but-text-nav {
                color: white;
                font-size: 90%; 
                padding-right: 20px;
            }      

            .loc_content {
                text-align: center;
            }

            #forgot {
                background-color: white;
                border: 5px inset #B8B8B8;
            }

            @media screen and (max-width: 480px) {
                .but-text-nav {
                    font-size: 180%;
                    font-weight: bold;
                }
                .loc_content {
                    text-align: left;
                    font-size: 80%;
                }
            }  

    </style>

</head>
<body id="top">
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!--Landing Home-->
    <section class="hero" id="top">
        <section class="navigation">
            <header>
                <div class="header-content">
                    <div class="logo"><a href="#"><img src="img/sedna-logo.png" alt="Sedna logo"></a></div>
                    <div class="header-nav">
                        <nav>
                            <form method="post">
                            <ul class="primary-nav">
                                <li><a href="#locker">Locker</a></li>
                                <li><a href="#rent_it_out">Rent It Out</a></li>
                                <li><a href="#sell">Sell</a></li>
                                <li><a href="#give_it_away">Give It Away</a></li>
                                <li><a href="#about">About</a></li>
                                <li><button class="nav-but" name="buy"><span class="but-text-nav">BUY</span></button></li>
                                <li><button class="nav-but" name="rent"><span class="but-text-nav">RENT</span></button></li>
                            </ul>
                            </form>
                            <ul class="member-actions">
                                <form method="post">
                                <li style="color: white; font-weight: bold;"><a href=""><?php if(isset($_SESSION['name']) && !empty($_SESSION['name'])) {echo "<button name='logout' class='btn-white btn-small'>LOGOUT</button>";} ?></a></li>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <li style="color: white; font-weight: bold;"><a href="profile.php"><?php if(isset($_SESSION['name']) && !empty($_SESSION['name'])) {echo $_SESSION['name'];} ?></a></li>
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
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="hero-content text-center">
                        <h1 id="app"></h1>
                        <span style="color: white; font-size: 150%; font-weight: bold; text-align: center;">SERVICES:&nbsp;</span>
                        <div class="words words-1">
                            <span>LOCKER</span>
                            <span>RENT</span>
                            <span>SELL</span>
                            <span>BUY</span>
                            <span>DONATE</span>
                        </div>
                        <br><br>
                        <p class="intro">A Bank for Items.</p>
                        <?php
                            if(empty($_SESSION['name'])) {
                                echo "<button class='bttn-unite bttn-primary myBtn_multi'><span class='but-text'>LOGIN</span></button>";
                            }
                        ?>
                        <!-- The Modal -->
                        <div class="modal modal_multi">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close close_multi">&times;</span>
                            <hr class="modal_hr">
                            <section class="sign-up">
                                <div class="container">
                                    <div class="row">
                                            <form method="POST" style="padding-left: 30px;" class="signup-form sign">
                                                <div id="log2">
                                                <p>Already a member? Log in.</p>
                                                <div class="form-input-group">
                                                    <i class="fa fa-envelope"></i><input type="text" name="logEmail" id="l_email" placeholder="Enter your email" required>
                                                </div>
                                                <div class="form-input-group">
                                                    <i class="fa fa-lock"></i><input type="password" name="logPassword" id="l_pwd" placeholder="Enter your password" minlength='8' required>
                                                </div>
                                                </div>
                                                <p><button type='button' id='forgot'><span style='color: #D7405D'>Forgot Password</span></button></p><br>
                                                <div id="log1">
                                                <button type="submit" class="btn-fill sign-up-btn" id="login">Log In</button>
                                                </div>
                                             </form>  
                                             <form method="post" style="padding-left: 30px;" class="signup-form sign">
                                                <div id="log" style='display: none;'>
                                                <div class="form-input-group" style="display: none;" id="f_pwd">
                                                    <i class="fa fa-envelope"></i><input type="text" name="myEmail" id="m_email" placeholder="Enter your email address" required>
                                                </div>
                                                <button type="submit" class="btn-fill sign-up-btn" id="fpwd" name='fpwd'>Send Mail</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </section>
                            <hr class="modal_hr"> 
                        </div>
                        </div>
                        <?php
                            if(empty($_SESSION['name'])) {
                                echo "<button class='bttn-unite bttn-primary myBtn_multi'><span class='but-text'>SIGNUP</span></button>";
                            }
                        ?>
                         <!-- The Modal -->
                        <div class="modal modal_multi">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close close_multi">&times;</span>
                            <hr class="modal_hr">
                            <section class="sign-up">
                            <div class="container">
                                <div class="row">
                                    <form method="POST" class="signup-form sign">
                                        <p>New to Storlot Storage? Sign up.</p>
                                        <div class="form-input-group">
                                            <i class="fa fa-user"></i><input type="text" name="signName" id="s_name" placeholder="Enter your name" required>
                                        </div>
                                        <div class="form-input-group">
                                            <input type="text" name="signLocation" id="s_loc" placeholder="Enter your location" required>
                                        </div>
                                        <div class="form-input-group">
                                            <i class="fa fa-map-marker"></i><input type="text" name="signAddress" id="s_add" placeholder="Enter your address" required>
                                        </div>
                                        <div class="form-input-group">
                                            <i class="fa fa-mobile"></i><input type="text" id="s_mob" onkeypress='return validateQty(event);' name="signMobile" placeholder="Enter your mobile number" maxlength='10' required>
                                        </div>  
                                        <div class="form-input-group">
                                            <i class="fa fa-envelope"></i><input type="text" name="signEmail" id="s_email" placeholder="Enter your email" required>
                                        </div>
                                        <div class="form-input-group">
                                            <i class="fa fa-lock"></i><input type="password" name="signPassword" id="s_pwd" placeholder="Enter your password" minlength='8' required>
                                        </div>
                                        <div class="form-input-group">
                                            <i class="fa fa-lock"></i><input type="password" name="signCpassword" id="s_cpwd" placeholder="Confirm your password" minlength='8' required>
                                        </div>
                                        <p><input type="checkbox" id="s_terms" name="terms" value="check">&nbsp;&nbsp;I have read the <a href="tandc.php">Terms and Conditions</a>.</p>
                                        <button type="submit" name="signup" class="btn-fill sign-up-btn" id="signup">Sign up</button>
                                    </form>
                                </div>
                            </div>
                        </section>
                            <hr class="modal_hr"> 
                        </div>
                        </div>
                        <p style="color: white;font-size: 140%;">We value your valuables... Our locks are the key to your freedom.</p>
                        <p style="color: white;font-size: 140%;"></p>
                        <!--<p style="color: white;font-size: 140%;">Get it on -></p>
                        <a href="#"><img src="img/play_store.png" style="height: 50px;" ></a>
                        <a href="#"><img src="img/app_store.png" style="height: 50px;"></a>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="down-arrow floating-arrow"><a href="#"><i class="fa fa-angle-down"></i></a></div>
    </section>
    <!--Landing Home ends here-->
    
    <!--Location-->
    <!--Commented until demo session
    <section class="intro section-padding">
        <div class="container">
            <h2 style="text-align: center;">Locations</h2>
            <div class='loc_content'><span style='font-size: 150%; font-weight: bold; color: gray;'>WE ARE AVAILIABLE IN:</span> 
            <div class="words words-1">
                <span style='color: #240012;' class='places'>CHENNAI</span>
                <span style='color: #240012;' class='places'>BANGALORE</span>
                <span style='color: #240012;' class='places'>MUMBAI</span>
                <span style='color: #240012;' class='places'>DELHI</span>
                <span style='color: #240012;' class='places'>KOLKATA</span>
            </div></div>
            <br>
        </div>
        <br><br>
    </section>
    -->
    <!--Location ends here-->
    
    <!--Pricing-->
    <section class="features section-padding">
        <div class="container">
            <div class="row">
                <div class="feature-list">
                    <br><br><br> 
                    <h3 style="text-align: center;">PRICING</h3>
                    <div style="text-align: left;">
                        <p style="color: black;"><strong>The pricing (for 1 month) of the items kept in the locker will be based on following factors:</strong></p><br>
                        <p style="color: black;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Area of the item</p>
                        <br>
                        <p style="color: black;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Type of the material</p>
                        <br>
                        <p style="color: black;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Current market value of product</p>
                        <br>
                        <p style="color: black;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Duration of usage</p>
                        <br>
                        <p style="color: black;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Current condition</p><br>
                        <!--<p style="color: black;">Insurance for item: 10% of the rent price.</p>-->
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <!--Pricing ends here-->

    <!--Locker-->
    <section class="features section-padding" id="locker" style="background-image: url('img/locker.jpg'); background-size: 100%; height: 700px;">
        <div class="container">
            <div class="row">
                <div class="feature-list">
                    <br><br><br><br><br>    
                    <h3 style="text-align: center; color: #FFFFBA;">LOCKER</h3>
                    <div style="text-align: left;">
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Hassle Free Locker Service</p>
                        <br>
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Vastu Kosh lockers will be located at locations near you.</p>
                        <br>
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;If you want anything to put in your locker Vastu Pickers will pick them up from your door step.</p>
                        <br>
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Your things will be delivered to your doorstep whenever you want them.</p>
                        <br>
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;High Security in the lockers ensure you feel safe while handing over your precious belongings to us.</p>
                    <br><br><br>
                    <div style="text-align: center;">
                    <form method="post">
                        <button class="bttn-pill bttn-md" name='locker'>LOCKER</button>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <!--Locker ends here-->


    <!--Rent It Out-->
    <section class="features section-padding" id="rent_it_out" style="background-image: url('img/rent.jpg'); background-size: 100%; height: 700px;">
        <div class="container">
            <div class="row">
                <div class="feature-list">
                    <br><br><br>
                    <h3 style="text-align: center; color: #FFFFBA;">RENT IT OUT</h3><br><br>
                    <div style="text-align: left;">
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Want to utilize your products and earn some money?</p>
                        <br>
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;We offer you rent facility on monthly basis.</p>
                        <br>
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Direct delivery to the person from our lockers will ensure you do not have to waste your time.</p>
                        <br>
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Contact the person directly through the website or app and make sure you give your things to the right person.</p>
                        <br>
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Vastu Kosh will make sure you get your monthly rent on time everytime.</p>
                    </div>
                    <br><br><br>
                    <div style="text-align: center;">
                    <form method="post">
                        <button class="bttn-pill bttn-md" name='rent_it_out'>RENT</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--Rent It Out ends here-->


    <!--Sell-->
    <section class="features section-padding" id="sell" style="background-image: url('img/sell.jpg'); background-size: 100%; height: 700px;">
        <div class="container">
            <div class="row">
                <div class="feature-list">
                    <br><br><br>
                    <h3 style="text-align: center; color: #FFFFBA;">SELL</h3><br><br>
                    <div style="text-align: left;">
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Want to discard something?</p>
                        <br>
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Forget all the bothering and leave it all to us.</p>
                        <br>
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Contact the buyer you would like to sell your product to and it will be delivered to that person from our lockers.</p>
                        <br>
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;We ensure complete payment by the buyer.</p>
                        <br>
                        <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;We will find you a list of buyers around you so that you don&#39;t have to bear the burden.</p>
                    </div>
                    <br><br><br>
                    <div style="text-align: center;">
                    <form method="post">
                        <button class="bttn-pill bttn-md" name='sell'>SELL</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--Sell ends here-->

    <!--Give It Away-->
    <section class="features section-padding" id="give_it_away" style="background-image: url('img/give.jpg'); background-size: 100%; height: 700px;">
        <div class="container">
            <div class="row">
                    <div class="feature-list">
                        <br><br><br>
                        <h3 style="text-align: center; color: #FFFFBA;">GIVE IT AWAY</h3><br><br>
                        <div style="text-align: left;">
                            <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Want to help children in orphanages or old people in old age homes?</p>
                            <br>
                            <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Want to make good use of your items?</p>
                            <br>
                            <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;We have contacts with orphanages and old age homes. If you feel like helping some people we will help you fulfil your goal</p>
                            <br>
                            <p style="color: #FFFFBA;"><i class="fa fa-hand-o-right" style="font-size: 20px;"></i>&nbsp;Direct delivery from lockers to the institution you choose from our list.</p>
                        </div>
                        <br><br><br>
                        <div style="text-align: center;">
                            <form method="post">
                                <button class="bttn-pill bttn-md" name='give'>GIVE</button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!--Give It Away ends here-->

    <!--About-->
    <section class="features-extra section-padding" id="about" style="background-color: #E1E1E1;">
        <div class="container">
            <div class="row">
                <div>
                    <div class="feature-list">
                        <br><br><br>
                        <h3 style="text-align: center;">ABOUT</h3><br><br>
                        <p style="text-align: justify;">It is a platform made by students of SRM University, Chennai. It aims to solve the issue of people residing in flats generally face.
                            Flats are often too small to accomodate our belongings and some things may be close to our heart, our sentiments are attached to them.
                            It aches our heart to just discard them away.</p>
                        <p style="text-align: justify;">So, presenting an idea that would increase the space in your home for new items and preserve the items you love in safe and secure lockers.
                            Vastu Kosh provides the customers with four options: Storing items in secure lockers, Giving your items to orphanages or old age homes,
                            Sell your items and Rent them for some time.</p>
                        <p style="text-align: justify;">We ensure delivery and pick up so that you don&#39;t have to travel to keep your products safe.</p>
                        <p style="text-align: justify;">With our highly specific databases you can find out which products you have trusted us with.</p>  
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--About-->

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
                            <li><a href="#locker">Locker</a></li>
                            <li><a href="#rent_it_out">Rent It Out</a></li>
                            <li><a href="#sell">Sell</a></li>
                            <li><a href="#give_it_away">Give It Away</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="buy_page.php">Buy</a></li>
                            <li><a href="rent_page.php">Rent</a></li>
                        </ul>
                        <p>Copyright &copy; 2018 <a href="#">Storlot Storage</a><br>
                        <a href="">Licence</a> | Crafted with <span class="fa fa-heart pulse2"></span> for <a href="https://tympanus.net/codrops/">India</a>.</p>
                    </div>
                </div>
                <div class="social-share">
                    <p>Share Storlot Storage with your friends</p>
                    <a href="#" class="twitter-share"><i class="fa fa-twitter"></i></a> <a href="#" class="facebook-share"><i class="fa fa-facebook"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!--Footer ends here-->

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
        
        $("#forgot").click(function() {
            $("#f_pwd").css("display","block");
            $("#log").css("display","block");
            $("#log1").css("display","none");
            $("#log2").css("display","none");
        });

        var app = document.getElementById('app');

        var typewriter = new Typewriter(app, {
            loop: true,
            typingSpeed: 250
        });

        typewriter.typeString('STORLOT STORAGE')
            .pauseFor(4000)
            .deleteAll()
            .typeString('YOUR TRUST, OUR OATH')
            .pauseFor(4000)
            .deleteChars(7)
            .start();

        //Get Number only
        function validateQty(event) {
            var key = window.event ? event.keyCode : event.which;

        if (event.keyCode == 8 || event.keyCode == 46
        || event.keyCode == 37 || event.keyCode == 39) {
            return true;
        }
        else if ( key < 48 || key > 57 ) {
            return false;
        }
        else return true;
        };

        //Modal

        // Get the modal
        var modalparent = document.getElementsByClassName("modal_multi");

        // Get the button that opens the modal
        var modal_btn_multi = document.getElementsByClassName("myBtn_multi");

        // Get the <span> element that closes the modal
        var span_close_multi = document.getElementsByClassName("close_multi");

        // When the user clicks the button, open the modal
        function setDataIndex() {
            for (i = 0; i < modal_btn_multi.length; i++)
            {
                modal_btn_multi[i].setAttribute('data-index', i);
                modalparent[i].setAttribute('data-index', i);
                span_close_multi[i].setAttribute('data-index', i);
            }
        }

        for (i = 0; i < modal_btn_multi.length; i++)
        {
            modal_btn_multi[i].onclick = function() {
                var ElementIndex = this.getAttribute('data-index');
                modalparent[ElementIndex].style.display = "block";
            };

            // When the user clicks on <span> (x), close the modal
            span_close_multi[i].onclick = function() {
                var ElementIndex = this.getAttribute('data-index');
                modalparent[ElementIndex].style.display = "none";
            };

        }

        window.onload = function() {

            setDataIndex();
        };

        window.onclick = function(event) {
            if (event.target === modalparent[event.target.getAttribute('data-index')]) {
                modalparent[event.target.getAttribute('data-index')].style.display = "none";
            }
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };

        //My Code

        var placesAutocomplete = places({
            container: document.querySelector('#s_loc'),
            countries: ['in']
        });

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

    
    $("#login").click(function(){   
        var email=$("#l_email").val();
        var password=$("#l_pwd").val();
        var error="";
        if(isEmail(email)==false && email!="")
            error+="<br>Your email is invalid";
        if(email=="")
            error+="<br>Enter email address";
        if(document.getElementById("l_pwd").value=="")
            error+="<br>Enter password";
        if(error!="")
        {
            $("#error").css("display","block");
            $("#error").html(error);
        } 
    });

    $("#signup").click(function(){   
        var name=$("#s_name").val();
        var location=$("#s_loc").val();
        var address=$("#s_add").val();
        var email=$("#s_email").val();
        var password=$("#s_pwd").val();
        var conf_password=$("#s_cpwd").val();
        var mobile=$("#s_mob").val();
        var error="";
        var p_flag=0;
        if(isEmail(email)==false && email!="")
            error+="<br>Your email is invalid";
        if(name=="")
            error+="<br>Enter name";
        if(location=="")
            error+="<br>Enter location";
        if(address=="")
            error+="<br>Enter address";
        if(mobile=="")
            error+="<br>Enter mobile number";
        if(email=="")
            error+="<br>Enter email address";
        if(document.getElementById("s_pwd").value=="")
        {
            error+="<br>Enter password";
            p_flag=1;
        }   
        if(document.getElementById("s_cpwd").value=="")
        {
            error+="<br>Confirm password";
            p_flag=1;
        }    
        if(document.getElementById("s_pwd").value != document.getElementById("s_cpwd").value)
            error+="<br>Passwords do not match";
        if($("#s_terms").prop('checked')==false) 
            error+="<br>You have to agree to terms and conditions";
        if(error!="")
        {
            $("#error").css("display","block");
            $("#error").html(error);
        }
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
