<?php

class Akun{

	protected $db; 

	public function __construct(){
		$this->db = new Database();
	} 

	public function register($dbtable,$data){
		$this->db->insert($dbtable,$data);
	}

	public function show_data($dbtable,$data){
		 return $this->db->num_rows("SELECT*FROM {$dbtable} WHERE username= '{$data['username']}'");
	}

	public function masuk($dbtable,$where){
		return $this->db->num_rows_where($dbtable,$where);
	}
}