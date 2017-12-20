<?php
class Participants{
 
    // database connection and table name
    private $conn;
    private $table_name = "participants";
 
    // object properties
  	
	public $id;
    public $name;
    public $profilImagePath;
    public $movieTitle;
    public $movieRole; /*ENUM type - It can be 'best actor','best supporting actor','best actress','best supporting actress'*/
    public $movieBrief;
    public $moviePlot;
    public $quality; /*ENUM type - It can be 'nominated' or 'winner'*/
    public $active;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	// read all participants
	function read(){
	 	// select all query
		$query = "SELECT
					*
				FROM
					" . $this->table_name . " 
				WHERE 
					`active`= 0
				ORDER BY
					`date_added` DESC";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	// read participant by id
	function readOne(){
	 
		// query to read single record
		$query = "SELECT
					*
				FROM
					" . $this->table_name . "
				WHERE
					id = ?
				AND
					active = 0
				LIMIT
					0,1";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// bind id of participants to be updated
		$stmt->bindParam(1, $this->id);
	 
		// execute query
		$stmt->execute();
	 
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		// set values to object properties
		
		$this->name = $row['name'];
		$this->profilImagePath = $row['profilImagePath'];
		$this->movieTitle = $row['movieTitle'];
		$this->movieRole = $row['movieRole'];
		$this->movieBrief = $row['movieBrief'];
		$this->moviePlot = $row['moviePlot'];
		$this->quality = $row['quality'];
	}
	// create participant
	function create(){
	 
		// query to insert record
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					name=:name, profilImagePath=:profilImagePath, movieTitle=:movieTitle, movieRole=:movieRole, movieBrief=:movieBrief, moviePlot=:moviePlot, quality=:quality, date_added=NOW()";
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->profilImagePath = htmlspecialchars(strip_tags($this->profilImagePath));
		$this->movieTitle = htmlspecialchars(strip_tags($this->movieTitle));
		$this->movieRole = htmlspecialchars(strip_tags($this->movieRole));
		$this->movieBrief = htmlspecialchars(strip_tags($this->movieBrief));
		$this->moviePlot = htmlspecialchars(strip_tags($this->moviePlot));
		$this->quality = htmlspecialchars(strip_tags($this->quality));
		
		// bind values
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":profilImagePath", $this->profilImagePath);
		$stmt->bindParam(":movieTitle", $this->movieTitle);
		$stmt->bindParam(":movieRole", $this->movieRole);
		$stmt->bindParam(":movieBrief", $this->movieBrief);
		$stmt->bindParam(":moviePlot", $this->moviePlot);
		$stmt->bindParam(":quality", $this->quality);
		 
		// execute query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	// update participant
	function update(){
	 
		// update query
		$query = "UPDATE
					" . $this->table_name . "
				SET
					name = :name,
					profilImagePath = :profilImagePath,
					movieTitle = :movieTitle,
					movieRole = :movieRole
					movieBrief = :movieBrief
					moviePlot = :moviePlot
					quality = :quality
				WHERE
					id = :id";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->profilImagePath = htmlspecialchars(strip_tags($this->profilImagePath));
		$this->movieTitle = htmlspecialchars(strip_tags($this->movieTitle));
		$this->movieRole = htmlspecialchars(strip_tags($this->movieRole));
		$this->movieBrief = htmlspecialchars(strip_tags($this->movieBrief));
		$this->moviePlot = htmlspecialchars(strip_tags($this->moviePlot));
		$this->quality = htmlspecialchars(strip_tags($this->quality));
	 
		// bind new values
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":profilImagePath", $this->profilImagePath);
		$stmt->bindParam(":movieTitle", $this->movieTitle);
		$stmt->bindParam(":movieRole", $this->movieRole);
		$stmt->bindParam(":movieBrief", $this->movieBrief);
		$stmt->bindParam(":moviePlot", $this->moviePlot);
		$stmt->bindParam(":quality", $this->quality);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	// delete participant -> update `active` field 0 to 1
	function delete(){
	 
		// delete query
		$query = "UPDATE
					" . $this->table_name . "
				SET
					active = 1
				WHERE
					id = ?";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));
	 
		// bind id of record to delete
		$stmt->bindParam(1, $this->id);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	// search participants by keyword
	function search($keywords){
	 
		// select all query
		$query = "SELECT
					*
				FROM
					" . $this->table_name . "
				WHERE
					name LIKE ? OR
					profilImagePath LIKE ? OR 
					movieTitle LIKE ? OR 
					movieRole LIKE ? OR 
					movieBrief LIKE ? OR 
					moviePlot LIKE ? OR 
					quality LIKE ?
				ORDER BY
					date_added DESC";
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$keywords=htmlspecialchars(strip_tags($keywords));
		$keywords = "%{$keywords}%";
	 
		// bind
		$stmt->bindParam(1, $keywords);
		$stmt->bindParam(2, $keywords);
		$stmt->bindParam(3, $keywords);
		$stmt->bindParam(4, $keywords);
		$stmt->bindParam(5, $keywords);
		$stmt->bindParam(6, $keywords);
		$stmt->bindParam(7, $keywords);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	// read participants with pagination
	public function readPaging($from_record_num, $records_per_page){
	 
		// select query
		$query = "SELECT
					*
				FROM
					" . $this->table_name . "
				ORDER BY 
					date_added DESC
				LIMIT ?, ?";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// bind variable values
		$stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
		$stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
	 
		// execute query
		$stmt->execute();
	 
		// return values from database
		return $stmt;
	}
	// used for paging participants
	public function count(){
		$query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
	 
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	    return $row['total_rows'];
	}
}