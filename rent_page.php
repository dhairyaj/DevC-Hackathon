<?php

    session_start();
               
    $link = mysqli_connect("localhost","root","123456","storelot");

    if(isset($_POST['logout'])) {
        $_SESSION['name']='';
        header("Location: index.php");
    }

    if(isset($_POST['buy'])) {
        header("Location: buy_page.php");
    }
    if(isset($_POST['interest']) AND isset($_POST['oprice']) AND !empty($_POST['oprice'])) {
        $query = "SELECT * FROM `items` WHERE iid='".mysqli_real_escape_string($link, $_POST['interest'])."'";
        $row = mysqli_fetch_assoc(mysqli_query($link, $query));
        $id = $row['id'];   
        $query1 =  "SELECT `email` FROM `users` WHERE id='".mysqli_real_escape_string($link, $id)."'";
        $row1 = mysqli_fetch_assoc(mysqli_query($link, $query1));
        $email = $row1['email'];
        $query2 = "SELECT * FROM `users` WHERE name='".mysqli_real_escape_string($link, $_SESSION['name'])."' AND mobile='".
        mysqli_real_escape_string($link, $_SESSION['mobile'])."'";
        $row2 = mysqli_fetch_assoc(mysqli_query($link, $query2));
        $cmail = $row2['email'];
        $to = $email;
        $subject = 'Someone has shown interest in your product.';
        $message = '
Dear Customer, 

'.$_SESSION['name'].' has shown interest to rent your product. 

-------------------------------
Product Name: '.$row['iname'].'
Item id: '.$row['iid'].'    
Price Offering (for 1 month): '.$_POST['oprice'].'
Your Price (for 1 month): '.$row['price'].'
Duration (in months): '.$row['duration'].'
-------------------------------

If you want to accept the proposal then click the following link:- 

http://jncpasighat-com.stackstaging.com/StorelotStorage/confirm.php?iid='.$_POST['interest'].'&cmail='.$cmail.'&price='.$_POST['oprice'].'&stat=0'.'

This is a system generated mail. Please do not reply. 
        ';
        $headers = 'From:noreply@StorelotStorage.com' . "\r\n"; 
        if(mail($to, $subject, $message, $headers)) {
            echo "<script> alert('Your request has been mailed to the owner. Wait till the owner replies.'); </script>";
            echo "<script> location.href='index.php' </script>";
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
    <title>RENT ITEMS</title>
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

        .card {
            border: 1px solid black;
        }
        
        .but-text-nav {
            color: white;
            font-size: 120%; 
            padding-right: 20px;
        } 

        @media screen and (max-width: 480px) {

            #right_bar {
                float: none; 
                margin-bottom: 20px;   
            }

            .but-text-nav {
                font-size: 250%;
                margin-left: 20px;
                font-weight: bold;
            }

        }

        .nav-but {
            border: none;
            background-color: Transparent;
        }  

        .caption {
            text-align: center;
        }

        .thumbnail:hover {
            margin-top: 10px;
            box-shadow: 5px 5px 5px #000000;
            background-color: #DCDCDC;
        }

        .disp {
            color: #585858;
        }

        .interest {
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
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
                                <li><button class="nav-but" name="buy"><span class="but-text-nav">BUY</span></a></li>
                                <li><a> <span class="active">Rent</span></a></li>
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
    </section>
    <!--Landing Home ends here-->

    <!--Form-->
    <div class="jumbotron" style="margin: 0; padding-left: 10px; padding-top: 10px; min-height: 500px;">
        <form method="post">
        <div id="right_bar">
            <p>Filter</p>
            <h3>Select Type of item</h3><br>
            <select name='itype' id="i_type" autocomplete=off style="font-size: 120%; margin-bottom: 20px;">
                <option value="1">Select A Value</option>
                <option value="2">Books</option>
                <option value="3">Clothes</option>
                <option value="5">Furniture</option>
                <option value="6">Home Appliance</option>
            </select>
            <h3>Select sub-type of item</h3><br>
            <select autocomplete=off class="subtype" id="i_subtype_1" style="font-size: 120%; display: none;" name="isubtype1">
                <option value="1">Select A Value</option>
                <option value="Science Fiction">Science Fiction</option>
                <option value="Satire">Satire</option>
                <option value="Drama">Drama</option>
                <option value="Action and Adventure">Action and Adventure</option>
                <option value="Romance">Romance</option>
                <option value="Mystery">Mystery</option>
                <option value="Horror">Horror</option>
                <option value="Self help">Self help</option>
                <option value="Health">Health</option>
                <option value="Guide">Guide</option>
                <option value="Travel">Travel</option>
                <option value="Children's'">Children's</option>
                <option value="Religion, Spirituality &amp; New Age">Religion, Spirituality &amp; New Age</option>
                <option value="Science">Science</option>
                <option value="History">History</option>
                <option value="Math">Math</option>
                <option value="Anthology">Anthology</option>
                <option value="Poetry">Poetry</option>
                <option value="Encyclopedias">Encyclopedias</option>
                <option value="Dictionaries">Dictionaries</option>
                <option value="Comics">Comics</option>
                <option value="Art">Art</option>
                <option value="Cookbooks">Cookbooks</option>
                <option value="Diaries">Diaries</option>
                <option value="Journals">Journals</option>
                <option value="Prayer books">Prayer books</option>
                <option value="Series">Series</option>
                <option value="Trilogy">Trilogy</option>
                <option value="Biographies">Biographies</option>
                <option value="Autobiographies">Autobiographies</option>
                <option value="Fantasy">Fantasy</option>
            </select>
            <select autocomplete=off class="subtype" id="i_subtype_2" style="font-size: 120%; display: none;" name='isubtype2'>
                <option value="1">Select A Value</option>
                <option value="T-Shirts &amp; Polos">T-Shirts &amp; Polos</option>
                <option value="Shirts">Shirts</option>
                <option value="Jeans">Jeans</option>
                <option value="Shorts">Shorts</option>
                <option value="Sportswear">Sportswear</option>
                <option value="Innerwear">Innerwear</option>
                <option value="Socks">Socks</option>
                <option value="Rainwear">Rainwear</option>
                <option value="Ethnic Wear">Ethnic Wear</option>
                <option value="Trousers">Trousers</option>
                <option value="Jackets">Jackets</option>
                <option value="Suits &amp; Blazers">Suits &amp; Blazers</option>
                <option value="Sweatshirts &amp; Hoodies">Sweatshirts &amp; Hoodies</option>
                <option value="Sweaters">Sweaters</option>
                <option value="Sleep Wear">Sleep Wear</option>
            </select>
            <select name='isubtype4' autocomplete=off class="subtype" id="i_subtype_4" style="font-size: 120%; display: none;">
                <option value="1">Select A Value</option>
                <option value="Bed">Bed</option>
                <option value="Sofa Set">Sofa Set</option>
                <option value="Cupboard">Cupboard</option>
                <option value="Table">Table</option>
                <option value="Chair">Chair</option>
                <option value="Bookcase">Bookcase</option>
                <option value="Table Lamp">Table Lamp</option>
                <option value="Trunk">Trunk</option>
                <option value="Desk">Desk</option>
            </select>
            <select name='isubtype5' autocomplete=off class="subtype" id="i_subtype_5" style="font-size: 120%; display: none;">
                <option value="1">Select A Value</option>
                <option value="Washing Machine">Washing Machine</option>
                <option value="Refrigerator">Refrigerator</option>
                <option value="Microwave Oven">Microwave Oven</option>
                <option value="Toaster">Toaster</option>
                <option value="Mixer Grinder">Mixer Grinder</option>
                <option value="Invertor">Invertor</option>
                <option value="Generator">Generator</option>
                <option value="Oven">Oven</option>
                <option value="Dryer">Dryer</option>
            </select>
            <br><br>
            <button type='submit' name="go" id="go">Go</button>
        </div>
        </form>
        <div id="items">
        <?php
            if(!isset($_POST['go'])) {
                $query = "SELECT * FROM `items` WHERE `rent` = 1 AND `status` = 0";
                $result = mysqli_query($link, $query);
                echo "<div class='row'>";
                while($row = mysqli_fetch_assoc($result)) {
                    $iid = $row['iid'];
                    echo "<div class='col-sm-6 col-md-4'>";
                    echo "<div class='thumbnail'>";
                    echo "<div class='caption'>";
                    echo '<img src="img/items/' . $row['iimage'] . '" width="241" height="200" alt="No Image"><br><br>';
                    echo "<h3 style='font-weight: bold;'>".$row['iname']."</h3>";
                    echo "<div class='card' style='padding-left: 10px; padding-top: 10px;'>";
                    echo "<span style='font-size: 150%; color: black; font-weight: 500;'>Item Price (for 1 month): <span class='disp'>₹".$row['price']."</span></span><br>";
                    echo "<span style='font-size: 150%; color: black; font-weight: 500;'>Duration (in months): <span class='disp'>".$row['duration']."</span></span><br>";
                    echo "<span style='font-size: 150%; color: black; font-weight: 500;'>Item Name: <span class='disp'>".$row['iname']."</span></span><br>";
                    echo "<span style='font-size: 150%; color: black; font-weight: 500;'>Item Type: <span class='disp'>".$row['itype']."</span></span><br>";
                    echo "<span style='font-size: 150%; color: black; font-weight: 500;'>Item Subtype: <span class='disp'>".$row['isubtype']."</span></span></div>";
                    echo "<br><form method='post'><input class='form_input' name='oprice' type='number' placeholder='Enter offer price'>";      
                    echo " <button name='interest' value='$iid' class='btn btn-primary interest'>Interested</button></form>";
                    echo "</div></div></div>";
                }
                echo "</div>";
            }
            
            if(isset($_POST['go'])) {
                if(!empty($_POST['itype']) AND $_POST['itype']!=1) {
                    $type=$_POST['itype'];
                    $type-=2;
                    $stype = array("isubtype1","isubtype2","isubtype3","isubtype4","isubtype5","isubtype6");
                    $typeList = array("Books","Clothes","Electronic Gadgets","Furniture","Home Appliance");
                    $select = $stype[$type];
                    if($select != "" && $_POST[$select]!=1) {
                        $found=1;
                        $query = "SELECT * FROM `items` WHERE itype='".mysqli_real_escape_string($link, $typeList[$type])."' AND isubtype='". mysqli_real_escape_string($link, $_POST[$select])."' AND `rent` = 1 AND `status` = 0";
                        $result = mysqli_query($link, $query);
                        if(mysqli_num_rows($result)==0) {
                            echo "<p style='text-align: center;'>Sorry there are no items matching your preferences!";
                        }
                        else {
                            echo "<div class='row'>";
                            while($row = mysqli_fetch_assoc($result)) {
                                $iid = $row['iid'];
                                echo "<div class='col-sm-6 col-md-4'>";
                                echo "<div class='thumbnail'>";
                                echo "<div class='caption'>";
                                echo '<img src="img/items/' . $row['iimage'] . '" width="241" height="200" alt="No Image"><br><br>';
                                echo "<h3 style='font-weight: bold;'>".$row['oname']."</h3>";
                                echo "<div class='card' style='padding-left: 10px; padding-top: 10px;'>";
                                echo "<span style='font-size: 150%; color: black; font-weight: 500;'>Item Price: <span class='disp'>₹".$row['price']."</span></span><br>";
                                echo "<span style='font-size: 150%; color: black; font-weight: 500;'>Item Name: <span class='disp'>".$row['iname']."</span></span><br>";
                                echo "<span style='font-size: 150%; color: black; font-weight: 500;'>Item Type: <span class='disp'>".$row['itype']."</span></span><br>";
                                echo "<span style='font-size: 150%; color: black; font-weight: 500;'>Item Subtype: <span class='disp'>".$row['isubtype']."</span></span></div>";        
                                echo "<br><form method='post'><input class='form_input' name='oprice' type='number' placeholder='Enter offer price'>";      
                                echo " <button name='interest' value='$iid' class='btn btn-primary interest'>Interested</button></form>";
                                echo "</div></div></div>";
                            }
                            echo "</div>";
                            }
                        } 
                    } else {
                        $query = "SELECT * FROM `items` WHERE `rent` = 1 AND `status` = 0";
                        $result = mysqli_query($link, $query);
                        echo "<div class='row'>";
                        while($row = mysqli_fetch_assoc($result)) {
                            $iid = $row['iid'];
                            echo "<div class='col-sm-6 col-md-4'>";
                            echo "<div class='thumbnail'>";
                            echo "<div class='caption'>";
                            echo '<img src="img/items/' . $row['iimage'] . '" width="241" height="200" alt="No Image"><br><br>';
                            echo "<h3 style='font-weight: bold;'>".$row['oname']."</h3>";
                            echo "<div class='card' style='padding-left: 10px; padding-top: 10px;'>";
                            echo "<span style='font-size: 150%; color: black; font-weight: 500;'>Item Price: <span class='disp'>₹".$row['price']."</span></span><br>";
                            echo "<span style='font-size: 150%; color: black; font-weight: 500;'>Item Name: <span class='disp'>".$row['iname']."</span></span><br>";
                            echo "<span style='font-size: 150%; color: black; font-weight: 500;'>Item Type: <span class='disp'>".$row['itype']."</span></span><br>";
                            echo "<span style='font-size: 150%; color: black; font-weight: 500;'>Item Subtype: <span class='disp'>".$row['isubtype']."</span></span></div>";
                            echo "<br><form method='post'><input class='form_input' name='oprice' type='number' placeholder='Enter offer price'>";      
                            echo " <button name='interest' value='$iid' class='btn btn-primary interest'>Interested</button></form>";
                            echo "</div></div></div>";
                        }
                        echo "</div>";
                    }
                }  

        ?>
        </div>
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
                            <li><a href="#">Rent</a></li>
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

        $("#i_type").change(function(){
            for(var i=1;i<=6;i++)
                $("#i_subtype_"+i).css("display","none");
            if($("#i_type").val()==2)
                $("#i_subtype_1").css("display","block");
            else if($("#i_type").val()==3)
                $("#i_subtype_2").css("display","block");
            else if($("#i_type").val()==4)
                $("#i_subtype_3").css("display","block");
            else if($("#i_type").val()==5)
                $("#i_subtype_4").css("display","block");
            else if($("#i_type").val()==6)
                $("#i_subtype_5").css("display","block");
            else if($("#i_type").val()==7)
                $("#i_subtype_6").css("display","block");
        });

        $("#go").click(function(){
            var value_type = $("#i_type").val();
            var type=0;   
            var flag=0;
            var flag_sub=0;
            if(value_type==1)
            {
                $("#i_type").css("background-color","#ffcccc");
                $("#i_type").css("border-color","#ff8080");
                type=1;
                flag=1;
            } 
            else if(value_type==2)
            {
                var value_subtype=$("#i_subtype_1").val();
                var subtype=0;
                if(value_subtype==1)
                {
                    $("#i_subtype_1").css("background-color","#ffcccc");
                    $("#i_subtype_1").css("border-color","#ff8080");
                    subtype=1;
                    flag_sub=1;
                }
                if(subtype==0)
                {
                    $("#i_subtype_1").css("background-color","white");
                    $("#i_subtype_1").css("border-color","cornflowerblue");
                    flag_sub=0;
                }   
            }
            else if(value_type==3)
            {
                var value_subtype=$("#i_subtype_2").val();
                var subtype=0;
                if(value_subtype==1)
                {
                    $("#i_subtype_2").css("background-color","#ffcccc");
                    $("#i_subtype_2").css("border-color","#ff8080");
                    subtype=1;
                    flag_sub=1;
                }
                if(subtype==0)
                {
                    $("#i_subtype_2").css("background-color","white");
                    $("#i_subtype_2").css("border-color","cornflowerblue");
                    flag_sub=0;
                }
            }
            else if(value_type==4)
            {
                var value_subtype=$("#i_subtype_3").val();
                var subtype=0;
                if(value_subtype==1)
                {
                    $("#i_subtype_3").css("background-color","#ffcccc");
                    $("#i_subtype_3").css("border-color","#ff8080");
                    subtype=1;
                    flag_sub=1;
                }
                if(subtype==0)
                {
                    $("#i_subtype_3").css("background-color","white");
                    $("#i_subtype_3").css("border-color","cornflowerblue");
                    flag_sub=0;
                }
            }
            else if(value_type==5)
            {
                var value_subtype=$("#i_subtype_4").val();
                var subtype=0;
                if(value_subtype==1)
                {
                    $("#i_subtype_4").css("background-color","#ffcccc");
                    $("#i_subtype_4").css("border-color","#ff8080");
                    subtype=1;
                    flag_sub=1;
                }
                if(subtype==0)
                {
                    $("#i_subtype_4").css("background-color","white");
                    $("#i_subtype_4").css("border-color","cornflowerblue");
                    flag_sub=0;
                }
            }
            else if(value_type==6)
            {
                var value_subtype=$("#i_subtype_5").val();
                var subtype=0;
                if(value_subtype==1)
                {
                    $("#i_subtype_5").css("background-color","#ffcccc");
                    $("#i_subtype_5").css("border-color","#ff8080");
                    subtype=1;
                    flag_sub=1;
                }
                if(subtype==0)
                {
                    $("#i_subtype_5").css("background-color","white");
                    $("#i_subtype_5").css("border-color","cornflowerblue");
                    flag_sub=0;
                }
            }
            else if(value_type==7)
            {
                var value_subtype=$("#i_subtype_6").val();
                var subtype=0;
                if(value_subtype==1)
                {
                    $("#i_subtype_6").css("background-color","#ffcccc");
                    $("#i_subtype_6").css("border-color","#ff8080");
                    subtype=1;
                    flag_sub=1;
                }
                if(subtype==0)
                {
                    $("#i_subtype_6").css("background-color","white");
                    $("#i_subtype_6").css("border-color","cornflowerblue");
                    flag_sub=0;
                }
            }
            if(type==0)
            {
                $("#i_type").css("background-color","white");
                $("#i_type").css("border-color","cornflowerblue");
                flag=0;
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
