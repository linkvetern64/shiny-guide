<?php
require_once(dirname(__FILE__) . '/../load.php');
session_start();
if(!$_SESSION["auth"]){
    header("Location:logout.php");
}
$db = new DB();
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 10/6/2016
 * Time: 5:57 PM
 */
$_SESSION["msg"]  =  $db->getMessageNo($_SESSION["email"]);
$_SESSION["campusID"] = $db->getCampusID($_SESSION["email"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UMBC Market</title>
    <link rel='shortcut icon' href='img/favicon.ico' type='image/x-icon'/ >

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/freelancer.min.css" rel="stylesheet">
    <link href="css/styles.css" type="text/css" rel="stylesheet">
    <link href="css/profile.css" type="text/css" rel="stylesheet">
    <link href="css/star.css" type="text/css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <!--<script src="vendor/jquery/jquery.min.js"></script>

    -->

    <!-- AJAX Prototype Import -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">jQuery.noConflict();</script>
    <script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js"></script>


    <script type="text/javascript">
        //var JQ = $.noConflict(); //Need JQUERY.NOCONFLICT();  Otherwise prototypes methods will be overwritten
        //This removes the current active listings.
        jQuery(function ($) {
            /*
            $(document).ready(function(){
                $(".page-item").click(function(){
                    $(".list-group-item").remove();
                });
            });*/
            $(document).ready(function(){
                page(1);
            });

            // The dollar sign will equal jQuery in this scope
            $('.modal')
                .on('show.bs.modal', function() {
                    populate(this.id);
                });

        });

    </script>
</head>

<body id="page-top" class="index" bgcolor="#" >
<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll" >
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a  class="navbar-brand" style="margin-left:-100px;" href="#page-top">UMBC Marketplace</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right" style="margin-right:-100px;">

                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll">
                    <a href="index.php">Marketplace</a>
                </li>
                <li class="page-scroll">
                    <a href="#portfolio">Shop</a>
                </li>
                <li class="page-scroll">
                    <a href="#about">Service</a>
                </li>
                <li class="page-scroll">
                    <a href="home.php">Profile
                        <?php
                        if($_SESSION["auth"]){
                            echo "<span class='badge'>" . $_SESSION["msg"] . "</span>";
                        }
                        ?>
                    </a>
                </li>
                <li class="page-scroll">
                    <a href="index.php"><span class="glyphicon glyphicon-shopping-cart"></span>
                        <?php
                        if($_SESSION["auth"]){
                            echo "<span class='badge'>" . $_SESSION["cart"] . "</span>";
                        }
                        ?>
                    </a>
                </li>
                <li class="page-scroll">
                    <?php if($_SESSION["auth"])echo "<a href='logout.php'>Logout</a>"; ?>
                </li>
                <li>
                    <?php
                    if($_SESSION["auth"]) {
                        echo '
                            <form action="results.php" method="post" class="navbar-form" role="search" style="position:relative;right:0px;">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search">
                                        <span class="sr-only">Search...</span>
                                    </span>
                                </button>
                            </span>
                                </div>
                            </form>';
                    }
                    ?>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav navbar-right" <?php if($_SESSION["auth"])echo "style='display:none;'"; ?>>
            <li><p class="navbar-text">Already have an account?</p></li>
            <li class="dropdown keep">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                <ul id="login-dp" class="dropdown-menu">
                    <li>
                        <div class="row">
                            <div class="col-md-12">
                                Login via
                                <div class="social-buttons">
                                    <a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
                                    <a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
                                </div>
                                or
                                <!-- LOGIN SECTION -->
                                <form class="form" role="form" method="post" action="login.php" accept-charset="UTF-8" id="login-nav">
                                    <div class="form-group">
                                        <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="exampleInputPassword2">Password</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                        <?php if($_SESSION["wrongPass"]){echo "<span class='wrong'>*Incorrect Login</span>";} ?>
                                        <div class="help-block text-right"><a href="" style="color:#efc660 !important;">Forget the password ?</a></div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> keep me logged-in
                                        </label>
                                        <i style="font-size:.6em;">Don't have an account? <a class="avis portfolio-link" data-toggle="modal" href="#createAccount">Register</a></i>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<!-- Header -->
<header>
    <div class="container" style="margin-top:-60px;">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic" id="heat">

                        <?php

                                $result = $db->getImage($_SESSION["email"]);

                                if($result) {
                                    echo '<img src="data:image/' . $result[0]["type"] . ';base64,' . base64_encode($result[0]["image"]) . '"/>';
                                }
                                else{
                                    echo '<img src="img/profile.jpg" class="img-thumbnail picture hidden-xs" alt="">';
                                }
                        ?>
                        <br>
                        <a data-toggle='modal' href='#changeProfile' style="font-size:.8em;">Change picture?</a>
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle" >
                        <div class="profile-usertitle-name">
                            <?php echo $_SESSION["name"]; ?>
                        </div>
                        <div class="profile-usertitle-job">
                            <!--Developer <!-- 5 star rating system here -->
                            <fieldset class="rating" style="margin-left:25%;">

                                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
                                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
                                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
                                <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
                            </fieldset>
                            <br><br>
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <button type="button" class="btn btn-success btn-sm">Follow</button>
                        <button type="button" class="btn btn-danger btn-sm">Message</button>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="active">
                                <a href="#">
                                    <i class="glyphicon glyphicon-home"></i>
                                    Overview </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Account Settings </a>
                            </li>
                            <li>
                                <a  data-toggle='modal' href='#editItem'>
                                        <i class="glyphicon glyphicon-plus"></i>
                                    Add Item </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-flag"></i>
                                    Help </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>

            <div class="col-md-9" >
                <div class="profile-content">
                    <div id="list-content" class="list-group">
                       <!-- Dynamic content goes here -->

                    </div>
                    <br><br>
                    <nav aria-label="..." style="position:absolute;left:40%; bottom:0;margin:0 auto;">
                        <ul class="pagination pagination-sm" >
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" onclick="page(1);" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" onclick="page(2);" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" onclick="page(3);" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>

                            <select id="display-results" class="fit-paginator" placeholder="5" onchange="updateView();">
                                <option value="5">5</option>
                                <option value="10">10</option>
                            </select>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>

</header>
<div class="modal fade" id="changeProfile"  role="dialog" aria-hidden="true">
    <div class="modal-content" id="create">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container" style="width:inherit;height: inherit;">
            <div class="row">
                <div class="modal-body fit" >
                    <h2 style="text-align:center;width:inherit !important;">Item Edit</h2>
                    <hr class="star-primary">
                    <form action="updateProfile.php" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                        <!-- Item Edit Content goes here -->
                        <label>
                            Image upload: <input type="file" name="fileToUpload" id="fileToUpload">
                        </label>
                        <button style="margin:0 auto;" value="Register" type="submit" onclick="return validate();">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editItem"  role="dialog" aria-hidden="true">
    <div class="modal-content" id="create">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container" style="width:inherit;height: inherit;">
            <div class="row">
                <div class="modal-body fit" >
                    <h2 style="text-align:center;width:inherit !important;">Item Edit</h2>
                    <hr class="star-primary">
                    <form action="addItem.php" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                        <!-- Item Edit Content goes here -->
                        <label> Title: <br>
                            <input type="text" name="good" />
                        </label> <br>
                        <label> Price: <br>
                            <input type="text" name="price" placeholder="$"/>
                        </label><br>
                        <label> Type: <br>
                            <input type="text" name="type" placeholder="books, electronics..."/>
                        </label> <br />
                        <label> Tags: <br>
                            <textarea name="meta" placeholder="Used for searching"></textarea>
                        </label>
                        <label> Item Description: <br>
                            <textarea name="desc" placeholder="Enter item condition"></textarea>
                        </label>
                        <label>
                            Image upload: <input type="file" name="fileToUpload" id="fileToUpload">
                        </label>
                        <button style="margin:0 auto;" value="Register" type="submit" onclick="return validate();">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Custom JS Files -->
<script src="js/libs.js"></script>
<script src="js/ajax.js"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>
<!--<script src="js/contact_me.js"></script>

 <!-- Theme JavaScript -->
<script src="js/freelancer.min.js"></script>

</body>

</html>
