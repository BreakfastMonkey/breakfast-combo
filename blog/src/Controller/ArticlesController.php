<?php
namespace App\Controller;

class ArticlesController extends AppController
{	
	
	public function index() 
	{
		$title = 'Blogs';

		$articles = $this->Articles->find();

		$this->set(compact('articles', 'title'));	
	}

	public function view($id) 
	{	
		$article = $this->Articles->get($id);
		$title = $article->title;

		$this->set(compact('article', 'title'));
	}
}