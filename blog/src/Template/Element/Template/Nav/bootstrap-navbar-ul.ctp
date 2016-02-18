<?php

if(!empty($navToPrint)) {
	foreach($navToPrint as $itemKey => $item) {
		
		$liClasses = [];
		
		if(isset($item['children'])) {
			$liClasses[] = 'dropdown';
			
			$name = $item['name'] . ' <span class="caret"></span>';
			$link = '#';
			
			$linkOptions = [
				'escape' => false,
				'class' => 'dropdown-toggle',
				'data-toggle' => 'dropdown'
			];
		}
		else {
			
			$name = $item['name'];
			$link = $this->Url->build($item['route']);
			
			if($link == $nav['active'])
				$liClasses[] = 'active';
			
			$linkOptions = ['escape' => false];
		}
		
		echo '<li class="' . implode(' ', $liClasses) . '" id="nav-' . $itemKey . '">';
		
		echo $this->Html->link($name, $link, $linkOptions);
		
		if(isset($item['children'])) {
			
			echo '<ul class="dropdown-menu" role="menu">';
			
			foreach($item['children'] as $subItem) {
				$subliClasses = [];
				$link = $this->Url->build($item['route']);
				
				if($link == $nav['active'])
					$subliClasses[] = 'active';
				
				echo '<li class="' . implode(' ', $subliClasses) . '" id="nav-' . $itemKey . '">'
					. $this->Html->link($subItem['name'], $link, ['escape' => false])
				. '</li>';
			}
			
			echo '</ul>';
			
		}
		
		echo '</li>';
	}
}