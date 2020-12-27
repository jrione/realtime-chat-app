<?php

class Home extends Controller {

	public function __construct(){
		parent::__construct();

	}

	public function index(){
		$this->site->view('user/index');

	}
}