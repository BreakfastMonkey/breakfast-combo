
/*JavaScript only for colorConverter*/
function componentToHex(c) {
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}

function rgbToHex(r, g, b) {
    return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
}

$("#toRgb").click(function(){
    $("#changedText").val('123');
    $("#toRgb").addClass("active");
    $("#toHex").removeClass("active");
});
$("#toHex").click(function(){
	var number = $("#textInput").val();
    $("#changedText").val(rgbToHex(number,number,number));
    $("#toRgb").removeClass("active");
    $("#toHex").addClass("active");
});