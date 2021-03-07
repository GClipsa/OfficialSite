$(document).ready(function(){
	$('.slider').slick({
                vertical: true,
                verticalSwiping: true,
                slidesToShow: 3,
                infinite: true,
                autoplay: true,
                pauseOnFocus: true,
                pauseonHover:true,
                lazyLoad: 'progressive',
                prevArrow: "<img src='svg/up.svg' class='prev' alt='1'>",
    			nextArrow: "<img src='svg/down.svg' class='next' alt='2'>",
                responsive: [
                  {
                    breakpoint: 425,
                    settings: {
                      slidesToShow: 2,
                    }
                  }
                ],
    });
    $('.dev_slider').slick({
                slidesToShow: 3,
                infinite: true,
                autoplay: true,
                pauseOnFocus: true,
                pauseonHover:true,
                lazyLoad: 'progressive',
                prevArrow: "<img src='svg/left.svg' class='prev' alt='1'>",
                nextArrow: "<img src='svg/right.svg' class='next' alt='2'>",
                responsive: [
                  {
                    breakpoint: 425,
                    settings: {
                      slidesToShow: 1,
                    }
                  }
                ],
    });

    window.addEventListener('resize',function()
    {
        $('.slider').slick('setPosition');
        $('.dev_slider').slick('setPosition');
    });
});