 <?php

class Session{
	public function __construct(){
		session_start();
	}

	public function set_userdata($data=array()){
		foreach ($data as $session_name => $data[]) {
			$session_name=htmlspecialchars($session_name);
			$_SESSION[$session_name] = $data[$session_name];
		}
	}

	public function userdata($data = NULL){
		if ($data != NULL) {
			return $_SESSION[$data];
		}
		else{
			return $_SESSION;
		}
	}

	public function sess_destroy(){
		session_destroy();
		session_unset();
	}
}