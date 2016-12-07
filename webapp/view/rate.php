<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 12/5/2016
 * Time: 8:34 PM
 */
require_once(dirname(__FILE__) . '/../load.php');
session_start();
$db = new DB();

/**
 * Get user image, name, avg rating and 5 star rating system.
 */

$id = $_GET["id"];