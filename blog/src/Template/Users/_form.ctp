<?php
  if($this->request->action == 'profile') {
    $psw_label = 'New Password';
    $submit = 'Update my profile';
  }
  elseif($this->request->action == 'add') {
    $psw_label = 'Password';
    $submit = 'Create User';
  }
  else {
    $psw_label = 'New Password';
    $submit = 'Update User';
  }
?>

<?= $this->Form->create($user, ['novalidate' => 'novalidate']) ?>

<div class="row">
  <div class="col-xs-12">
    
    <div class="ibox">
      <div class="ibox-content">
        
        <?= $this->Form->input('email', ['autofocus' => 'autofocus']); ?>
        
        <div class="row">
          <div class="col-xs-12">
            <?= $this->Form->input('first_name'); ?>
          </div>
          <div class="col-xs-12">
            <?= $this->Form->input('last_name'); ?>
          </div>
        </div>
        
        
        <?php if(in_array($this->request->action, ['add', 'edit']) && $user->id != $authUser['id']): ?>
          
          <?=
            $this->Form->input('role', [
              'options' => $roles,
              'type' => 'radio',
            ]);
          ?>
          
        <?php endif; ?>
        
      </div>
    </div>
    
  </div>
  <div class="col-xs-12">
    
    <div class="ibox">
      <div class="ibox-content">
        
        <?=
          $this->Form->input('password', [
            'label' => $psw_label,
						'autocomplete' => 'off'
          ]);
        ?>
        
        <?=
          $this->Form->input('confirm_password', [
            'type' => 'password',
						'autocomplete' => 'off'
          ]);
        ?>
        
      </div>
    </div>
    
  </div>
</div>

<div class="submit-big">
  <?= $this->Form->submit($submit, ['bootstrap-type' => 'primary']); ?>
</div>

<?= $this->Form->end() ?>