<?php
namespace App\Model\Table;

class UsersTable extends Table {
	
	protected $_activeStatuses = ['A'];
	
	protected $_order = ['Users.role' => 'ASC', 'Users.first_name'];
	
	public $roles = [
		'A' => 'Administrator',
    'H' => 'Head Office',
    'F' => 'Franchise Owner'
	];

  public function initialize(array $config) {
		parent::initialize($config);
		
    $this->addAssociations([
			
    ]);
  }

  public function validationDefault(\Cake\Validation\Validator $validator) {
    return $validator
			
			->notEmpty('first_name', 'An name is required')
      ->notEmpty('last_name', 'An name is required')
			
      ->notEmpty('email', 'Required')
			
      ->add('email', [
        'email' => [
          'rule' => 'email',
          'message' => 'Invalid',
        ],
        'unique' => [
          'rule' => 'validateUnique',
          'provider' => 'table',
          'message' => 'The email already exists.'
        ]
      ])

      ->notEmpty('password', 'Required', 'create')
			
      ->add('confirm_password',
        'compareWith', [
          'rule' => ['compareWith', 'password'],
          'message' => 'Passwords do not match.',
        ]
      )
			
      ->notEmpty('confirm_password', 'Required', function ($context) {
        
        if($context['newRecord'])
          return true;
        
        if (isset($context['providers']['entity'])) {
          $user = $context['providers']['entity'];
          $password = $user->password;
        }
        elseif (isset($context['data']['password'])) {
          $password = $context['data']['password'];
        }
        
        return (!empty($password));
      })

      ->notEmpty('role', 'Required')
      ->add('role', [
        'inList' => [
          'rule' => ['inList', array_keys($this->roles)],
          'message' => 'Invalid role'
        ]
      ]);
  }
	
	public function validationPasswordReset(\Cake\Validation\Validator $validator) {
    
    $validator
      ->notEmpty('password', 'Required')
      ->notEmpty('confirm_password', 'Required')
      ->add('confirm_password', [
        'compareWith' => [
          'rule' => ['compareWith', 'password'],
          'message' => 'Passwords do not match.',
        ]
      ]);
    
    return $validator;
  }

}