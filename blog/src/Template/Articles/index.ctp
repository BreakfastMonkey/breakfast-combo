<div class="article">
	<div class="row">
		<div class="col-xs-24">
			<?php 
				if (!$articles->isEmpty()) {
					foreach ($articles as $article) {
						$slug = $article->customUrl($article->title);

						echo $this->Html->link('<h2>' . $article->title . '</h2>', 
							[
	              'controller' => 'articles', 'action' => 'view', 
	              $article->id, $slug, 'prefix' => false
	            ],
	            ['escape' => false]
						);

						echo '<p>' . substr(strip_tags($article->content), 0, 400) . '...</p>';
						echo '<hr>';
					}
				}
			?>
		</div>
	</div>
</div>