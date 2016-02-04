
/*JavaScript only for colorConverter*/

$("#toRgb").click(function(){
    $("#changedText").val('123', 16);
    $("#toRgb").addClass("active");
    $("#toHex").removeClass("active");
});
$("#toHex").click(function(){
    $("#changedText").text($("textInput").text.toString(16));
    $("#toRgb").removeClass("active");
    $("#toHex").addClass("active");
});