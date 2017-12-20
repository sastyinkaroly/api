<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/participants.php';
 
// instantiate database and participants object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$participants = new Participants($db);
 
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

// query participants
$stmt = $participants->search($keywords);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // participants array
    $participants_arr=array();
    $participants_arr["records"]=array();
 
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
    echo json_encode($participants_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>