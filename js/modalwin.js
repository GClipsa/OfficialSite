export function create_modal_window(text, link){
    var code = '<div id="my_modal" class="modal">\
	    			<div class="modal_content">	\
	      				<p>'+text+'</p>\
	      				<span  class="close_modal_window">×</span>\
	    			</div>\
	    			<script>\
						var modal = document.getElementById("my_modal");\
						var span = document.getElementsByClassName("close_modal_window")[0];\
						window.onclick = function (event) {if (event.target == modal) {modal.style.display = "none"; $("#my_modal").remove(); location.href = "'+link+'";}};\
						span.onclick = function () {modal.style.display = "none"; $("#my_modal").remove(); location.href = "'+link+'";};\
  					</script>\
  				</div>';
    $('.wrapper').append(code);
}