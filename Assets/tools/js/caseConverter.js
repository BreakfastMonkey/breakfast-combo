
/*JavaScript only for case Converter*/
$("#upper").click(function(){
  $("#changedText").css("text-transform", "uppercase");
  $("#upper").addClass("active");
  $("#lower").removeClass("active");
  $("#capital").removeClass("active");
});
$("#lower").click(function(){
  $("#changedText").css("text-transform", "lowercase");
  $("#lower").addClass("active");
  $("#upper").removeClass("active");
  $("#upper").removeClass("active");
});
$("#capital").click(function(){
  $("#changedText").css("text-transform", "Capitalize");
  $("#capital").addClass("active");
  $("#lower").removeClass("active");
  $("#upper").removeClass("active");
});