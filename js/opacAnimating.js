function opaсAnimating(el, speed, state)
{
    el.style.opacity = 0;
    var step = 1 / speed;
    if(state=="show")
    {
    var interval = setInterval(function() {
      if (+el.style.opacity >= 1)
        clearInterval(interval);
          el.style.opacity = +el.style.opacity + step;
        }, speed / 1000);
    }
    else if(state=="hide")
    {
        var interval = setInterval(function() {
            if (+el.style.opacity >= 1)
              clearInterval(interval);
                el.style.opacity = -el.style.opacity - step;
              }, speed / 1000);
    }
};