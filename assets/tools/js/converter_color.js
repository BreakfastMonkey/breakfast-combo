
/*JavaScript only for colorConverter*/

$("#toRgb").click(function(){
    $("#changedText").val('123');
    $("#toRgb").addClass("active");
    $("#toHex").removeClass("active");
});
$("#toHex").click(function(){
    $("#changedText").val($("#textInput").val());
    $("#toRgb").removeClass("active");
    $("#toHex").addClass("active");
});