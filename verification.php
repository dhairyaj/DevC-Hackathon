<?php

    session_start();

    $link = mysqli_connect("localhost","root","123456","storelot");

    if(isset($_POST['logout'])) {
        $_SESSION['name']='';
        header("Location: index.php");
    }

    if($_SESSION['name']!=''){
        $query = "SELECT * FROM `users` WHERE name='".mysqli_real_escape_string($link, $_SESSION['name'])."' AND mobile='".
        mysqli_real_escape_string($link, $_SESSION['mobile'])."'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);
        $status = $row['status'];
        /*if($status==0) {
            echo "<div style='text-align: center; font-size: 150%; background-color: #ffcccc; font-weight: none;'><span 
            style='color: black;'>Verify Your Email Address</span></div>";
        }
        if(isset($_POST['locker']) AND $row['status']==0) {
            echo "<script> alert('Verify your email first.'); </script>";
        }*/
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

    if(isset($_POST['submit'])) {
        if($_POST['idno'] != "" && $_FILES['image']['name'] != '') {
            $errors= "";
            $file_name = $_FILES['image']['name'];
            $file_size =$_FILES['image']['size'];
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            $extensions= array("jpeg","jpg","png");

            if(in_array($file_ext,$extensions)=== false){
                $errors .= "Extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2000000){
                $errors .= 'File size must be less than or equal to 2 MB';
            }

            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"img/id/".$file_name);
            }else{
                echo "<script> alert('$errors'); </script>";
            }
            $query = "UPDATE `users` SET `idno` = '".mysqli_real_escape_string($link, $_POST['idno'])."', `idpic` = '".mysqli_real_escape_string($link, $file_name)."' WHERE `mobile` = '".mysqli_real_escape_string($link, $_SESSION['mobile'])."'";
            if(mysqli_query($link, $query)) {
                echo "<script> alert('Data updated successfully!'); </script>";
            }
        } else {
            echo "<script> alert('Complete the form!'); </script>";
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
    <title>VERIFICATION</title>
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

    <!--Form-->
    <div class="jumbotron" style="padding-left: 100px; margin-bottom: 0;">

        <form method="post" enctype="multipart/form-data">
            <h2>Aadhaar Number/Passport Number <span class="required">*</span></h2>
            <input name='idno' type="text" autocomplete=off onkeypress='return validateQty(event);' class="form_input" id="v_no" placeholder="Enter Aadhar/Passpor No.">
            <br><br>
            <h2>Upload picture of proof <span class="required">*</span></h2>
            <br>    
            <h5>Acceptable Size: Upto 2MB</h5>
            <input type="file" name="image" class="form_input_file" id="i_image" accept="image/*" autocomplete=off required>
            <br><br>
            <button name='submit' class="btn btn-primary submit" id="Submit">Submit</button>
            <br><br>
            <h3>Don&#39;t want to give details now --> <a href="index.php">Skip</a></h3>
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
                            <li><a href="buy_page.html">Buy</a></li>
                            <li><a href="rent_page.html">Rent</a></li>
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

        $("#Submit").click(function(){
            var value_number=$("#v_no").val();
            var value_image = $("#i_image").val();
            var number=0;
            var error="";
            if(value_number=="")
            {
                error+="\nEnter Aadhar/Passport No.";
                number=1;
                $("#v_no").css("background-color","#ffcccc");
                $("#v_no").css("border-color","#ff8080");
            }
            if(value_image=="")
                error+="\nUpload an image.";      
            if(number==0)
            {
                $("#v_no").css("background-color","white");
                $("#v_no").css("border-color","cornflowerblue");
            }
            if(error!="")
            {
                sweetAlert("Oops...",error, "error");
                $(error).css("color","red");
                $("body").scrollTop(0);
            }    
            else
            {
                var timer = setTimeout(function() {
                    window.location="index.php";
                }, 3000);
            }   
            error="";
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
