// copy to clipboard funcyion
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

$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$("#sidebar-wrapper").load("../assets/global/header.html");
