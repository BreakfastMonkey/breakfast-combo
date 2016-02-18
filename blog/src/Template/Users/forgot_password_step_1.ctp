<?= $this->Form->create($passwordReset); ?>

<div class="middle-box">
  <div class="ibox">
    <div class="ibox-content">
			
			<p style="margin-bottom: 25px;">
				<?= __("Enter your email address to receive an email containing a link to reset your password. It can take a couple minutes for the email to arrive. If you don't see it in your inbox, verify your junk mail folder."); ?></p>
			
			<?= $this->Flash->render(); ?>
			
			<?= $this->Form->input('email', ['label' => __('Email'), 'autofocus' => 'autofocus']); ?>
			
			<?= $this->Form->submit(__('Submit'), ['class' => 'btn-block']); ?>
			
    </div>
  </div>
</div>

<?= $this->Form->end(); ?>