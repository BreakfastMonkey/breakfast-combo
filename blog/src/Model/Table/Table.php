<?php
namespace App\Model\Table;

class Table extends \Cake\ORM\Table {
  
  protected $_activeStatuses = [];
	protected $_order = [];
  
  public function initialize(array $config) {
    parent::initialize($config);
    
    if($this->hasField('name'))
      $this->displayField('name');
    
    $this->addBehavior('Timestamp');
  }
  
  public function beforeFind($event, $query, $options, $primary) {
    
    // TO SET DEFAULT ORDER
		$order = $query->clause('order');
		if (! empty($this->_order) && empty($order)) {
			$query->order($this->_order);
		}
    
    // TO AUTOMATICALLY FILTER OUT DELETED RECORDS
    if((!isset($options['statusCheck']) || $options['statusCheck'] !== false) && !empty($this->_activeStatuses)) {
			$query->where([$this->alias() . '.status IN' => $this->_activeStatuses]);
    }
	}
  
  public function exists($conditions, $checkStatus = false) {
    
		if (! is_array($conditions) && is_numeric($conditions)) {
			$conditions = [
				'id' => $conditions
			];
		}
    
		if ($checkStatus && !empty($this->_activeStatuses)) {
			$conditions['status IN '] = $this->_activeStatuses;
		}
    
		return parent::exists($conditions);
	}
	
}