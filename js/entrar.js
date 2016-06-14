$( document ).ready(function(){
	
	var def="black";
	var Alerta = 
	{	
		showAlert: function(color){
			$( "#notification" ).removeClass(def);
			$( "#notification" ).addClass(color);
			def=color;
			$( "#notification" ).fadeIn( "slow" );
			$(".win8-notif-button").click(function(){
			$(".notification").fadeOut("slow");
			});
		}
	}
	
	var Alerta2 = Alerta;
	
	Alerta2.showAlert('green');
	
});