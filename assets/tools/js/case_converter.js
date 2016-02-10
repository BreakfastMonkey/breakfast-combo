
/*JavaScript only for case Converter*/
function activeHandler (id1,id2,id3){
  $(id1).addClass("active");
  $(id2).removeClass("active");
  $(id3).removeClass("active");
}
$("#upper").click(function(){
  $("#changedText").css("text-transform", "uppercase");
  activeHandler("#upper","#lower","#capital");
});
$("#lower").click(function(){
  $("#changedText").css("text-transform", "lowercase");
  activeHandler("#lower","#upper","#capital");
});
$("#capital").click(function(){
  $("#changedText").css("text-transform", "Capitalize");
  activeHandler("#capital","#lower","#upper");
});

var copyTextareaBtn = document.querySelector('.textareacopybtn');

	copyTextareaBtn.addEventListener('click', function(event) {
	  var copyTextarea = document.querySelector('.copytextarea');
	  copyTextarea.select();

	  try {
	    var successful = document.execCommand('copy');
	    
	  } catch (err) {
	    alert("Your browser does not support this function,\nplease select and copy manually instead.");
	  }
	});