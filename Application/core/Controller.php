<?php

class Controller{
	protected $site;
	protected $model;
	protected $session;

	public function __construct(){
		$this->model('Akun');
		$this->session("Session");
		$this->site('Site',$this->session);
	}

	public function site($class= NULL,$sess_obj = NULL){
		if (file_exists('Application/lib/'.$class.'.php')) {
			require_once "Application/lib/".$class.".php";
			$this->site = new $class;
			$this->site->session = $this->session;
		}
	}

	public function model($class){
			require_once 'Application/models/'.$class.'.php';
			$this->model = new $class;
			return $this->model;
	}
	 
	public function post($name){
		$a = htmlspecialchars($_POST[$name]);
		return $a;
	}
	public function session($data){
			require_once 'Application/lib/'.$data.'.php';
			$this->session = new $data;
			return $this->session;
	}
	
}