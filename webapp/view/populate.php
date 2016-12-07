<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 11/4/2016
 * Time: 1:22 AM
 */
    require_once(dirname(__FILE__) . '/../load.php');
    session_start();
	$db = new DB();

    $result = $db->gitGuds($_GET["code"]);

    foreach ( $result as $k => $v) {
        //Print results
    }