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

/*  For updating profile picture
 * <?php/*
                        //Update getImage to handle everything
                        echo "<img src='img/profiles/1.jpg' class='img-thumbnail picture hidden-xs' alt=''><br />";
                        if($db->imageExists($_SESSION["email"])){

                            $result = $db->getImage($_SESSION["email"]);

                            echo '<img src="data:image/jpeg;base64,' . base64_encode($result["image"]) . '"/>';
                        }

                        //if no entry in image, use kenbone
                        //otherwise print image

 *
 *
 */


$dat["img"] = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);

$dat["email"] = $_SESSION["email"];

$dat["type"] = $imageFileType;

$db->linkImage($dat);
header("Location:home.php");