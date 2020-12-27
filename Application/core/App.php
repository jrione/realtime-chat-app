<?php

class App{
	protected $controller = 'Home';
	protected $method	  = 'index';
	protected $params	  = array();
	protected $session;

	public function __construct(){
		$url = $this->parseURL();
		$u = ucfirst($url[0]);
		if (file_exists('Application/controllers/'.$u.'.php')) {
			$this->controller = $u;
			unset($url[0]);
		}
		require_once "Application/controllers/".$this->controller.".php";
		$this->controller = new $this->controller;

		if (isset($url[1])) {
			if (method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		if (!empty($url)) {
			$this->params = array_values($url);
		}

		call_user_func_array([$this->controller,$this->method], $this->params);

	}
	public function parseURL(){
		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url'],'/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/',$url);
			return $url;
		}
	}	
}