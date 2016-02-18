<div class="row border-bottom">
<?php if (!empty($this->request->prefix)): ?>


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
	

<?php else: ?>
	<nav id="custom-header" class="navbar navbar-default">
    <div class="navbar-header">
      <a class="navbar-minimalize" href="#">
        <i class="fa fa-bars fa-2x"></i>
      </a>
    </div>

    <ul class="nav navbar-nav navbar-right  navbar-top-links">
      <li>
        <a href="#">Blog</a>
      </li>
      <li>
        <a href="#">Contact</a>
      </li>
    </ul> 
	</nav>

<?php endif;?>
</div>