<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/participants.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare participants object
$participants = new Participants($db);
 
// set ID property of participants to be edited
$participants->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of participants to be edited
$participants->readOne();
 
// create array
$participants_arr=array(
    "id" => $participants->id,
	"name" => $participants->name,
	"profilImagePath" => $participants->profilImagePath,
	"movieTitle" => $participants->movieTitle,
	"movieRole" => $participants->movieRole,
	"movieBrief" => $participants->movieBrief,
	"moviePlot" => $participants->moviePlot,
	"quality" => $participants->quality
);
 
// make it json format
print_r(json_encode($participants_arr));
?>