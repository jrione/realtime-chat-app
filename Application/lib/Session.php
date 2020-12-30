 <?php

class Session{
	public function __construct(){
		session_start();
	}

	public function set_userdata($data=array()){
		date_default_timezone_set("Asia/Jakarta");
		$duration = date_create();
		$time = date_format($duration,"H:i:s");
		$date = date_format($duration,"Ymd");
		$t = split(':', $time); //bisa diganti pake explode();


		$t[0] += 2; // session timeout 2 jam
		if ($t[0] <10) {
			$t[0] = sprintf('%02d',$t[0]);
		}
		if ($t[1] <10) {
			$t[1] = sprintf('%02d',$t[1]);
		}
		if ($t[2] <10) {
			$t[2] = sprintf('%02d',$t[2]);
		}

		$arr = [];

		array_push($arr, $t[0]); 
		array_push($arr, $t[1]);
		array_push($arr, $t[2]);
		$arrP = implode('', $arr);
		$_SESSION['sess_timeout'] = $arrP;
		$_SESSION['sess_dateout'] = $date;

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