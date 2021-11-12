<?php 
  class dbx{          
	var $res;
    var $query;
	  
	function __construct(){
		// $this->aaa = DatabaseSettings::getSettings();

	 }

	function connect(){
		$this->res = mysqli_connect(db_host,db_username,db_password, db_database);
		if(!$this->res) 
			die($this->debug("connect"));
       } 

    function rowcount($query){
		$this->query = $query;
		$result = mysqli_query($this->res,$query) or die($this->debug("query"));
		return mysqli_num_rows($result);
       }
    
	function Q($type, $query){		
	    $this->query = $query; 
	    if($type=="select"){
			$result = mysqli_query($this->res, $query) or die($this->debug("query"));
			if(mysqli_num_rows($result) > 0){
				while($record = mysqli_fetch_array($result)){
					$data[] = $record;
			    }
				return $data;
			 }else{
				return false;
			   }
		}
		
		
		   else if($type=="select2")
		   {
			$result = mysqli_query($this->res, $query) or die($this->debug("query"));
			
			   if(mysqli_num_rows($result) > 0)
			   {
				while($record = mysqli_fetch_assoc($result)){
					$data = $record;
			    }
				return $data;
			 }else{
				return false;
			   }
		}
		else if($type=="insert") {
		
	           $result = mysqli_query($this->res,$query) or die($this->debug("query"));
	           return mysqli_insert_id($this->res);
		 }else if($type=="update"){
	           $result = mysqli_query($this->res,$query) or die($this->debug("query"));
	           return $result;
	        }else if($type == "delete"){          
                $result = mysqli_query($this->res,$query) or die($this->debug("query"));
	           return $result;      
	       }		
		return false;	  
     }  
	
	function debug($type) {
		 
		  switch ($type) {
		   case "connect":
			   $message = "MySQL Error Occured";
			   $result = mysqli_errno() . ": " . mysqli_error(). " -> ";
			   $output = "Could not connect to the database. Be sure to check that your database connection settings are correct and that the MySQL server in running.";
               break;

			case "database":	

				$message = "MySQL Error Occurred";
				$result =  mysqli_errno($this->res) . ": " .  mysqli_error($this->res). " -> ";
				$output = "Sorry an error has occured accessing the database. Be sure to check that your database connection settings are correct and that the MySQL server in running.";

			case "query":

		           $message = "MySQL Error Occurred";
		           $result =  mysqli_errno($this->res) . ": " .  mysqli_error($this->res) . " -> ";
		           $query = $this->query;
        }
       
	
       return $result.$query;
	}

	
	  
	  
}

?>
