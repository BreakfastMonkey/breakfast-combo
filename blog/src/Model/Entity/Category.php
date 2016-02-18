<?php
namespace App\Model\Entity;
use Cake\ORM\TableRegistry;

class Category extends Entity {

  public function canDelete() {
    $articles = TableRegistry::get('Articles');

    $articles = $articles->find()
      ->where(['category_id' => $this->id])
      ->count();

    if(empty($articles))
      return true;
    else 
      return false;
  }

}