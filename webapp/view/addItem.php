<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 12/4/2016
 * Time: 5:39 PM
 */
require_once(dirname(__FILE__) . '/../load.php');
session_start();
$db = new DB();

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//echo $imageFileType;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
//echo '<img src="data:image/gif;base64,'.base64_encode( file_get_contents($_FILES["fileToUpload"]["tmp_name"] )).'"/>';

//strtr money so its only int

$dat["img"] = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
$id =  $_SESSION["campusID"];
$dat["campusID"] = $id;
$dat["type"] = $imageFileType;

$result =  $db->getItemTotal();

$entries =  sizeof($db->getActiveListings($_SESSION["email"])) . "<br>";
$dat["nextIt"] = $result[0]["itemID"] + 1;
$_POST["nextIt"] = $result[0]["itemID"] + 1;
$_POST["campusID"] = $id;

$db->addItem($_POST);
if($uploadOk > 0) {
    $db->linkImage($dat);
}
header("Location:home.php");