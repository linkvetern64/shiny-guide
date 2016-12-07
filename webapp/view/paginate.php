<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 12/3/2016
 * Time: 1:06 PM
 * Desc:
 * This file is used for Ajax pagination for home.php
 * The user will click on a page that is dynamically generated.
 * This will then send a page number to paginate.php and will
 * echo the @MAX_LIST_SIZE entries to the home table.
 *
 * Update:
 * Will most likely be expanded to accommodate generic pagination
 */
require_once(dirname(__FILE__) . '/../load.php');
session_start();
$db = new DB();

echo json_encode($db->getActiveListings($_SESSION["email"]));

















