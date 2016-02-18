<?php 
namespace App\Model\Entity;

class Article extends Entity 
{
	public function customUrl($title) 
	{
		return str_replace(' ', '-', strtolower($title));
	}
}