a<?php


class Site{

	public $session;

	public function __construct(){
	}

	public function view($page,$data =NULL){
		require_once "Application/views/".$page.".php";	
	}

	public function title($title){
		?>
		<title><?= $title ?></title>
		<?php
	}
}