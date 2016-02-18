<div class="row border-bottom">

	<nav class="navbar navbar-static-top" role="navigation">
		
		<div class="navbar-header">
			<a class="navbar-minimalize" href="#">
				<span id="nav-logo">Webkits Blog</span>
			</a>
		</div>
		
		<ul class="nav navbar-top-links navbar-right">
			<li>
				<?= $this->Html->link($icons['logout'], ['controller' => 'Users', 'action' => 'logout', 'prefix' => false], [
					'escape' => false,
					'title' => __('Log off')
				]); ?>
			</li>
		</ul>
		
	</nav>
	
</div>