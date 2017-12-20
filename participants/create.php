<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate participants object
include_once '../objects/participants.php';
 
$database = new Database();
$db = $database->getConnection();
 
$participants = new Participants($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set participants property values
$participants->name = $data->name;
$participants->profilImagePath = $data->profilImagePath;
$participants->movieTitle = $data->movieTitle;
$participants->movieRole = $data->movieRole;
$participants->movieBrief = $data->movieBrief;
$participants->moviePlot = $data->moviePlot;
$participants->quality = $data->quality;
$participants->date_added = date('Y-m-d H:i:s');
 
// create the participants
if($participants->create()){
    echo '{';
        echo '"message": "participants was created."';
    echo '}';
}
 
// if unable to create the participants, tell the user
else{
    echo '{';
        echo '"message": "Unable to create participants."';
    echo '}';
}
?>