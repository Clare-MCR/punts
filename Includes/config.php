<?php

# Clare MCR Punts Booker
# (c) James Clemence (jvc26) 2009

/* --- Setup
Access database, load classes, start logger --- */


require_once('/societies/claremcr/mcrpwd.php'); # get db pwd
require_once('class_lib.php'); # load classes
require_once('Log.php');
require_once('htmlfunctions.php');

$dbuser = "claremcr";
$database = "claremcr";

// Initiate Logger
$logger = &Log::singleton("file", "/societies/claremcr/public_html/punts/logs/punts.log");

// Initiate database connection
try {
    $dbh = new PDO("mysql:host=localhost;dbname=$database;charset=utf8", $dbuser, $pwd, 
    array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(PDOException $ex) {
	echo "An Error occured!"; //user friendly message
    $logger->log("Database connection failed. " . $ex->getMessage(), PEAR_LOG_CRIT);
}

?>
