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
            var infobox = document.getElementById('Allprograms_double_info_box');
            infobox.remove();
            func_upnews(data[i]['picture'], data[i]['description'], data[i]['link']);
            infobox = document.getElementById('Allprograms_double_info_box');
            opaсAnimating(infobox, 100, "show");
        }    
    }

    function func_complete_right(){
        
    }
    var searchParams = getUrlParams(window.location.search);
    if(searchParams[0]["lang"]!=undefined)
    {
        function func_upnews(pic, desc, link){
            var code = '<div class="allprograms_double_info_box" id="Allprograms_double_info_box">\
                            <div class="info_pic">\
                                <img class="info_pic_img" src="'+pic+'" alt="'+pic+'">\
                            </div>\
                            <div class="info_text">\
                                <p class="info_text_p">'+desc+'</p>\
                            </div>\
                            <a href="'+link+"&lang"+"="+searchParams[0]["lang"]+'"><div class="info_button">\
                                <p class="info_button_text">GO TO PAGE</p>\
                            </div></a>\
                        </div>';
            $('.allprograms_box_info').append(code);
        }
    }
    else
    {
        function func_upnews(pic, desc, link){
            var code = '<div class="allprograms_double_info_box" id="Allprograms_double_info_box">\
                            <div class="info_pic">\
                                <img class="info_pic_img" src="'+pic+'" alt="'+pic+'">\
                            </div>\
                            <div class="info_text">\
                                <p class="info_text_p">'+desc+'</p>\
                            </div>\
                            <a href="'+link+"&lang=en"+'"><div class="info_button">\
                                <p class="info_button_text">GO TO PAGE</p>\
                            </div></a>\
                        </div>';
            $('.allprograms_box_info').append(code);
        }
    }
});