<?php

function base_url($target=NULL){
	$base = "http://{$_SERVER['HTTP_HOST']}/";
	if ($target!=NULL) {
		return $base.$target;
	}
	else{
		return $base;
	}
}

function redirect($data=NULL){
	header("location:{$data}");
}

function cryptText($pass){
		$random_number=1239;
      	$salt=sprintf('$2a$%02d$09$wasd$$$',$random_number);
      	$salt=md5($salt);
      	$salt=base64_encode($salt);
	 
 	 	$s=md5(base64_encode($pass).sha1($salt));
	    return $s;
	}

?> 