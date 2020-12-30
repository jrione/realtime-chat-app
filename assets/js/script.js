var t = $(window).height() * 8.75/10;
$(".card").css({'height':t})
$("#data,#data-contact").css({'height':t-130})

var base_url = (path) =>{
	return document.URL + path;
}

var agentUser = () =>{
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		$("#toggle-sidebar").attr('onclick','bar()');
		$("#contact").css({height: '-525px'})
		return "TEST"
	}
	else{
		$("")
	}
}
agentUser();	


var contactBar = document.getElementById('contact');
var sideBar = () =>{
	if (contactBar.style.left == '-441px' ) {
		$("#contact,#chat-box").animate({left:"0"},700)
	}
	else{
		$("#contact").animate({left:"-441px"},700)
		$("#chat-box").animate({left:"-220px"},700)
	}
}

var bar = () =>{
	tt = t+15
	if (contactBar.style.height > '0px' ) {
		$("#contact").animate({height: '-525px'},700)
	}
	else{
		$("#contact").animate({height: '525px'},700)
	}
}

// var se = setInterval(function (){
// 	$('#chat-list').load(base_url('game/pro')).show();
// }, 100);

var she = document.getElementById('data').scrollHeight;
$('#data').animate({scrollTop: she+'px'},0);