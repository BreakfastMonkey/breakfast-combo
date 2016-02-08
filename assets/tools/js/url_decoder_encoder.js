
/*JavaScript only for url decoder encoder*/
function activeHandler (id1,id2){
  $(id1).addClass("active");
  $(id2).removeClass("active");
}

function rmAvtive(){
$("#decoder").removeClass("active");
$("#encoder").removeClass("active");
}

function encode() {
	 var encoded = encodeURIComponent($('#changedText').val());	
   $('#changedText').val(encoded);
}
function decode() {
	var decoded = decodeURIComponent($('#changedText').val());
  $('#changedText').val(decoded);
}

$("#decoder").click(function(){
  if ( !($('#decoder').hasClass('active')) ){
    activeHandler("#decoder","#encoder");
    decode();
  };
});
$("#encoder").click(function(){
  if ( !($('#encoder').hasClass('active')) ){  
    activeHandler("#encoder","#decoder");
    encode();
  };
});

$("#clear").click(function(){
  rmAvtive();
});