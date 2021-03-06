$(document).ready(function(){

	$(".name_list_li").on("click", function()
    {
        var name = $(this).text();
        $.ajax({
            url:"../php/getsoftware_mysql.php",
            type:"POST",
            data:({program: name}),
            dataType:"text",
            success: func_success_right,
            complete: func_complete_right
        });
    });

    function func_success_right(data){
        data = JSON.parse(data);
        var i = 0;
        if(data[i]!=null)
        {
        	$('.allprograms_double_info_box').remove();
            func_upnews(data[i]['picture'], data[i]['description'], data[i]['link']);
        }    
    }

    function func_complete_right(){
        
    }

    function func_upnews(pic, desc, link){
        var code = '<div class="allprograms_double_info_box">\
						<div class="info_pic">\
							<img class="info_pic_img" src="'+pic+'" alt="'+pic+'">\
						</div>\
						<div class="info_text">\
							<p class="info_text_p">'+desc+'</p>\
						</div>\
						<a href="'+link+'"><div class="info_button">\
							<p class="info_button_text">GO TO PAGE</p>\
						</div></a>\
					</div>';
        $('.allprograms_box_info').append(code);
    }

});