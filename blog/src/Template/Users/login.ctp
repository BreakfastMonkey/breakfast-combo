<div id="login" class="middle-box text-center">
	<div class="ibox">
		<div class="ibox-content">
			<h2>Webkits Blog</h2>
			<?= $this->Flash->render() ?>
			<?= $this->Form->create(); ?>
			<?= $this->Form->input('email', ['label' => false, 'prepend' => '@', 'autofocus' => 'autofocus']); ?>
			
      <?= $this->Form->input('password', [
				'label' => false,
				'prepend' => $icons['lock'],
				'help' => $this->Html->link('Forgot your password?', ['action' => 'forgot_password_step_1'], ['class' => 'pull-right text-muted'])
			]); ?>
			
			<br />
			
			<?= $this->Form->submit('Login', ['class' => 'btn-block']); ?>
      <?= $this->Form->end(); ?>
      
		</div>
	</div>
</div>