/*JavaScript only for wordcounter*/

function countWords(){
    var textBlock = $("#textInput").val();
    $("#changedText").val("total characters: " + textBlock.length + "\ntotal words: " + (textBlock.split(/\w+[\s\n.,;?!]*/).length - 1));
}

function clearFields(){
    $("#textInput").val("");
    $("#changedText").val("");
}