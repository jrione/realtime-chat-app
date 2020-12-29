	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.css')?>">
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css')?>">
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/main.css')?>">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->	
		<script type="text/javascript" src="<?= base_url('assets/js/jquery.js') ?>"></script>
		<!-- <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script> -->
	</head>
	<?php
		if ($this->session->userdata() == array()) {
	?>
		<body class="bg-dark">
			<div class="container-fluid pt-4">
				<div id="login-register" class="row bg-white m-4 pb-4" style="border-radius: 20px;">
					<div id="login-1" class="col-sm-7 mt-4 justify-content-center">					
						<img id="img-login" class="mt-4 " draggable="false" src="<?= base_url('img/img_login.jpg')?>">
					</div>
					<div id="login-form" class="col-sm-5 mt-4 pt-4">
				      <div class="modal-header text-center">
				        <h4 id="modal_title" class="modal-title w-100 font-weight-bold">Silahkan Masuk</h4>
				      </div>
				        <div class="modal-body mx-3">
				          <div class="md-form mb-4">
				            <input type="text" id="username-login" class="form-control validate" required="">
				            <label data-error="wrong" data-success="right" for="username"><p style="color: #ced4da; float: left;"><b>╰</b></p>Username</label>
				          </div>

				          <div class="md-form mb-4">
				            <input type="password" id="password-login" class="form-control validate" required="">
				            <label data-error="wrong" data-success="right" for="password"><p style="color: #ced4da; float: left;"><b>╰</b></p>Password</label>
				          </div>

				          <div class="md-form" >
				            <p id="info-login" style="display: none;"></p>
				            Tidak punya akun? 
				            <span>
				              <a id="daftar" style="cursor: pointer; color: #2B7279">Daftar</a>
				            </span>
				          </div>
				        </div>
				        <div class="modal-footer d-flex justify-content-center">
				          <button id="submit_login" class="btn " style="background-color: #2B7279; color:white;">Masuk</button>
				        </div>
					</div>
					<hr>
					<div id="register-form" class="col-sm-5 mt-4 pt-4">
				      <div class="modal-header text-center">
				        <h4 id="modal_title" class="modal-title w-100 font-weight-bold">Daftar</h4>
				      </div>
				        <div class="modal-body mx-3">
				          <div class="md-form mb-4">
				            <input type="text" id="nama_lengkap-daftar" class="form-control validate">
				            <label data-error="wrong" data-success="right" for="nama_lengkap"><p style="color: #ced4da; float: left;"><b>╰</b></p>Nama Lengkap</label>

				            <input type="text" id="username-daftar" class="form-control validate">
				            <label data-error="wrong" data-success="right" for="username"><p style="color: #ced4da; float: left;"><b>╰</b></p>Username</label>

				            <input type="password" id="password-daftar" class="form-control validate">
				            <label data-error="wrong" data-success="right" for="password"><p style="color: #ced4da; float: left;"><b>╰</b></p>Password</label>
				          </div>
				          <div class="md-form" >
				            <p id="info-register" style="display: none;"></p>
				              Sudah punya akun? 
				              <span>
				                <a id="masuk" style="cursor: pointer; color: #2B7279">Masuk</a>
				              </span>
				          </div>
				        </div>
				        <div class="modal-footer d-flex justify-content-center fa-3x">
				          <button id="submit_daftar" class="btn " style="background-color: #2B7279; color:white;">Daftar</button>
				        </div>
				    </div>
				</div>
			</div>
		</body>
		<script type="text/javascript">
			var infoRegis = document.getElementById('info-register');
			var infoLogin = document.getElementById('info-login');
			var t = document.createElement("title");
			document.head.appendChild(t);
			t.innerHTML = "Login";

			$("#register-form").hide();
			$("#daftar").click(function(){
				t.innerHTML = "Daftar";
				infoRegis.style.display = 'none';
				$("#login-form").slideUp(1000)
				$("#register-form").delay(1000).slideDown(1000);
			});
			$("#masuk").click(function(){
				t.innerHTML = "Login";
				infoLogin.style.display = 'none';
				$("#register-form").slideUp(1000)
				$("#login-form").delay(1000).slideDown(1000);
			});


			var ingfo = (info,typeErr,badgeColor) =>{
				info.style.display = 'block';
				info.setAttribute('class','badge badge-'+badgeColor);
				info.innerHTML = typeErr;
			}

			$("#submit_daftar").click(function(){
				$.post('<?= base_url('auth/register') ?>',
				{
					name: $("#nama_lengkap-daftar").val(),
					username:$("#username-daftar").val(),
					password:$("#password-daftar").val()
				},
				function(data){
					jsonData = JSON.parse(data);
					if (jsonData['error']) {
						ingfo(infoRegis,jsonData['error'],'danger');
					}
					else{
						if (jsonData['name_error']) {
							ingfo(infoRegis,jsonData['name_error'],'danger');
						}
						else{
							if (jsonData['reg_error']) {
								ingfo(infoRegis,jsonData['reg_error'],'danger');
							}
							else{
								ingfo(infoLogin,jsonData['regis_success'],'success');
								$("#register-form").slideUp(1000)
								$("#login-form").delay(1000).slideDown(1000);
							}

						}
					};
				});
			});

			$("#submit_login").click(function(){
				$.post('<?= base_url('auth/login') ?>',{
					username: $("#username-login").val(),
					password: $("#password-login").val()
				},
				function(data){
					jsonDataLogin = JSON.parse(data);
					if (jsonDataLogin['error']) {
						ingfo(infoLogin,jsonDataLogin['error'],'danger');
					}
					else{
						if (jsonDataLogin['login_error']) {
							ingfo(infoLogin,jsonDataLogin['login_error'],'danger');		
						}
						else{
							// ingfo(infoLogin,jsonDataLogin['success'],'success');	
							location.reload();
						}
					}
				});
			})
		</script>
	<?php			
		 }
		else{
			$personal_data = $this->session->userdata();
	?>
	<body class="bg-dark" style="overflow: hidden;">
		<div id="id-fluid" class="container-fluid">
			<div id="row-1st" class="row" >
				<div id="head" class="col-sm-12 ">
					<button id="toggle-sidebar" onclick="sideBar()" class="btn"><h1>☰</h1></button>
					<div id="profile" class="float-right pt-1 pr-2" style="cursor: pointer;">
						<img class="img-profile" src="<?= base_url($personal_data['u_img'])?>">
					</div>
				</div>
			</div>
			<div id="row-2nd" class="row">
				<div id="contact" class="col-sm-4">
					<div id="contact-card" class="card my-2">
						<div class="card-body">
							<h3 class="card-title text-center">Semua Kontak</h3>
							<hr>
							<div id="contact-list" class="card-text">
								<div id="contact-list-child" class="list row">
									<div class="list-img col-sm-2">
										<img class="img-profile" src="<?= base_url('img/sawah.jpg')?>">
									</div>
									<div class="list-name-and-chat col-sm-10">
										<div class="list-name row">
											<a><b>ABCDEFGHIJKLMNOPQRSTUVWXYZ</b></a>
										</div>
										<div class="list-chat row">
											ABCDEFGHIJKLMNOPQRSTUV...<div class="time badge">20.12</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="chat-box"  class="col-sm-8">
					<div class="card my-2">
						<div class="card-header bg-transparent">
							<h5 class="card-title text-left" style="margin:0">
								<img class="img-profile mr-2" src="<?= base_url('img/sawah.jpg')?>">
								NAMANYA	
							</h5>
						</div>
						<div class="card-body" style="padding:0">
							<!-- <iframe src="<?= base_url('game/pro') ?>" id="chat-iframe" title="W3Schools Free Online Web Tutorials"></iframe> -->
							<div id="data">
								<div id="chat-list" class="card-text mx-4 my-2">
									<div id="m-box" class="row justify-content-end d-flex">
										<div id="message" class="px-3 mb-4 py-2" style=" background-color:#54900f; border-radius: 15px 0px 15px 15px; width: auto;">
											<p style=" margin:0;">
												sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
											</p>
											<div class="time badge float-left">20.12</div>
										</div>
									</div>
									<div id="m-box" class="list row justify-content-start" >
										<div id="message" class="px-3 mb-4 py-2" style="border-radius: 0px 15px 15px 15px; width: auto;">
											<p style=" margin:0;">
													Lorem ipsum dolor sit amet, consectetur adipisicing elit.
											</p>
											<div class="time badge float-right">20.12</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="msg" class="card-footer bg-transparent pr-2" style="bottom: 0">
							<div class="row">
									<textarea id="m" name="Text1" style="position: relative;" cols="40" rows="1"></textarea>
									<button id="s" name="s"class="btn bg-transparent"><i class="fa fa-paper-plane"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		setInterval(function(){
			$.post('<?= base_url('proses/fetchAccountData') ?>',{
				key : '<?= cryptText('getAccountData')  ?>',
				username: '<?= $personal_data['username'] ?>'
			},
			function(data){
				var cl = document.getElementById('contact-list-child');
				jsonDataContact = JSON.parse(data);
				
				if (jsonDataContact['null_user']) {
					cl.innerHTML = jsonDataContact['null_user'];
					cl.setAttribute('class','list row justify-content-center');
				}
				else{
					cl.setAttribute('class','list row');
					var listImg = document.createElement("div");
					var listName = document.createElement("div");
					// cl.appendChild(listImg);
					$("#contact-list-child").html("");
				}
			});
		},700);
	</script>
	<script type="text/javascript">
		setInterval(function(){
				$.post('<?= base_url('proses/sessionTimeOut') ?>',{
				key :'<?= cryptText('getTimeoutInfo') ?>'
			},
			function(data){
				jsonDataTimeout = JSON.parse(data);
				if (jsonDataTimeout['timeout']) {
					location.reload();
				}
				else{

				}
			});
		},1000);
		</script>
	
    <script type="text/javascript" src="<?= base_url('assets/js/script.js') ?>"></script>
	<?php
		}
	?>
	</html>