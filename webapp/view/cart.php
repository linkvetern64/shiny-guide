<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 12/5/2016
 * Time: 7:13 PM
 */
require_once(dirname(__FILE__) . '/../load.php');
session_start();
$db = new DB();
$_SESSION["cart"] += 1;
echo $_SESSION["cart"];