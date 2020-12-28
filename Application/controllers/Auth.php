<?php

class Auth extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function register(){
		if (!$this->post('name') OR !$this->post('password') OR !$this->post('username')) {
			echo json_encode(['error'=>'Masukkan data!']);
		}
		else{
			$data = [
						'name' => $this->post('name'),
						'username' => $this->post('username'),
						'password' => cryptText($this->post('password')),
					];
			if(strlen($data['name']) > 26){
				echo json_encode(['name_error'=>'Nama tidak lebih dari 25 huruf!']);
			}
			else{	
				$check_data = $this->model->show_data('user',['username' => $data['username']]);
				if ($check_data == 1) {
					echo json_encode(['reg_error'=>'Username telah terdaftar!']);
				}
				else{
					$this->model->register('user',$data);
					echo json_encode(['regis_success'=>'Berhasil mendaftar']);
				}
			}
		}
	}

	public function login(){
		if (!$this->post('username') OR !$this->post('password')) {
			echo json_encode(["error" => "Masukkan username dan password!"]);
		}
		else{
			$data = [
					 'username' => $this->post('username'),
					 'password' => cryptText($this->post('password'))
					];
			$check_data = $this->model->masuk('user',$data);
			if ($check_data === 1) {
				$this->session->set_userdata($data);
				echo json_encode(['success' => "Sukses, tunggu sebentar..."]); 
			}
			else{
				echo json_encode(['login_error' => "Username/Password salah!"]);
			}
		}
	}

	public function test(){
		$check_data = $this->model->show_data('user',['username' => 's']);
		var_dump($check_data);
	}
	public function logout(){
		$this->session->sess_destroy();	
		redirect(base_url());
	}

}