$(document).ready(function(){
    
    document.getElementById("Lang_select").addEventListener("change", function()
    {
        var newUrl = addOrUpdParamInUrl(window.location.search, "lang="+this.value);
        history.pushState(null, null, newUrl);
        location.reload();
    });
    document.getElementById("Lang_select_burg").addEventListener("change", function()
    {
        var newUrl = addOrUpdParamInUrl(window.location.search, "lang="+this.value);
        history.pushState(null, null, newUrl);
        location.reload();
    });

});