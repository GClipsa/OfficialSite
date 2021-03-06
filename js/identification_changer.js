$(document).ready(function(){

	$("#Auth").on("click", function()
    {
    	showauthpanel();
    });

	function showauthpanel() {
		var added_item = document.getElementById('Panel_choose');
		added_item.style.display = 'none';

		var added_item = document.getElementById('Auth_panel');
		added_item.style.display = 'block';
	}

	$("#Reg").on("click", function()
    {
    	showregpanel();
    });

	function showregpanel() {
		var added_item = document.getElementById('Panel_choose');
		added_item.style.display = 'none';

		var added_item = document.getElementById('Reg_panel');
		added_item.style.display = 'block';
	}

	$("#Auth_text_pic").on("click", function()
    {
    	showchoose();
    });

	function showchoose() {
		var added_item = document.getElementById('Auth_panel');
		added_item.style.display = 'none';
		var added_item = document.getElementById('Reg_panel');
		added_item.style.display = 'none';

		var added_item = document.getElementById('Panel_choose');
		added_item.style.display = 'block';
	}

	$("#Reg_text_pic").on("click", function()
    {
    	showchoose();
    });
});