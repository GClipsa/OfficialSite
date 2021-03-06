$(document).ready(function(){
		var pik = 0;
		$('.tp_burg-lines').click(function(e){
		document.getElementById('Rp_menu-burg').style.opacity=0.95;
		$(this).toggleClass('tp_burg-lines-active');
		$('.rp_menu-burg').toggleClass('rp_menu-burg-active');
		if(pik == 0)
		{$('body').css('overflow', 'hidden');pik = 1;}
		else{$('body').css('overflow', 'auto');pik = 0;}
	});
	$('.mob_dropdown').css('display' , 'none');
	$(".mob_sofware_li").on("click", function()
    {
    	if($('.mob_dropdown').get(0).style.display == "none")
    	{
			$('.mob_dropdown').css('display' , 'block');
    	}
    	else{
			$('.mob_dropdown').css('display' , 'none');
    	}
    	

    });

});

window.onload = function(){
	var x = window.matchMedia("(min-width: 1200px)")
	var d = document.getElementsByClassName('tp_burg-lines');
	myFunction(x); // Вызов функции прослушивателя во время выполнения
	x.addListener(myFunction);// Присоединить функцию прослушивателя при изменении состояния
	function myFunction(x){
		if (x.matches && $('.tp_burg-lines').hasClass('tp_burg-lines-active')) { // Если медиа запрос совпадает
			$(".tp_burg-lines").click();		
			document.getElementById('Rp_menu-burg').style.opacity=0;
		} 
	}
};