import { create_modal_window } from './modalwin.js';
$(document).ready(function(){

	$("#L_profile_sett").on("click", function()
    {
    	showmyprofile();
    });

	function showmyprofile() {
		hideall();

		var added_item = document.getElementById('R_profile_box');
		added_item.style.display = 'block';
		opaсAnimating(added_item, 100 ,"show");
	}

	$("#Rpb_change_password").on("click", function()
    {
    	hideall();
		var added_item = document.getElementById('R_profile_changepass_box');
		added_item.style.display = 'block';
		opaсAnimating(added_item, 100 ,"show");
    });

	$("#Rpb_confirm").on("click", function()
    {   var searchParams = getUrlParams(window.location.search);
		var langT = searchParams[0]["lang"];
    	$.ajax({
            url:"../php/reconfirmemail.php",
            type:"POST",
            data:({	data: "reconfirm",
					lang: langT }),
            dataType:"text",
            success: func_success_reconfirm
        });
    });

	function func_success_reconfirm(data){
		data = JSON.parse(data);
        if(data == "php1")
        {
			create_modal_window("Oops, there was an identification error, please try to re-login to your account.", "/pages/identification.php");
		}
		else if(data == "php2")
        {
			Toast.add({
				text: 'You have recently sent a confirmation to your email, please try again later.',
				color: '#852809', autohide: true, delay: 8000 });
		}
		else if(data == "mailerr")
        {
			Toast.add({
				text: 'Unfortunately, for some reason, an error occurred while sending a message to your email address.',
				color: '#852809', autohide: true, delay: 8000 });
		}
		else if(data == "phpOK")
        {
			// create_modal_window("Congratulations, an email has been sent to the email address you provided with a link to verify this email address in your account.", "/");
			Toast.add({
				text: 'Congratulations, an email has been sent to the email address you provided with a link to verify this email address in your account.',
				color: '#0b8509', autohide: true, delay: 8000 });
		}
	}
//-------------------------------------------------------------------CHANGE EMAIL-----------------
	$("#Rpb_change_email").on("click", function()
    {
    	hideall();
		var added_item = document.getElementById('R_profile_changeemail_box');
		added_item.style.display = 'block';
		opaсAnimating(added_item, 100 ,"show");
    });


	function rfc_btn_unlock (pos)
	{	
		if(pos == 'none'){
		document.getElementById('Rfc_submit_btn_p').innerHTML = "Wait some seconds...";
		var container = document.getElementById('Rfc_submit_btn');
		container.style.pointerEvents = 'none';
		}else if(pos == 'auto')
		{
			document.getElementById('Rfc_submit_btn_p').innerHTML = "CHANGE EMAIL";
			var container = document.getElementById('Rfc_submit_btn');
			container.style.pointerEvents = 'auto';
		}
	}
	function validateEmail(email) 
	{
	    var pattern  = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return pattern .test(String(email).toLowerCase());
	}

	$("#Rfc_submit_btn").on("click", function()
    {
		var password = (document.getElementById('Rfc_pass_text').value);
		var newemail = (document.getElementById('Rfc_newemail_text').value).toLowerCase();
		var renewmail = (document.getElementById('Rfc_renewemail_text').value).toLowerCase();
		var error = "";
		if(password.length < 5 || password.length > 25){
			error = "1";
			warning_message("#rpw", "Your password must be in length more than 6 and smaller than 25 symbols.");
		}
		else if(newemail == "" || !validateEmail(newemail) || newemail.length > 75){
			error = "2";
			warning_message("#rnw", "Your email must be real and in length smaller than 75 symbols.");
		}
		else if(renewmail != newemail){
			error = "3";
			warning_message("#rrw", "Your email's must be the same.");
		}
		if(error == "")
		{
			warning_message_clear();
			var searchParams = getUrlParams(window.location.search);
			changeemail(password, newemail, renewmail, searchParams[0]["lang"]);
			rfc_btn_unlock ('none');
		}
    });

	function changeemail(passwordT, newemailT, renewmailT, langT) {
		$.ajax({
            url:"../php/changeemail.php",
            type:"POST",
            data:({	password: passwordT,
					newemail: newemailT,
					renewmail: renewmailT,
					lang: langT}),
            dataType:"text",
            success: func_success_cem,
            complete: func_complete_cem
        });
	}

	function func_success_cem(data){
        data = JSON.parse(data);

		rfc_btn_unlock ('auto');

		var searchParams = getUrlParams(window.location.search);

        if(data == "php1"){
        	warning_message("#rpw", "Your password must be in length more than 6 and smaller than 25 symbols.");
		}else if(data == "php1.1"){
        	warning_message("#rpw", "The entered password is incorrect.");
        }else if(data == "php2"){
        	warning_message("#rnw", "Your email must be real and in length smaller than 75 symbols.");
        }else if(data == "php3"){
        	warning_message("#rrw", "Your email's must be the same.");
        }else if(data == "php4"){
            document.getElementById('Rfc_pass_text').value = "";
            document.getElementById('Rfc_newemail_text').value = "";
            document.getElementById('Rfc_renewemail_text').value = "";			
			Toast.add({
				text: 'Unfortunately, you have already tried change or changed your email in the last 24 hours, please try again later.',
				color: '#852809', autohide: true, delay: 8000 });
		}else if(data == "php5"){
            document.getElementById('Rfc_pass_text').value = "";
            document.getElementById('Rfc_newemail_text').value = "";
            document.getElementById('Rfc_renewemail_text').value = "";		
			Toast.add({
				text: 'Unfortunately, we cannot change your email, as this email address is already registered in your account.',
				color: '#852809', autohide: true, delay: 8000 });
		}else if(data == "mailerr"){
            document.getElementById('Rfc_pass_text').value = "";
            document.getElementById('Rfc_newemail_text').value = "";
            document.getElementById('Rfc_renewemail_text').value = "";	
			Toast.add({
				text: 'Sorry, there was an error while sending instructions to your new email, please try again later or contact support.',
				color: '#852809', autohide: true, delay: 8000 });
        }else if(data == "phpOK"){
            document.getElementById('Rfc_pass_text').value = "";
            document.getElementById('Rfc_newemail_text').value = "";
            document.getElementById('Rfc_renewemail_text').value = "";
        	create_modal_window("Congratulations, we have successfully sent you instructions to your new mail, check your email!", "/"+"?lang"+"="+searchParams[0]["lang"]);
        }
    }

    function func_complete_cem(){
        
    }

//-------------------------------------------------------------------CHANGE PASSWORD-----------------
	function rpc_btn_unlock (pos)
	{	
		if(pos == 'none'){
		document.getElementById('Rpc_submit_btn_p').innerHTML = "Wait some seconds...";
		var container = document.getElementById('Rpc_submit_btn');
		container.style.pointerEvents = 'none';
		}else if(pos == 'auto')
		{
			document.getElementById('Rpc_submit_btn_p').innerHTML = "CHANGE PASSWORD";
			var container = document.getElementById('Rpc_submit_btn');
			container.style.pointerEvents = 'auto';
		}
	}
	$("#Rpc_submit_btn").on("click", function()
    {
		var oldpassword = (document.getElementById('Rpc_oldpass_text').value);
		var newpassword = (document.getElementById('Rpc_newpass_text').value).toLowerCase();
		var renewpassword = (document.getElementById('Rpc_newrepass_text').value).toLowerCase();
		var error = "";
		if(oldpassword.length < 5 || oldpassword.length > 25){
			error = "1";
			warning_message("#row", "Your password must be in length more than 6 and smaller than 25 symbols.");
		}
		else if(newpassword.length < 5 || newpassword.length > 25){
			error = "2";
			warning_message("#rnew", "Your new password must be in length more than 6 and smaller than 25 symbols.");
		}
		else if(newpassword == oldpassword){
			error = "2.1";
			warning_message("#rnew", "Your new password must not be the same as your old one.");
		}
		else if(renewpassword != newpassword){
			error = "3";
			warning_message("#rrew", "Your password's must be the same.");
		}
		if(error == "")
		{
			warning_message_clear();
			changepass(oldpassword, newpassword, renewpassword);
			rpc_btn_unlock ('none');
		}
    });

	function changepass(oldpasswordT, newpasswordT, renewpasswordT) {
		$.ajax({
            url:"../php/changepass.php",
            type:"POST",
            data:({	oldpassword: oldpasswordT,
					newpassword: newpasswordT,
					renewpassword: renewpasswordT}),
            dataType:"text",
            success: func_success_cep,
            complete: func_complete_cep
        });
	}
	function func_success_cep(data){
        data = JSON.parse(data);

		rpc_btn_unlock ('auto');

		var searchParams = getUrlParams(window.location.search);

        if(data == "php1"){
        	warning_message("#row", "Your password must be in length more than 6 and smaller than 25 symbols.");
		}else if(data == "php1.1"){
        	warning_message("#row", "The entered password is incorrect.");
        }else if(data == "php2"){
        	warning_message("#rnew", "Your new password must be in length more than 6 and smaller than 25 symbols.");
		}else if(data == "php2.1"){
        	warning_message("#rnew", "Your new password must not be the same as your old one.");
        }else if(data == "php3"){
        	warning_message("#rrew", "Your password's must be the same.");
		}else if(data == "php4"){
            document.getElementById('Rpc_oldpass_text').value = "";
            document.getElementById('Rpc_newpass_text').value = "";
            document.getElementById('Rpc_newrepass_text').value = "";
			Toast.add({
				text: 'Unfortunately, you have already changed your password in the last 5 minutes, please try again later.',
				color: '#852809', autohide: true, delay: 8000 });
        }else if(data == "phpOK"){
            document.getElementById('Rpc_oldpass_text').value = "";
            document.getElementById('Rpc_newpass_text').value = "";
            document.getElementById('Rpc_newrepass_text').value = "";
        	create_modal_window("Congratulations, you have successfully changed your password, please log into your account using your new password.", "/"+"?lang"+"="+searchParams[0]["lang"]);
        }
    }

	function func_complete_cep(){
        
    }
//-----------------------------------------------------------------------------------------------------------
	$("#L_purchases").on("click", function()
    {
    	showmypurch();
    });

	function showmypurch() {
		hideall();
		var added_item = document.getElementById('R_my_purch_box');
		added_item.style.display = 'block';
		opaсAnimating(added_item, 100 ,"show");
	}

	$("#L_signout").on("click", function()
    {
		var searchParams = getUrlParams(window.location.search);
    	document.location.replace("/pages/identification"+"?lang"+"="+searchParams[0]["lang"]);
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


	function hideall() {
		var added_item = document.getElementById('R_profile_box');
		added_item.style.display = 'none';

		var added_item = document.getElementById('R_my_purch_box');
		added_item.style.display = 'none';

		var added_item = document.getElementById('R_profile_changepass_box');
		added_item.style.display = 'none';

		var added_item = document.getElementById('R_profile_changeemail_box');
		added_item.style.display = 'none';	
	}



	//--------------------------------------------------------warning_message
    function warning_message(id, text){
		warning_message_clear();
        var $elem = document.querySelector(id);
  		$elem.textContent = text;
  		$elem.style.display = 'block';
    }
    function warning_message_clear()
    {
		var massid = ["#rpw","#rnw","#rrw","#row","#rnew","#rrew"];
		massid.forEach(function(id)
		{	
			var $elem = document.querySelector(id);
			if($elem.style.display != 'none')
			{
				$elem.style.display = 'none';
			}
		});
    }
});