<?php

    session_start();

    $link = mysqli_connect("localhost","root","123456","storelot");
    if(isset($_POST['lsubmit'])) {
        if(!empty($_POST['iname']) AND !empty($_POST['itype']) AND $_POST['itype']!=1) {
            $type=$_POST['itype'];
            $type-=2;
            $stype = array("isubtype1","isubtype2","isubtype3","isubtype4","isubtype5","isubtype6","isubtype7");
            $typeList = array("Books","Clothes","Documents","Electronic Gadgets","Furniture","Home Appliance","Valuables");
            $select = $stype[$type];
            if($select != "" && $_POST[$select]!=1) {
                $query = "SELECT `id` FROM `users` WHERE name = '".mysqli_real_escape_string($link, $_SESSION['name'])."' 
                AND mobile = '".mysqli_real_escape_string($link, $_SESSION['mobile'])."'";
                $result = mysqli_query($link, $query);
                $row = mysqli_fetch_array($result);
                $iid = $row['id'];
                if(!empty($iid)) {
                    $errors= "";
                    $file_name = $_FILES['image']['name'];
                    $file_size =$_FILES['image']['size'];
                    $file_tmp =$_FILES['image']['tmp_name'];
                    $file_type=$_FILES['image']['type'];
                    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

                    $expensions= array("jpeg","jpg","png");

                    if(in_array($file_ext,$expensions)=== false){
                        $errors .= "extension not allowed, please choose a JPEG or PNG file.";
                    }

                    if($file_size > 2000000){
                        $errors .= 'File size must not be greater than 2 MB';
                    }

                    if(empty($errors)==true){
                        move_uploaded_file($file_tmp,"img/items/".$file_name);
                        $query = "INSERT INTO `items`(`id`, `cname`, `iname`, `itype`, `isubtype`, `iimage`) VALUES('".mysqli_real_escape_string($link, $iid)."', '".mysqli_real_escape_string($link, $_SESSION['name'])."', '".mysqli_real_escape_string($link, $_POST['iname'])."', '".mysqli_real_escape_string($link, $typeList[$type])."', '".mysqli_real_escape_string($link, $_POST[$select])."', '".mysqli_real_escape_string($link, $file_name)."')";
                        
                        if(mysqli_query($link, $query)) {
                            echo "<script> alert('Item added to database. Delivery persons will pick your item soon.'); </script>";
                        }
                    }else{
                        echo "<script> alert('$errors'); </script>";
                    }
                }
            }
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
    <title>LOCKER FORM</title>
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
                                <li><a href="index.php#locker"><span class="active">Locker</span></a></li>
                                <li><a href="index.php#rent_it_out">Rent It Out</a></li>
                                <li><a href="index.php#sell">Sell</a></li>
                                <li><a href="index.php#give_it_away">Give It Away</a></li>
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
        <form method="post" target="myiframe" enctype="multipart/form-data">
            <h2>Item Name <span class="required">*</span></h2>
            <input type="text" name='iname' class="form_input" id="i_name" placeholder="Enter Item Name" autocomplete=off>
            <br><br>
            <h2>Item Type <span class="required">*</span></h2>
            <select class="form_input" name='itype' id="i_type" autocomplete=off>
                <option value="1">Select A Value</option>
                <option value="2">Books</option>
                <option value="3">Clothes</option>
                <option value="6">Furniture</option>
                <option value="7">Home Appliance</option>
            </select>
            <div id="book" style="display: none;">
                <br>
                <h2>Book Genre <span class="required">*</span></h2>
                <select class="form_input" name='isubtype1' id="i_subtype_book" autocomplete=off>
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
            </div>

            <div id="cloth" style="display: none;">
                <br>
                <h2>Cloth Type <span class="required">*</span></h2>
                <select class="form_input" name='isubtype2' id="i_subtype_cloth" autocomplete=off>
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
            </div>
            
            <div id="furniture" style="display: none;">
                <br>
                <h2>Furniture Type <span class="required">*</span></h2>
                <select class="form_input" name='isubtype5' id="i_subtype_furniture" autocomplete=off>
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
            </div>

            <div id="appliance" style="display: none;">
                <br>
                <h2>Appliance Type <span class="required">*</span></h2>
                <select class="form_input" name='isubtype6' id="i_subtype_appliance" autocomplete=off>
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
            </div>
            
            <br><br>
            <h2>Upload a Picture of your item <span class="required">*</span></h2>
            <br>    
            <h5>Acceptable Size: Upto 2MB</h5>
            <input type="file" name="image" class="form_input_file" id="i_image" accept="image/*" autocomplete=off>
            <br><br>
            <button type="submit" name='lsubmit' class="btn btn-primary submit" id="Submit">Submit</button>
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

        $("#i_type").change(function(){
            $("#book").css("display","none");
            $("#cloth").css("display","none");
            $("#document").css("display","none");
            $("#gadget").css("display","none");
            $("#furniture").css("display","none");
            $("#appliance").css("display","none");
            $("#valuable").css("display","none");

            if($("#i_type").val()==2)
                $("#book").css("display","block");
            else if($("#i_type").val()==3)
                $("#cloth").css("display","block");
            else if($("#i_type").val()==4)
                $("#document").css("display","block");
            else if($("#i_type").val()==5)
                $("#gadget").css("display","block");
            else if($("#i_type").val()==6)
                $("#furniture").css("display","block");
            else if($("#i_type").val()==7)
                $("#appliance").css("display","block");
            else if($("#i_type").val()==8)
                $("#valuable").css("display","block");
        });

        $(".alert").hide();
        $("#Submit").click(function(){
            var value_name = $("#i_name").val();
            var value_type = $("#i_type").val();
            var value_image = $("#i_image").val();
            var name=0;
            var type=0;
            var error="";
            if(value_name=="")
            {
                error+="\nEnter the name of item.";
                $("#i_name").css("background-color","#ffcccc");
                $("#i_name").css("border-color","#ff8080");
                name=1;
            }    
            if(value_type==1)
            {
                error+="\nEnter the type of item.";
                $("#i_type").css("background-color","#ffcccc");
                $("#i_type").css("border-color","#ff8080");
                type=1;
            } 
            else if(value_type==2)
            {
                var value_subtype=$("#i_subtype_book").val();
                var subtype=0;
                if(value_subtype==1)
                {
                    error+="\nEnter the genre of book.";
                    $("#i_subtype_book").css("background-color","#ffcccc");
                    $("#i_subtype_book").css("border-color","#ff8080");
                    subtype=1;
                }
                if(subtype==0)
                {
                    $("#i_subtype_book").css("background-color","white");
                    $("#i_subtype_book").css("border-color","cornflowerblue");
                }   
            }
            else if(value_type==3)
            {
                var value_subtype=$("#i_subtype_cloth").val();
                var subtype=0;
                if(value_subtype==1)
                {
                    error+="\nEnter the type of cloth.";
                    $("#i_subtype_cloth").css("background-color","#ffcccc");
                    $("#i_subtype_cloth").css("border-color","#ff8080");
                    subtype=1;
                }
                if(subtype==0)
                {
                    $("#i_subtype_cloth").css("background-color","white");
                    $("#i_subtype_cloth").css("border-color","cornflowerblue");
                }
            }
            else if(value_type==4)
            {
                var value_subtype=$("#i_subtype_document").val();
                var subtype=0;
                if(value_subtype==1)
                {
                    error+="\nEnter the type of document.";
                    $("#i_subtype_document").css("background-color","#ffcccc");
                    $("#i_subtype_document").css("border-color","#ff8080");
                    subtype=1;
                }
                if(subtype==0)
                {
                    $("#i_subtype_document").css("background-color","white");
                    $("#i_subtype_document").css("border-color","cornflowerblue");
                }
            }
            else if(value_type==5)
            {
                var value_subtype=$("#i_subtype_gadget").val();
                var subtype=0;
                if(value_subtype==1)
                {
                    error+="\nEnter the type of gadget.";
                    $("#i_subtype_gadget").css("background-color","#ffcccc");
                    $("#i_subtype_gadget").css("border-color","#ff8080");
                    subtype=1;
                }
                if(subtype==0)
                {
                    $("#i_subtype_gadget").css("background-color","white");
                    $("#i_subtype_gadget").css("border-color","cornflowerblue");
                }
            }
            else if(value_type==6)
            {
                var value_subtype=$("#i_subtype_furniture").val();
                var subtype=0;
                if(value_subtype==1)
                {
                    error+="\nEnter the type of furniture.";
                    $("#i_subtype_furniture").css("background-color","#ffcccc");
                    $("#i_subtype_furniture").css("border-color","#ff8080");
                    subtype=1;
                }
                if(subtype==0)
                {
                    $("#i_subtype_furniture").css("background-color","white");
                    $("#i_subtype_furniture").css("border-color","cornflowerblue");
                }
            }
            else if(value_type==7)
            {
                var value_subtype=$("#i_subtype_appliance").val();
                var subtype=0;
                if(value_subtype==1)
                {
                    error+="\nEnter the type of appliance.";
                    $("#i_subtype_appliance").css("background-color","#ffcccc");
                    $("#i_subtype_appliance").css("border-color","#ff8080");
                    subtype=1;
                }
                if(subtype==0)
                {
                    $("#i_subtype_appliance").css("background-color","white");
                    $("#i_subtype_appliance").css("border-color","cornflowerblue");
                }
            }
            else if(value_type==8)
            {
                var value_subtype=$("#i_subtype_valuable").val();
                var subtype=0;
                if(value_subtype==1)
                {
                    error+="\nEnter the type of valuable.";
                    $("#i_subtype_valuable").css("background-color","#ffcccc");
                    $("#i_subtype_valuable").css("border-color","#ff8080");
                    subtype=1;
                }
                if(subtype==0)
                {
                    $("#i_subtype_valuable").css("background-color","white");
                    $("#i_subtype_valuable").css("border-color","cornflowerblue");
                }
            }
            if(value_image=="")
                error+="\nUpload an image.";    
            if(name==0)
            {
                $("#i_name").css("background-color","white");
                $("#i_name").css("border-color","cornflowerblue");
            }    
            if(type==0)
            {
                $("#i_type").css("background-color","white");
                $("#i_type").css("border-color","cornflowerblue");
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
