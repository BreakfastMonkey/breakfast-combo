<?= $this->Form->create($user); ?>

<div class="middle-box">
  <div class="ibox">
    <div class="ibox-content">
      
      <?= $this->Flash->render() ?>
			
			<div class="row">
        <div class="col-xs-12">
          <?= $this->Form->input('first_name'); ?>
        </div>
        <div class="col-xs-12">
          <?= $this->Form->input('last_name'); ?>
        </div>
      </div>
      
      <?= $this->Form->input('email', ['autofocus' => 'autofocus']); ?>
      
      <?=
        $this->Form->input('password', [
          'label' => 'Password',
					'autocomplete' => 'off'
        ]);
      ?>
      
      <?=
        $this->Form->input('confirm_password', [
          'type' => 'password',
          'label' => 'Confirm Password',
					'autocomplete' => 'off'
        ]);
      ?>
      
      <br />
      
      <?= $this->Form->submit('Register', ['class' => 'btn-block']); ?>
      
    </div>
  </div>
</div>

<?= $this->Form->end(); ?>