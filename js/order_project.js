$(document).ready(function(){
    
    $('.dragdrop_box').upload({
        action: '../php/upload.php',
        label:'Choose your file or drop it here!',
        postKey: 'file',
        maxQueue: 1,
        maxSize: 10485760, //10MB
        autoUpload: false,
    });

    $("#S_button").on("click", function()
    {
        $('.dragdrop_box').upload("start");
    });
});