<?php
	
	echo $this->Html->script('ckeditor/ckeditor.js', ['block' => true]);
	
	$options = '';
	
	if(isset($customConfig)) {
		$options = "customConfig: '/js/ckeditor/" . $customConfig . ".js'";
	}
	else {
		$options = "customConfig: '/js/ckeditor/config.js'";
	}
	
	echo $this->Html->scriptBlock("
		
		$(function() {
			
			$('.ckeditor').load( function() {
				CKEDITOR.replace('.ckeditor', {
					". $options ."
				});
			});
			
		});
		
	", ['block' => true]);
	