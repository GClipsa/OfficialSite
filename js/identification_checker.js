import { create_modal_window } from './modalwin.js';
$(document).ready(function(){
	$("#Auth_submit_btn").on("click", function()
    {
    	var login = (document.getElementById('Auth_login_text').value).toLowerCase();
		var password = (document.getElementById('Auth_password_text').value).toLowerCase();
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
		}
    });

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
            location.href = "/";
        }else{alert(data);}
    }

    function func_complete_auth(){
        
    }

	function validateEmail(email) 
	{
	    var pattern  = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return pattern .test(String(email).toLowerCase());
	}

	$("#Reg_submit_btn").on("click", function()
    {
		var login = (document.getElementById('Reg_login_text').value).toLowerCase();
		var email = (document.getElementById('Reg_email_text').value).toLowerCase();
		var password = (document.getElementById('Reg_password_text').value).toLowerCase();
		var repassword = (document.getElementById('Reg_repassword_text').value).toLowerCase();
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
			registration(login, email, password, repassword);
		}
    });

    function registration(loginT, emailT, passwordT, repasswordT) {
		$.ajax({
            url:"../php/registration.php",
            type:"POST",
            data:({	login: loginT,
            		email: emailT,
            		password: passwordT,
            		repassword: repasswordT}),
            dataType:"text",
            success: func_success_reg,
            complete: func_complete_reg
        });
	}

	function func_success_reg(data){
        data = JSON.parse(data);
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
            create_modal_window("Congratulations, you have successfully registered! But for some reason, an error occurred when sending a message to the email address you provided, we strongly recommend contacting support! Thank you for understanding!", "/");
        }else if(data == "phpOK"){
            document.getElementById('Reg_login_text').value = "";
            document.getElementById('Reg_email_text').value = "";
            document.getElementById('Reg_password_text').value = "";
            document.getElementById('Reg_repassword_text').value = "";
        	create_modal_window("Congratulations, you have successfully registered! An email has been sent to the email address you provided with a link to verify this email address in your account.", "/");
        }
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
		var massid = ["#alw","#apw","#rlw","#rew","#rpw","#rrw"];
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