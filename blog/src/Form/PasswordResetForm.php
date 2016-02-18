<?php
namespace App\Form;

use Cake\Utility\Text;
use Cake\ORM\TableRegistry;
use Cake\Mailer\MailerAwareTrait;

class PasswordResetForm extends \Cake\Form\Form {
	
	use MailerAwareTrait;
	
	public $error;

  protected function _buildSchema(\Cake\Form\Schema $schema) {
    return $schema
      ->addField('email', ['type' => 'string']);
  }

  protected function _buildValidator(\Cake\Validation\Validator $validator) {
    return $validator
			->add('email', [
				'email' => [
					'rule' => 'email',
					'message' => __('Email Invalid')
				]
			]);
  }

  protected function _execute(array $data) {
		$Users = TableRegistry::get('Users');
		
		$user = $Users->findByEmail($data['email'])->first();
    
		if(!$user) {
			$this->error = __('The email address you entered could not be found.');
			return false;
		}
		else {
			$user->reset_key = Text::uuid();
			
			if($Users->save($user)) {
				
				//Need Cake 3.1
				if($this->getMailer('User')->send('resetPassword', [$user]))
					return true;
				else {
					$this->error = __('An error occured while sending the email. Please try again later.');
					return false;
				}
				
				return true;
			}
			else {
				$this->error = __('An error occured. Please try again later.');
				return false;
			}
		}
  }
  
}