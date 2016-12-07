<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 12/5/2016
 * Time: 12:00 AM
 */
require_once(dirname(__FILE__) . '/../load.php');
session_start();
$db = new DB();

$db->removeItem($_GET["id"]);