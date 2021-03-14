$(document).ready(function(){

	$("#L_profile_sett").on("click", function()
    {
    	showmyprofile();
    });

	function showmyprofile() {
		var added_item = document.getElementById('R_my_purch_box');
		added_item.style.display = 'none';

		var added_item = document.getElementById('R_profile_box');
		added_item.style.display = 'block';
	}

	$("#L_purchases").on("click", function()
    {
    	showmypurch();
    });

	function showmypurch() {
		var added_item = document.getElementById('R_profile_box');
		added_item.style.display = 'none';

		var added_item = document.getElementById('R_my_purch_box');
		added_item.style.display = 'block';
	}

	$("#L_signout").on("click", function()
    {
    	document.location.replace("/pages/identification.php");
    });

	$(".ser_num").on("click", function(event)
    {
    	copykey(event.target);
    });

	function copykey(el) {
		var $tmp = $("<textarea>");
		$("body").append($tmp);
		$tmp.val($(el).text()).select();
		document.execCommand("copy");
		$tmp.remove();
	}

});