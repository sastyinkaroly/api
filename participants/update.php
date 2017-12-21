<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/participants.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare participants object
$participants = new Participants($db);
 
// get id of participants to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of participants to be edited
$participants->id = $data->id;
 
// set participants property values
$participants->name = $data->name;
$participants->profilImagePath = $data->profilImagePath;
$participants->movieTitle = $data->movieTitle;
$participants->movieRole = $data->movieRole;
$participants->movieBrief = $data->movieBrief;
$participants->moviePlot = $data->moviePlot;
$participants->quality = $data->quality;
$participants->last_modified = date('Y-m-d H:i:s');
 
// update the participants
if($participants->update()){
    echo '{';
        echo '"message": "participants was updated."';
    echo '}';
}
 
// if unable to update the participants, tell the user
else{
    echo '{';
        echo '"message": "Unable to update participants."';
    echo '}';
}
?>