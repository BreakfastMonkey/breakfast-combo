<?php
namespace App\Model\Table;

class CategoriesTable extends Table 
{
	public function initialize(array $config) 
	{
		$this->addAssociations([
			'hasMany' => [
        'Articles',
      ]
    ]);
	}

	public function validationDefault(\Cake\Validation\Validator $validator) 
	{
    return $validator
    	->notEmpty('name', 'Name is required');
  }

  public function beforeDelete($event, $entity, $options) 
  {
  	if (! $entity->canDelete()) 
      return false;
  }
}