<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;

class User extends Entity {
  
  protected function _getName() {
    $name = [];
    
    if(!empty($this->first_name))
      $name[] = $this->first_name;
    
    if(!empty($this->last_name))
      $name[] = $this->last_name;
    
    if(!empty($name))
      return implode(' ', $name);
  }
  
  protected function _getRoleLabel() {
    return $this->_label('role');
  }
  
  protected function _getHomeRoute() {
    if(isset($this->role)){
      switch($this->role) {
        case 'A':
          return ['controller' => 'Users', 'action' => 'index', 'prefix' => 'admin'];
          break;
        case 'H':
          return ['controller' => 'Contacts', 'action' => 'index', 'prefix' => 'head_office'];
          break;
        case 'F':
          return ['controller' => 'Contacts', 'action' => 'index', 'prefix' => 'franchise'];
          break;
      }
    }
  }

  protected function _setPassword($password) {
    return (new DefaultPasswordHasher)->hash($password);
  }
  
}