<?php 
//include('../view/login.php');
class model{
public $servername;
public $username;
public $password;
public $dbname;

	
public function __construct(){
	$this -> servername = "localhost";
	$this -> username = "root";
	$this -> password = "";
	$this -> dbname = "cms"; 


	 $this->conn = new mysqli($this -> servername, $this -> username, $this -> password, $this-> dbname );

	if ($this->conn -> connect_error){
		die("connection failed: ". $this->conn -> connect_error);
	}
}

/*
public function createDb(){
	$sql = "CREATE DATABASE newAaditya";
	if($this->conn -> query($sql) === TRUE){
		echo "Database connected successfully";
	}else{
		echo "Error creating database: ". $this->conn -> error;
	}
} */


public function Insert($tableName, $data){

	$sql = 'INSERT INTO '.$tableName.' SET ';
	foreach ($data as $key => $value) {
		$sql .= $key.'="'.$value.'",';
	}
	$sql = rtrim($sql, ',');
	
	//echo $sql; die;
	 
	 if($this->conn -> query($sql) === TRUE){
	 	//echo "New record created successfully";
	 }else{
	 	echo "Error:". $sql. "<br>". $this->conn-> error;
	}
	return $sql;
 }

 public function select($tableName, $data, $condition =''){
 	$sql = 'SELECT ';
 	foreach($data as $value){
 		$sql .= $value. "," ;
 	}  
 	$sql = rtrim($sql, ',');
 	$sql .= ' FROM '. $tableName;

 	if (!empty($condition) ){
 			$sql .= " WHERE ";
 		foreach ($condition as  $key=> $value) {
 			$sql .= $key. '='. '"' .$value. '"'. ' AND ';
 		}

 		$sql = substr($sql, 0, -4);  
 	} 
	//echo ($sql);die;

 	  $result = mysqli_query($this->conn, $sql);
 	  //var_dump($result);die;

 	  //$result = mysqli_fetch_assoc($r);
 	  return $result;
 	
 }

 public function update($tableName, $data, $condition){
	$sql = 'UPDATE '. $tableName. ' SET ';
	foreach ($data as $key=> $value){
		$sql .= $key . ' = '. '"'. $value. '"' . ',' ;
	}
	$sql = rtrim($sql, ',');

	$sql .= ' WHERE ';
		foreach ($condition as $key => $value) {
		  	$sql .= $key. '='. '"'.$value.'"'; 
		  }  
		 
//echo ($sql);die;
	$r =mysqli_query($this->conn, $sql);
 	// $result = mysqli_fetch_assoc($r);
 	return $r;
 }


	public function delete($tableName, $condition){
		$sql = 'DELETE FROM '. $tableName . ' WHERE ';
		foreach ($condition as $key => $value) {
			$sql .= $key. '='. '"'.$value . '"'. 'AND ';  
		}
		$sql = substr($sql, 0, -4);
	//echo $sql;die;
	$r = mysqli_query($this->conn, $sql);
	return $r;
	}



	public function fetch($data){
       $rows=[];
        while($row=mysqli_fetch_assoc($data)){
            $rows[]=$row;
        }
        return $rows;
   }

    public function selectLimit($tableName, $data, $condition=''){
 	$sql = 'SELECT ';
 	foreach($data as $value){
 		$sql .= $value. "," ;
 	}  
 	$sql = rtrim($sql, ',');
 	$sql .= ' FROM '. $tableName;

 			if (!empty($condition) ){
 			$sql .= " LIMIT ";
 		foreach ($condition as  $key=> $value) {
 			$sql .=   $value.  ' , ';
 		}

 		$sql = substr($sql, 0, -3);  
 	} 
 	
	 //echo ($sql);die;

 	  $result = mysqli_query($this->conn, $sql);
 	  //var_dump($result);die;

 	  //$result = mysqli_fetch_assoc($r);
 	  return $result;
 	}


 	public function selectWhereLimit($tableName, $data, $condition='', $order, $limit){
 	$sql = 'SELECT ';
 	foreach($data as $value){
 		$sql .= $value. "," ;
 	}  
 	$sql = rtrim($sql, ',');
 	$sql .= ' FROM '. $tableName;

 			if (!empty($condition) ){
 			$sql .= " Where ";
 		foreach ($condition as  $key=> $value) {
 			$sql .= $key. '='. '"' .$value. '"'. ' AND ';
 		}
 		$sql = substr($sql, 0, -4);   
 	}
 	$sql .= ' ORDER BY ';
 	foreach ($order as $key => $value) {
 		$sql .= $value;
 	}
 	$sql .= " DESC "; 

 	$sql .= " LIMIT " ;
 	foreach ($limit as $key => $value) {
 	 	$sql .= $value; 
 	 } 
 	
	 //echo ($sql);die;

 	  $result = mysqli_query($this->conn, $sql);
 	  //var_dump($result);die;

 	  //$result = mysqli_fetch_assoc($r);
 	  return $result;
 	
 }

}


?>