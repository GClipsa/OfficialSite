$(document).ready(function(){
    var colvo = 6;
//--------------------------------------------------------------
    $("#Right_pic").on("click", function()
    {
        activate_de_pics(5);

        var page = parseInt($('#Start_num_page').text())+1;
        $.ajax({
            url:"../php/getnews_mysql.php",
            type:"POST",
            data:({number: page,
                    colvo: colvo}),
            dataType:"text",
            success: func_success_right,
            complete: func_complete_right
        });
    });
    $("#Left_pic").on("click", function()
    {
        activate_de_pics(4);

        if(parseInt($('#Start_num_page').text()) > 1)
        {
            var page = parseInt($('#Start_num_page').text())-1;
            $.ajax({
                url:"../php/getnews_mysql.php",
                type:"POST",
                data:({number: page,
                        colvo: colvo}),
                dataType:"text",
                success: func_success_left,
                complete: func_complete_left
            });         
        }
    });

    function func_success_right(data){
        data = JSON.parse(data);
        var i = 0;

        if($('div.familiar_box_item').length >= colvo)
        {
            $('#Start_num_page').text(parseInt($('#Start_num_page').text())+1);
            activate_de_pics(0);
        }
        if(data[i]!=null)
        {
            $('.familiar_box_item').remove();
        }
        while(data[i]!=null)
        {
            func_upnews(data[i]['picture'], data[i]['description'], data[i]['news']);
            i++;
        }
    }

    function func_success_left(data){
        data = JSON.parse(data);
        var i = 0;

        $('#Start_num_page').text(parseInt($('#Start_num_page').text())-1);
        if(data[i]!=null)
        {
            $('.familiar_box_item').remove();
            activate_de_pics(0);
        }
        while(data[i]!=null)
        {
            func_upnews(data[i]['picture'], data[i]['description'], data[i]['news']);
            i++;
        }
    }

    function pagetoup() 
    {
        $("html, body").animate({scrollTop: $(".top_panel").height()*0}, 600);
    };

    function func_complete_left(){
        if(parseInt($('#Start_num_page').text()) <= 1)
        {
            activate_de_pics(4);
        }
        var FamItembox = document.getElementById('Familiar_box_items');
        opaсAnimating(FamItembox, 100, "show");
        pagetoup();
    }
    function func_complete_right(){
        if(parseInt($('#Start_num_page').text()) >= parseInt($('#End_num_page').text()))
        {
            activate_de_pics(5);
        }
        var FamItembox = document.getElementById('Familiar_box_items');
        opaсAnimating(FamItembox, 100, "show");
        pagetoup();
    }

//--------------------------------------------------------------
    
    $("body").on('click', '.next_news', function()
    {
        activate_de_pics(3);
        var page = $('#End_num_page').text();
        $.ajax({
            url:"../php/getnews_mysql.php",
            type:"POST",
            data:({number: page,
                    colvo: colvo}),
            dataType:"text",
            success: func_success_next,
            complete: func_complete_next
        });         
    });

    function func_success_next(data){
        data = JSON.parse(data);
        var i = 0;

        $('#Start_num_page').text($('#End_num_page').text());
        if(data[i]!=null)
        {
            $('.familiar_box_item').remove();
            activate_de_pics(1);
        }
        while(data[i]!=null)
        {
            func_upnews(data[i]['picture'], data[i]['description'], data[i]['news']);
            i++;
        }
    }


    $("body").on('click', '.prev_news', function()
    {
        activate_de_pics(3);
        var page = 1;
        $.ajax({
            url:"../php/getnews_mysql.php",
            type:"POST",
            data:({number: page,
                    colvo: colvo}),
            dataType:"text",
            success: func_success_prev,
            complete: func_complete_prev
        });         
    });

    function func_success_prev(data){
        data = JSON.parse(data);
        var i = 0;

        $('#Start_num_page').text("1");
        if(data[i]!=null)
        {
            $('.familiar_box_item').remove();
            activate_de_pics(2);activate_de_pics(4);
        }
        while(data[i]!=null)
        {
            func_upnews(data[i]['picture'], data[i]['description'], data[i]['news']);
            i++;
        }
    }

    function func_complete_next(){
        var FamItembox = document.getElementById('Familiar_box_items');
        opaсAnimating(FamItembox, 100, "show");
        pagetoup();
    }
    function func_complete_prev(){
        var FamItembox = document.getElementById('Familiar_box_items');
        opaсAnimating(FamItembox, 100, "show");
        pagetoup();
    }


    var searchParams = getUrlParams(window.location.search);
    if(searchParams[0]["lang"]!=undefined)
    {
        function func_upnews(pic, desc, news){
            var code = '<div class="familiar_box_item">\
                            <img class="familiar_box_item_pic" src="'+pic+'" alt="'+pic+'">\
                            <a href="'+news+"&lang"+"="+searchParams[0]["lang"]+'"><div class="familiar_box_item_overlay">\
                                <div class="familiar_box_item_overlay_text"><p>'+desc+'</p></div> \
                            </div></a>\
                        </div>';
            $('.familiar_box_items').append(code);
        }
    }
    else
    {
        function func_upnews(pic, desc, news){
            var code = '<div class="familiar_box_item">\
                            <img class="familiar_box_item_pic" src="'+pic+'" alt="'+pic+'">\
                            <a href="'+news+"&lang=en"+'"><div class="familiar_box_item_overlay">\
                                <div class="familiar_box_item_overlay_text"><p>'+desc+'</p></div> \
                            </div></a>\
                        </div>';
            $('.familiar_box_items').append(code);
        }
    }

    function activate_de_pics(num){
        var left_div_id = document.getElementById('Left_pic');
        var right_div_id = document.getElementById('Right_pic');
        if(num == 0)
        {     
            left_div_id.style.pointerEvents='auto';
            right_div_id.style.pointerEvents='auto';
        }
        else if(num == 1)
        {left_div_id.style.pointerEvents='auto';}
        else if(num == 2)
        {right_div_id.style.pointerEvents='auto';}

        else if(num == 3)
        {
            left_div_id.style.pointerEvents='none';
            right_div_id.style.pointerEvents='none';
        }
        else if(num == 4)
        {left_div_id.style.pointerEvents='none';}
        else if(num == 5)
        {right_div_id.style.pointerEvents='none';}
    }
});

