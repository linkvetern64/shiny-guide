<?php
    require_once(dirname(__FILE__) . '/../load.php');
    session_start();
    $db = new DB();

    $id = $_GET["ID"];
    $val = $_GET["val"];
    if($id == "emailIn"){
        $result = $db->entryExists($val, "email");
    }
    if($id == "campusID"){
        $result = $db->entryExists($val, "campusID");
    }
    if($id == "username"){
        $result = $db->entryExists($val, "username");
    }

    if($result){
        echo 1;
    }
    else{
        echo 0;
    }