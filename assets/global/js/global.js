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

$("#sidebar-wrapper").load("../assets/global/header.html", function(){	

	$(".sidebar-nav li").on('click', function(){
	
		if ($(this).find('ul').length != 0) {
			$(this).toggleClass('active');

			if ($(this).hasClass('active')) {
				$(this).find('.nav-second-level').first().stop(true, true).slideDown();
				$('.arrow', this).toggleClass('fa-angle-down fa-angle-left');
			} else {
				$(this).find('.nav-second-level').first().stop(true, true).slideUp();
				$('.arrow', this).toggleClass('fa-angle-left fa-angle-down');
			}

		} else {
			$(".sidebar-nav li").removeClass('active');
			$(this).addClass('active');
		}
	});


});

