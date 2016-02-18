<?php
namespace App\Mailer;

use Cake\Core\Configure;

class UserMailer extends \Cake\Mailer\Mailer {
  
  public function resetPassword($user) {
    
    if (Configure::read('debug')) {
      $this->_email
        ->emailFormat('html')
        ->template('reset_password')
        ->set(compact('user'))
        ->subject(__('Password Reset'))
        
        ->transport('smtp')
        ->from('lyz@321sd.com', 'Cake3')
        ->to('lyz@321sd.com');
    }
    else {
      $this->_email
      ->emailFormat('html')
      ->template('reset_password')
      ->set(compact('user'))
      ->subject(__('Password Reset'))
      
      //->from('info@micrylium.com', 'Micrylium')
      ->to($user->email, $user->name);
    }
    
    return true;
  }

}