<?php
namespace App\Controller\Admin;

use Cake\Network\Exception\NotFoundException;

class CategoriesController extends \App\Controller\AppController
{
	public function index() 
	{
		$categories = $this->Categories->find()
		 ->contain('Articles');

		$this->set(compact('categories'));
	}

	public function add() 
	{
		$category = $this->Categories->newEntity();

		$this->_form($category);
	}

	public function edit($id)  
	{	
		$category = $this->Categories->get($id);

		if (!$category) 
			throw new NotFoundException();
		
		$this->_form($category);
	}

	protected function _form($category) 
	{	
		if ($this->request->is(['post', 'put'])) {
			$category = $this->Categories->patchEntity($category, $this->request->data);

			if ($this->Categories->save($category)) {
				$this->Flash->success('The category has been saved.');
        return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('An error occured while trying to save the category.');
			}
		}

		$this->set(compact('category'));
		$this->render('_form');	
	}
}