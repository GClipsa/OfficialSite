import { create_modal_window } from './modalwin.js';
$(document).ready(function(){

    function reset_btn_unlock (pos)
	{	
		if(pos == 'none'){
		document.getElementById('Reset_submit_btn_p').innerHTML = "Wait some seconds...";
		var container = document.getElementById('Reset_submit_btn');
		container.style.pointerEvents = 'none';
		}else if(pos == 'auto')
		{
			document.getElementById('Reset_submit_btn_p').innerHTML = "CHANGE PASSWORD";
			var container = document.getElementById('Reset_submit_btn');
			container.style.pointerEvents = 'auto';
		}
	}

    $("#Reset_submit_btn").on("click", function()
    {
        var code = (document.getElementById('Reset_code_text').value);
    	var password = (document.getElementById('Reset_pass_text').value);
		var repassword = (document.getElementById('Reset_repass_text').value);

		var error = "";
		if(code.length != 15)
		{
			error = "1";
			warning_message("#rcw", "Incorrect code.");
		}
		else if(password == "" || password.length < 7 || password.length > 25)
		{
			error = "2";
			warning_message("#rpw", "Your password must be in length more than 6 and smaller than 25 symbols.");
		}
        else if(repassword == "" || repassword != password)
		{
			error = "2";
			warning_message("#rrw", "This password is not the same as the previous one.");
		}
		if(error == "")
		{
			warning_message_clear();
			resetpass(code, password, repassword);
			reset_btn_unlock ('none');
		}
    });

    function resetpass(codeT, passwordT, repasswordT) {
		$.ajax({
            url:"../php/resetpass.php",
            type:"POST",
            data:({	code: codeT,
            		password: passwordT,
            		repassword: repasswordT}),
            dataType:"text",
            success: func_success_reset,
            complete: func_complete_reset
        });
	}
    function func_success_reset(data){
		var searchParams = getUrlParams(window.location.search);
        data = JSON.parse(data);
        if(data == "php1"){
            document.getElementById('Reset_code_text').value = "";
            document.getElementById('Reset_pass_text').value = "";
            document.getElementById('Reset_repass_text').value = "";
        	create_modal_window("Unfortunately, your code turned out to be incorrect and we did not reset or change your password.", "/"+"?lang="+searchParams[0]["lang"]);
        }else if(data == "php2"){
        	warning_message("#rpw", "Your password must be in length more than 6 and smaller than 25 symbols.");
        }else if(data == "php3"){
        	warning_message("#rrw", "This password is not the same as the previous one.");
        }else if(data == "phpOK"){
            document.getElementById('Reset_code_text').value = "";
            document.getElementById('Reset_pass_text').value = "";
            document.getElementById('Reset_repass_text').value = "";
        	create_modal_window("Congratulations, you have successfully changed the password on your account!", "/pages/identification"+"?lang="+searchParams[0]["lang"]);
        }
		reset_btn_unlock ('auto');
    }

    function func_complete_reset(){
        
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
		var massid = ["#rcw","#rpw","#rrw"];
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