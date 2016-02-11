function htmlEncode (html){
    var temp = document.createElement ("div");
    (temp.textContent != undefined ) ? (temp.textContent = html) : (temp.innerText = html);
    var output = temp.innerHTML;
    temp = null;
    return output;
},

htmlDecode:function (text){
    var temp = document.createElement("div");
    temp.innerHTML = text;
    temp = null;
    return output;
}
