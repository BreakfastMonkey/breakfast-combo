<?php
namespace App\Controller\Admin;

class AppController extends \App\Controller\AppController {
	
	public function ckeditor() {
		//To set style inside CKeditor to look like website, create "/css/ckeditor.css"
		//To set styles available in the dropdown, edit "/js/ckeditor/styles.js"
	}
  
	//--------------------------------------------------------------------------------------------------------------------CKEDTITOR-JSONS------------
	
	public function images() {
		$this->autoRender = false;
		$images = [];
		
    $dir = WWW_ROOT . 'assets';
		$file_ext = ['bmp','gif','jpeg','jpg','png'];
		$files = scandir($dir);
		
		foreach($files as $file) {
			if($file == '.' || $file == '..')
				continue;
			
			$fileArray = explode('.', $file);
			$ext = array_pop($fileArray);
			if(in_array($ext, $file_ext))
				$images[] = ['image' => '/assets/' . rawurlencode($file)];
		}
		
		$this->response->disableCache();
		$this->response->type('json');
		$this->response->body(json_encode($images));
	}
	
	public function links() {
		$this->autoRender = false;
		$links = [];
		
		// To do for each models that have pages to link to
		
		$this->loadModel('Pages');
		$pages = $this->Pages->find();
		
		foreach($pages as $page) {
			$links[] = ['folder' => 'Pages', 'name' => $page->name, 'url' => '/pages/view/' . $page->id];
		}
		
		//end
		
		// To allow link to file uploaded
		
		$dir = WWW_ROOT . 'assets';
		$file_ext = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt'];
		$files = scandir($dir);
		
		foreach($files as $file) {
			if($file == '.' || $file == '..')
				continue;
			
			$fileArray = explode('.', $file);
			$ext = array_pop($fileArray);
			if(in_array($ext, $file_ext))
				$links[] = ['folder' => 'Files', 'name' => $file, 'url' => '/assets/' . rawurlencode($file)];
		}
		
		//end
		
		$this->response->disableCache();
		$this->response->type('json');
		$this->response->body(json_encode($links));
	}
  
}