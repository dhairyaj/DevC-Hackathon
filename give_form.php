<?php

    session_start();

    $link = mysqli_connect("localhost","root","123456","storelot");

    if(isset($_POST['iid']) AND !empty($_POST['iid']) && $_POST['charity']!=1) {
        $query = "SELECT * FROM `items` WHERE iid = '".mysqli_real_escape_string($link, $_POST['iid'])."'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        if(mysqli_num_rows($result)>0) {
            $query = "INSERT INTO `give`(`iid`, `id`, `oname`, `iname`, `itype`, `isubtype`, `iimage`, `charity`) VALUES('".mysqli_real_escape_string($link, $_POST['iid'])."', '".mysqli_real_escape_string($link, $row['id'])."'
            , '".mysqli_real_escape_string($link, $row['cname'])."', '".mysqli_real_escape_string($link, $row['iname'])."'
            , '".mysqli_real_escape_string($link, $row['itype'])."', '".mysqli_real_escape_string($link, $row['isubtype'])."'
            , '".mysqli_real_escape_string($link, $row['iimage'])."', '".mysqli_real_escape_string($link, $_POST['charity'])."')";
            if(mysqli_query($link, $query)) {
                echo "<script> alert('Item will be sent to the chosen charity.'); </script>";
            }
        } else {
            echo "<script> alert('This item id belongs to someone else.'); </script>";
        }
    }

    if(isset($_POST['logout'])) {
        $_SESSION['name']='';
        header("Location: index.php");
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
    <title>GIVE AWAY FORM</title>
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
                    <div class="logo"><a href="index.php"><img src="img/sedna-logo.png" alt="Sedna logo"></a></div>
                    <div class="header-nav">
                        <nav>
                            <ul class="primary-nav">
                                <<li><a href="index.php#locker">Locker</a></li>
                                <li><a href="index.php#rent_it_out">Rent It Out</a></li>
                                <li><a href="index.php#sell">Sell</a></li>
                                <li><a href="index.php#give_it_away"><span class="active">Give It Away</span></a></li>
                                <li><a href="index.php#about">About</a></li>
                                <li><a href="buy_page.php">Buy</a></li>
                                <li><a href="rent_page.php">Rent</a></li>
                            </ul>
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
    </section>
    <!--Landing Home ends here-->

    <!--Form-->
    <div class="jumbotron" style="padding-left: 100px; margin-bottom: 0;">
        <iframe name="myiframe" style="display: none;"></iframe>
        <form method="post" target="myiframe">
            <h2>Item Id <span class="required">*</span></h2>
             <?php
                $query = "SELECT * FROM `users` WHERE name='".mysqli_real_escape_string($link, $_SESSION['name'])."'
                 AND mobile='".mysqli_real_escape_string($link, $_SESSION['mobile'])."'";
                $row = mysqli_fetch_array(mysqli_query($link, $query));
                $id = $row['id'];
                $query1 = "SELECT * FROM `items` WHERE id='".$id."' AND `rent` = 0 AND `sell` = 0";
                $result = mysqli_query($link, $query1);
                echo '<input list="browsers" class="form_input" autocomplete=off name="iid" placeholder="Enter item id or name" id="i_id">';
                echo '<datalist id="browsers">';
                while($row1 = mysqli_fetch_array($result)) {
                    echo "<option value='".mysqli_real_escape_string($link, $row1['iid'])."'>'".mysqli_real_escape_string($link, $row1['iname'])."'</option>";
                }
                echo '</datalist>';
            ?>
            <br><br>
            <div id="charity_name">
                <br>
                <h2>Charity Name <span class="required">*</span></h2>
                <select class="form_input" id="i_charity" autocomplete=off name='charity'>
                    <option value="1">Select A Value</option>
                    <option value="Some Random Charity">Some Random Charity</option>
                    <option value="Some Random Charity1">Some Random Charity1</option>
                    <option value="Some Random Charity2">Some Random Charity2</option>
                </select>
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary submit" id="Submit">Submit</button>
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
                            <li><a href="buy_page.php">Buy</a></li>
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

        $(".alert").hide();
        $("#Submit").click(function(){

            var value_id = $("#i_id").val();
            var value_charity = $("#i_charity").val();
            var id=0;
            var charity=0;
            var error="";
            if(value_id.length!=5 && value_id.length>0)
            {
                error+="\nEnter a valid id number.";
                $("#i_id").css("background-color","#ffcccc");
                $("#i_id").css("border-color","#ff8080");
                id=1;
            }
            if(value_id=="")
            {
                error+="\nEnter the id of item.";
                $("#i_id").css("background-color","#ffcccc");
                $("#i_id").css("border-color","#ff8080");
                id=1;
            }    
            if(value_charity==1)
            {
                error+="\nEnter the name of charity.";
                $("#i_charity").css("background-color","#ffcccc");
                $("#i_charity").css("border-color","#ff8080");
                charity=1;
            }  
            if(id==0)
            {
                $("#i_id").css("background-color","white");
                $("#i_id").css("border-color","cornflowerblue");
            }    
            if(charity==0)
            {
                $("#i_charity").css("background-color","white");
                $("#i_charity").css("border-color","cornflowerblue");
            }   
            if(error!="")
            {
                sweetAlert("Oops...",error, "error");
                $(error).css("color","red");
                $("body").scrollTop(0);
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
