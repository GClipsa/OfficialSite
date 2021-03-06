$(document).ready(function(){
    $('.dev_slider').slick({
                slidesToShow: 3,
                infinite: true,
                autoplay: true,
                pauseOnFocus: true,
                pauseonHover:true,
                lazyLoad: 'progressive',
                prevArrow: "<img src='../svg/left.svg' class='prev' alt='1'>",
                nextArrow: "<img src='../svg/right.svg' class='next' alt='2'>"
    });
    window.addEventListener('resize',function()
    {
        $('.dev_slider').slick('setPosition');
    });
});