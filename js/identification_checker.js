import { create_modal_window } from './modalwin.js';
$(document).ready(function(){
	$("#Auth_submit_btn").on("click", function()
    {
    	var login = (document.getElementById('Auth_login_text').value).toLowerCase();
		var password = (document.getElementById('Auth_password_text').value);
		var error = "";
		if(login.length < 5 || login.length > 25)
		{
			error = "1";
			warning_message("#alw", "Your login must be in length more than 4 and smaller than 25 symbols.");
		}
		else if(password == "" || password.length < 7 || password.length > 25)
		{
			error = "2";
			warning_message("#apw", "Your password must be in length more than 6 and smaller than 25 symbols.");
		}
		if(error == "")
		{
			warning_message_clear();
			authorization(login, password);
			auth_btn_unlock ('none');
		}
    });

	function auth_btn_unlock (pos)
	{	
		if(pos == 'none'){
		document.getElementById('Auth_submit_btn_p').innerHTML = "Wait some seconds...";
		var container = document.getElementById('Auth_submit_btn');
		container.style.pointerEvents = 'none';
		}else if(pos == 'auto')
		{
			document.getElementById('Auth_submit_btn_p').innerHTML = "SIGN IN";
			var container = document.getElementById('Auth_submit_btn');
			container.style.pointerEvents = 'auto';
		}
	}

	function authorization(loginT, passwordT) {
		$.ajax({
            url:"../php/authorization.php",
            type:"POST",
            data:({	login: loginT,
            		password: passwordT}),
            dataType:"text",
            success: func_success_auth,
            complete: func_complete_auth
        });
	}
	
	function func_success_auth(data){
        data = JSON.parse(data);
        if(data == "php1")
        {
        	warning_message("#alw", "Your login must be in length more than 4 and smaller than 25 symbols.");
        }else if(data == "php1.1"){
        	warning_message("#alw", "This login does not exist.");
        }else if(data == "php2"){
        	warning_message("#apw", "Your password must be in length more than 6 and smaller than 25 symbols.");
        }else if(data == "php2.1"){
        	warning_message("#apw", "Incorrect password.");
        }else if(data == "phpOK"){
            document.getElementById('Auth_login_text').value = "";
            document.getElementById('Auth_password_text').value = "";
			auth_btn_unlock ('auto');
			var searchParams = getUrlParams(window.location.search);
            location.href = "/"+"?lang"+"="+searchParams[0]["lang"];
        }
		auth_btn_unlock ('auto');
    }

    function func_complete_auth(){
        
    }

	function validateEmail(email) 
	{
	    var pattern  = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return pattern .test(String(email).toLowerCase());
	}

	function forget_btn_unlock (pos)
	{	
		if(pos == 'none'){
		document.getElementById('Forget_submit_btn_p').innerHTML = "Wait some seconds...";
		var container = document.getElementById('Forget_submit_btn');
		container.style.pointerEvents = 'none';
		}else if(pos == 'auto')
		{
			document.getElementById('Forget_submit_btn_p').innerHTML = "SEND PASSWORD";
			var container = document.getElementById('Forget_submit_btn');
			container.style.pointerEvents = 'auto';
		}
	}

	$("#Forget_submit_btn").on("click", function()
    {
		var email = (document.getElementById('Forget_email_text').value).toLowerCase();
		var error = "";
		if(email == "" || !validateEmail(email) || email.length > 75){
			error = "2";
			warning_message("#flw", "Your email must be real and in length smaller than 75 symbols.");
		}
		if(error == "")
		{
			warning_message_clear();
			var searchParams = getUrlParams(window.location.search);
			forgetpass(email, searchParams[0]["lang"]);
			forget_btn_unlock ('none');
		}
	});

	function forgetpass(emailT, langT) {
		$.ajax({
            url:"../php/forgetpass.php",
            type:"POST",
            data:({	email: emailT,
					lang: langT,}),
            dataType:"text",
            success: func_success_forget,
            complete: func_complete_forget
        });
	}

	function func_success_forget(data){
        data = JSON.parse(data);
		var searchParams = getUrlParams(window.location.search);
        if(data == "php1")
        {
        	warning_message("#flw", "Your email must be real and in length smaller than 75 symbols.");
        }
		else if(data == "php2")
		{
        	warning_message("#flw", "Account with this email did not find.");
        }
		else if(data == "php3")
		{
        	warning_message("#flw", "On this email has been recently sent a password recovery request, please try again later.");
        }
		else if(data == "mailerr")
		{
			document.getElementById('Forget_email_text').value = "";
			create_modal_window("Sorry, but unfortunately there was some error when sending a password recovery message to the specified email, please try again or contact support.", "/"+"?lang"+"="+searchParams[0]["lang"]);
        }
		else if(data == "phpOK")
		{
			document.getElementById('Forget_email_text').value = "";
			create_modal_window("A message was sent to the specified email with instructions on how to restore access to your account.", "/"+"?lang"+"="+searchParams[0]["lang"]);
        }
		forget_btn_unlock ('auto');
    }

    function func_complete_forget(){
        
    }

	function reg_btn_unlock (pos)
	{	
		if(pos == 'none'){
		document.getElementById('Reg_submit_btn_p').innerHTML = "Wait some seconds...";
		var container = document.getElementById('Reg_submit_btn');
		container.style.pointerEvents = 'none';
		}else if(pos == 'auto')
		{
			document.getElementById('Reg_submit_btn_p').innerHTML = "SEND PASSWORD";
			var container = document.getElementById('Reg_submit_btn');
			container.style.pointerEvents = 'auto';
		}
	}


	$("#Reg_submit_btn").on("click", function()
    {
		var login = (document.getElementById('Reg_login_text').value).toLowerCase();
		var email = (document.getElementById('Reg_email_text').value).toLowerCase();
		var password = (document.getElementById('Reg_password_text').value);
		var repassword = (document.getElementById('Reg_repassword_text').value);
		var error = "";
		if(login.length < 5 || login.length > 25){
			error = "1";
			warning_message("#rlw", "Your login must be in length more than 4 and smaller than 25 symbols.");
		}
		else if(email == "" || !validateEmail(email) || email.length > 75){
			error = "2";
			warning_message("#rew", "Your email must be real and in length smaller than 75 symbols.");
		}
		else if(password == "" || password.length < 7 || password.length > 25){
			error = "3";
			warning_message("#rpw", "Your password must be in length more than 6 and smaller than 25 symbols.");
		}
		else if(repassword == "" || repassword != password){
			error = "4";
			warning_message("#rrw", "This password is not the same as the previous one.");
		}
		if(error == "")
		{
			warning_message_clear();
			var searchParams = getUrlParams(window.location.search);
			registration(login, email, password, repassword, searchParams[0]["lang"]);
			reg_btn_unlock ('none');
		}
    });

    function registration(loginT, emailT, passwordT, repasswordT) {
		$.ajax({
            url:"../php/registration.php",
            type:"POST",
            data:({	login: loginT,
            		email: emailT,
            		password: passwordT,
            		repassword: repasswordT,
            		lang: langT}),
            dataType:"text",
            success: func_success_reg,
            complete: func_complete_reg
        });
	}

	function func_success_reg(data){
        data = JSON.parse(data);
		var searchParams = getUrlParams(window.location.search);
        if(data == "php1")
        {
        	warning_message("#rlw", "Your login must be in length more than 4 and smaller than 25 symbols.");
        }else if(data == "php1.1"){
        	warning_message("#rlw", "This username is already registered.");
        }else if(data == "php2"){
        	warning_message("#rew", "Your email must be real and in length smaller than 75 symbols.");
        }else if(data == "php2.1"){
        	warning_message("#rew", "This email is already registered.");
        }else if(data == "php3"){
        	warning_message("#rpw", "Your password must be in length more than 6 and smaller than 25 symbols.");
        }else if(data == "php4"){
        	warning_message("#rrw", "This password is not the same as the previous one.");
        }else if(data == "mailerr"){
            document.getElementById('Reg_login_text').value = "";
            document.getElementById('Reg_email_text').value = "";
            document.getElementById('Reg_password_text').value = "";
            document.getElementById('Reg_repassword_text').value = "";
            create_modal_window("Congratulations, you have successfully registered! But for some reason, an error occurred when sending a message to the email address you provided, we strongly recommend contacting support! Thank you for understanding!", "/"+"?lang"+"="+searchParams[0]["lang"]);
        }else if(data == "phpOK"){
            document.getElementById('Reg_login_text').value = "";
            document.getElementById('Reg_email_text').value = "";
            document.getElementById('Reg_password_text').value = "";
            document.getElementById('Reg_repassword_text').value = "";
        	create_modal_window("Congratulations, you have successfully registered! An email has been sent to the email address you provided with a link to verify this email address in your account.", "/"+"?lang"+"="+searchParams[0]["lang"]);
        }
		reg_btn_unlock ('auto');
    }

    function func_complete_reg(){
        
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
		var massid = ["#alw","#apw","#rlw","#rew","#rpw","#rrw","#flw"];
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