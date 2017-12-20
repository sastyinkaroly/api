<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/participants.php';
 
// utilities
$utilities = new Utilities();
 
// instantiate database and participants object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$participants = new Participants($db);
 
// query participants
$stmt = $participants->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // participants array
    $participants_arr=array();
    $participants_arr["records"]=array();
    $participants_arr["paging"]=array();
 
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
         $participants_item=array(
            "id" => $id,
			"name" => $name,
			"profilImagePath" => $profilImagePath,
			"movieTitle" => $movieTitle,
			"movieRole" => $movieRole,
			"movieBrief" => $movieBrief,
			"moviePlot" => $moviePlot,
			"quality" => $quality
		);
		
		array_push($participants_arr["records"], $participants_item);
    }
 
 
    // include paging
    $total_rows=$participants->count();
    $page_url="{$home_url}participants/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $participants_arr["paging"]=$paging;
 
    echo json_encode($participants_arr);
}
 
else{
    echo json_encode(
        array("message" => "No participants found.")
    );
}
?>