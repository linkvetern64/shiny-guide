<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 12/5/2016
 * Time: 10:34 PM
 */
require_once(dirname(__FILE__) . '/../load.php');
require_once("libs.php");
session_start();
$db = new DB();

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
    <!--link href="css/freelancer.min.css" rel="stylesheet"-->
    <!--link href="css/styles.css" type="text/css" rel="stylesheet"-->
    <link href="css/profile.css" type="text/css" rel="stylesheet">



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
    <script src="js/ajax.js"></script>
    <script src="js/libs.js"></script>

    <script type="text/javascript">

        //var JQ = $.noConflict(); //Need JQUERY.NOCONFLICT();  Otherwise prototypes methods will be overwritten
        jQuery(function ($) {
            // The dollar sign will equal jQuery in this scope
            $('.modal')
                .on('show.bs.modal', function() {
                    populate(this.id);
                });
            $(document).ready(function() {
                $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item ');});
                $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item ');$('#products .item').addClass('grid-group-item');});
            });

        });

    </script>

    <link href="css/listed-items.css" type="text/css" rel="stylesheet">

</head>

<body id="page-top" class="index" bgcolor="#">

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
    <div class="container">
        <!-- Move this to bottom of page -->
        <div  class="well well-sm" style="margin-top:-70px;">
            <div class="btn-group">
                <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                        class="glyphicon glyphicon-th"></span>Grid</a>
            </div>
        </div>
        <div id="products" class="row list-group">
            <!-- Dynamic Content goes here-->
            <?php searchPop($_POST["search"])?>
        </div>
    </div>

</header>

<div class="modal fade" id="rate"  role="dialog" aria-hidden="true">
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
                    <h2 style="text-align:center;width:inherit !important;">Account Rate</h2>
                    <hr class="star-primary">
                    <form action="register.php" method="post" accept-charset="UTF-8">

                        <button value="Register" type="submit" onclick="return validate();">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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

