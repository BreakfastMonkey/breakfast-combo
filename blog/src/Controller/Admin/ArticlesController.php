<?php
namespace App\Controller\Admin;

use Cake\Network\Exception\NotFoundException;

class ArticlesController extends \App\Controller\ArticlesController
{
	public function index() 
	{
		$articles = $this->Articles->find();

		$this->set(compact('articles'));
	}

	public function add() 
	{

	}

	public function edit($id)  
	{

	}
}