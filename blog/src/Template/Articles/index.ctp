<div class="row article">
	<?php 
		if (!$articles->isEmpty()) {
			foreach ($articles as $article) {
				$slug = $article->customUrl($article->title);

				echo 
				'<div class="col-lg-6 col-sm-12"><div class="ibox">' . 
				'<div class="ibox-title"><h3>' . $article->category->name .'</h3></div>' .
				'<div class="ibox-content">' . 
				$this->Html->link('<h2>' . $article->title . '</h2>', 
					[
            'controller' => 'articles', 'action' => 'view', 
            $article->id, $slug, 'prefix' => false
          ],
          ['escape' => false]
				) .

				'<p>' . substr(strip_tags($article->content), 0, 100) . '...</p>' . 
				'</div></div></div>';
			}
		}
	?>
</div>
