// copy to clipboard funcyion

$("#dynamicHeader").load("../assets/global/header.html", function(){	

	$(".sidebar-nav li").on('click', function(){

		if ($(this).find('ul').length != 0) {
			$(this).toggleClass('active');

			if ($(this).hasClass('active')) {
				$(this).find('.nav-second-level').first().stop(true, true).slideDown(200);
				$('.arrow', this).toggleClass('fa-angle-down fa-angle-left');
			} else {
				$(this).find('.nav-second-level').first().stop(true, true).slideUp(200);
				$('.arrow', this).toggleClass('fa-angle-left fa-angle-down');
			}

		}

		else {
			$(".sidebar-nav li").removeClass('active');
			$(this).addClass('active');
		}
	});

	$("#menu-toggle").click(function(e) {
	  e.preventDefault();
	  $("#wrapper").toggleClass("toggled");
	});

});

