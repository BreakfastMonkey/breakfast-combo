<?php
namespace App\Model\Entity;

use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

class Entity extends \Cake\ORM\Entity {

  // Make all fields mass assignable for now.
  protected $_accessible = ['*' => true];
  
  //Tries to generate a label based on array in modelTable file
  protected function _label($field) {
    
    if (! isset($this->_properties[$field]))
      return '';
    
		$Table = TableRegistry::get($this->_registryAlias);
		$f = Inflector::variable(Inflector::pluralize($field));
    
		$values = $Table->$f;
		$value = $this->$field;
    
		if (isset($values[$value]))
			return $values[$value];
    
		return '';
	}

}
