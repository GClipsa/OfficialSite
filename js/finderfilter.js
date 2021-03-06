$(document).ready(function(){

	$("#List_find").on("keyup", function()
    {
    	findfilter();
    });

	function findfilter() {
	    var input, filter, ul, li, a, i;
	    input = document.getElementById("List_find");
	    filter = input.value.toUpperCase();
	    ul = document.getElementById("List_ul");
	    li = ul.getElementsByTagName("li");
	    for (i = 0; i < li.length; i++) {
	        a = li[i].getElementsByTagName("a")[0];
	        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
	            li[i].style.display = "";
	        } else {
	            li[i].style.display = "none";

	        }
	    }
	}

});