<?php


class Proses extends Controller{

	public function __construct(){
		parent::__construct();
	}

	public function fetchAccountData(){
		if ($this->post('key') == cryptText('getAccountData')) {
			$dataUser = $this->model->get_all_account_data('user',$this->post('username'));
			$dataUser[0]['password'] = 'protected';
			
			echo json_encode($dataUser[0]);
		}
		else{
			echo "Not Allowed";
		}
	}

}

?>