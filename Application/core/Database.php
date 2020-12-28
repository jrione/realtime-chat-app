<?php

class Database {

	protected $host = DB_HOST;
	protected $user = DB_USER;
	protected $pass = DB_PASS;
	protected $db_name = DB_NAME;

	private $conn;
	private $statement;
	private $dataString = [];

	public function __construct(){
			$d='mysql:host='.$this->host.';dbname='.$this->db_name;
			$opt=[
				PDO::ATTR_PERSISTENT => TRUE,
				PDO::ATTR_ERRMODE	=> PDO::ERRMODE_EXCEPTION
			];
		try{
			$this->conn=new PDO($d,$this->user,$this->pass,$opt);
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}

	public function get($table,$where=[],$limit=NULL,$offset=NULL,$only="*"){
		if ($where == NULL) {
			$whe='';
		}
		else{
			foreach ($where as $key => $value) {
				$wh="{$key} = '{$value}'";
				array_push($this->dataString, $wh);
			}
			$whe="WHERE ".implode(" AND " , $this->dataString);
		}
		if ($limit AND ($offset OR $offset == 0)) {
			$limitt = "LIMIT {$limit}";
			$offsett = "OFFSET 0{$offset}";
		}
		else{
			$limitt = "";
			$offsett = "";
		}
		$sql="SELECT {$only} FROM {$table} {$whe} {$limitt} {$offsett}";
		$this->statement=$this->conn->prepare($sql);
		$this->statement->execute();

		return $this->statement->fetchAll(PDO::FETCH_ASSOC);
	}

	/*public function get_where($dbtable,$where=NULL,$limit=NULL,$offset=NULL,$only = "*"){
		if ($where) {
			$where = "WHERE {$where}";
		}
		if ($limit AND ($offset OR $offset == 0)) {
			$limit = "LIMIT {$limit}";
			$offset = "OFFSET {$offset}";
		}
		$this->statement=$this->conn->prepare("SELECT {$only} FROM {$dbtable} {$where} {$limit} {$offset}");
		$this->statement->execute();
		return $this->statement->fetchAll(PDO::FETCH_ASSOC);
	}*/

	public function insert($table,$data){
		$value=implode("','", $data);
		foreach ($data as $data2 => $data3[]){
			array_push($this->dataString, $data2);
		}
		$column=implode(',', $this->dataString);
		$this->statement=$this->conn->prepare("INSERT INTO {$table} ({$column}) VALUE ('{$value}')");
		$this->statement->execute();
	}

	public function update($table,$data,$where=[]){
		foreach ($data as $key => $value) {
			$val=$key."='{$value}'";
			array_push($this->dataString, $val);
		}
		$v=implode(', ', $this->dataString);

		if ($where == NULL) {
			$que= "UPDATE {$table} SET {$v}";	
		}
		else{
			$arr=[];
			foreach ($where as $index => $values) {
				$va=$index.="='{$values}'";
				array_push($arr, $va);
			}
			$vaa=implode(' AND ', $arr);
			$que= "UPDATE {$table} SET {$v}  WHERE {$vaa}";
		}
		$this->statement=$this->conn->prepare($que);
		$this->statement->execute();
	}

	public function delete($table,$data,$where=[]){
		if ($where == NULL) {
			$sql= "DELETE FROM {$table}";
		}
		else{
			foreach ($where as $index => $values) {
				$va=$index.="='{$values}'";
				array_push($this->dataString, $va);
			}
			$val=implode(" AND ",$this->dataString);
			$sql= "DELETE FROM {$table} WHERE {$val}";
		}
		$this->statement=$this->conn->prepare($sql);
		$this->statement->execute();
	}

	public function result_query($sql){
		$this->statement=$this->conn->prepare($sql);
		$this->statement->execute();
	 	$sss = $this->statement->fetchAll(\PDO::FETCH_ASSOC);
	 	print_r($sss);

	}

	public function update_query($sql){
		$this->statement=$this->conn->prepare($sql);
		$this->statement->execute();
	}

	public function num_rows($sql){
		$this->statement=$this->conn->prepare($sql);
		$this->statement->execute();
		return  $this->statement->rowCount();
	}

	public function num_rows_where($dbtable,$where){
		$arr=[];
		foreach ($where as $index => $values) {
			$va=$index.="='{$values}'";
			array_push($arr, $va);
		}
		$vaa=implode(' AND ', $arr);
		$sql = "SELECT*FROM {$dbtable} WHERE {$vaa}";
		$this->statement=$this->conn->prepare($sql);
		$this->statement->execute();
		return  $this->statement->rowCount();
	}
}