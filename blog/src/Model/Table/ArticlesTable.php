<?php
namespace App\Model\Table;

class ArticlesTable extends Table 
{
	public function initialize(array $config) 
	{
		$this->addBehavior('Timestamp');

		$this->addAssociations([
			'belongsTo' => [
        'Users',
        'Categories'
      ]
    ]);
	}

	public function validationDefault(\Cake\Validation\Validator $validator) 
	{
    return $validator
    	->notEmpty('title', 'Title is required')
    	->notEmpty('content', 'Content is required');
  }
}