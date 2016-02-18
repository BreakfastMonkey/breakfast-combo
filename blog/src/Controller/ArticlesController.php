<?php
namespace App\Controller;

class ArticlesController extends AppController
{
	public function view($id) 
	{	
		$article = $this->Articles->get($id);
		//$title = $article->title;

		$this->set(compact('article'));
	}
}