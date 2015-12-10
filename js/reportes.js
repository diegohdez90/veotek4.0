$(document).ready(function(){
	$("bitacora").hide(10);
	$(".trabajos").click(function(){
		$("#horario").css("display","none")
		$("#bitacora").slide();
	});

	$(".horas").click(function(){
		$("#bitacora").css("display","none")
		$("#horario").show();
	});
});