<?php


class Proses extends Controller{

	public function __construct(){
		parent::__construct();
	}

	public function fetchAccountData(){
		if ($this->post('key') == cryptText('getAccountData')) {
			$dataUser = $this->model->get_all_account_data('user',$this->post('username'));
			if ($dataUser == array()) {
				echo json_encode(["null_user" => "Tidak ada kontak"]);
			}
			else{
				$dataUser[0]['password'] = 'protected';
				unset($dataUser[0]['password']);
				echo json_encode(["contactCount" => $dataUser]);
			}
		}
		else{
			echo "Not Allowed";
		}
	}

	public function sessionTimeOut(){
		if ($this->post('key') == cryptText('getTimeoutInfo')) {
			date_default_timezone_set("Asia/Jakarta");
			$duration = date_create();
			$time = date_format($duration,"His");
			$date = date_format($duration,'Ymd');
			$t = $date.$time;
			$timeout= $this->session->userdata('sess_dateout').$this->session->userdata('sess_timeout');
			
			if ($t > $timeout) {
				$this->session->sess_destroy();
				echo json_encode(['timeout' => 'session expired, silahkan login ulang']);
			}
			else{
				echo json_encode(['login' => 'true']);
			}
		}
		else{
			echo json_encode(['err_key' => 'Not Allowed']);
			echo "<script>window.location.href='".base_url()."'</script>";
			$this->sess_destroy();
		}
	}

}

?>