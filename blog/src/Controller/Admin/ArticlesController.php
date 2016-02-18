<?php
namespace App\Controller\Admin;

use Cake\Network\Exception\NotFoundException;

class ArticlesController extends \App\Controller\ArticlesController
{
	public function index($id = null) 
	{
		$articleCategories = $this->Articles->Categories->find()
			->contain(['Articles']);

		if(! empty($id)) 
			$articleCategories = $articleCategories
		    ->where(['Categories.id' => $id]);

		$this->set(compact('articleCategories'));
	}

	public function add() 
	{
		$article = $this->Articles->newEntity();

		$this->_form($article);
	}

	public function edit($id)  
	{	
		$article = $this->Articles->get($id, [
			'contain' => ['Categories']
		]);

		if (!$article) 
			throw new NotFoundException();
		
		$this->_form($article);
	}

	protected function _form($article) 
	{
		if ($this->request->is(['post', 'put'])) {
			$article = $this->Articles->patchEntity($article, $this->request->data);

			if ($this->Articles->save($article)) {
				$this->Flash->success('The article has been saved.');
        return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('An error occured while trying to save the article.');
			}
		}

		$categories = $this->Articles->Categories->find('list');

		$this->set(compact('article', 'categories'));
		$this->render('_form');	
	}
}