<?php
  $fontFamily = "font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;";
  $defaultFont = $fontFamily . " font-size: 14px; line-height: 20px;";
?>

<p style="<?= $defaultFont ?> padding-bottom: 20px;">
  <?= __('We received a request to reset your password. If you want to do so, please click on this link:') ?>
</p>

<?= $this->Html->link(
  __('Reset my password'),
  ['controller' => 'Users', 'action' => 'forgot_password_step_2', $user->reset_key, '_full' => true],
  ['style' => $defaultFont . 'padding: 8px 24px; border-radius: 30px; background: #3799db; color: #FFF; text-decoration: none; font-weight: bold;']
) ?>

<p style="<?= $defaultFont ?> padding-top: 20px;">
  <?= __("If you didn't request this password reset, you can ignore this email.") ?>
</p>