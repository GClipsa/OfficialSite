function getUrlParams(a)
{
    var b = new Object();
    var k = [];
    a = a.substring(1).split("&");
    for (var i = 0; i < a.length; i++) {
    c = a[i].split("=");
        b[c[0]] = c[1];
        k[i]+=a[i];
    }
    return [b,k];
}

function addOrUpdParamInUrl (url, param) //window.location.search, "lang=en"
{
    var searchParams = getUrlParams(url);
    var uparam = param.split("=");
    var checkParam = searchParams[0][uparam[0]];
    var newUrl;
    if(checkParam != undefined)
    {
        newUrl = url.replace(uparam[0]+"="+checkParam, param);
    }
    else if(checkParam == undefined)
    {
        if(searchParams[1][0] == "undefined" || searchParams[1][0] == undefined)
        {
            newUrl = url + "?" + param;
        }
        else if(searchParams[1][0] != "undefined" || searchParams[1][0] != undefined)
        {
            newUrl = url + "&" + param;
        }
    }
    return newUrl;
}