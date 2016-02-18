<?= $this->Form->create($user); ?>

<div class="middle-box">
  <div class="ibox">
    <div class="ibox-content">
			
			<?= $this->Flash->render(); ?>
			
			<?php
				echo $this->Form->input('email', [
					'label' => __('Email'),
					'disabled' => 'disabled',
				]);
			?>
			
			<?php
				echo $this->Form->input('password', [
					'label' => __('New Password'),
					'required' => 'required'
				]);
			?>
			
			<?php
				echo $this->Form->input('confirm_password', [
					'type' => 'password',
					'label' => __('Confirm your new password'),
					'required' => 'required',
				]);
			?>
			
			<?= $this->Form->submit(__('Reset Password'), ['class' => 'btn-block']); ?>
			
		</div>
	</div>
</div>

<?= $this->Form->end(); ?>