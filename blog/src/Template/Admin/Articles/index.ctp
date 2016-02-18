<?php use Cake\Utility\Inflector; ?>

<div class="ibox">

  <div class="ibox-title">
    <div class="ibox-tools">
      <?php
        echo $this->Html->link('New Article',
          ['controller' => 'Articles', 'action' => 'add'],
          ['class' => 'btn btn-primary btn-sm']
        );
      ?>
    </div>
  </div>

  <div class="ibox-content">

    <?php if(!$articleCategories->isEmpty()): ?>
      
      <?php foreach($articleCategories as $category): ?>
        <h4><?= $category->name; ?></h4>

          <table class="table">
            <thead>
              <?php
                echo $this->Html->tableHeaders([
                  ['Name' => ['width' => '45%']],
                  'Content'
                ]);
              ?>
            </thead>

            <tbody>
              <?php if(!empty($category->articles)): ?>

              <?php 
                $rows = [];

                foreach($category->articles as $article) {

                  $slug = $article->customUrl($article->title);

                  $actions = $this->Html->link(
                    $icons['view'],
                    [
                      'controller' => 'articles', 'action' => 'view', 
                      $article->id, $slug, 'prefix' => false
                    ],
                    ['escape' => false, 'title' => 'Edit', 'class' => 'btn btn-warning', 'target' => '_blank']
                  );

                  $actions .= $this->Html->link(
                    $icons['edit'],
                    ['controller' => 'articles', 'action' => 'edit', $article->id],
                    ['escape' => false, 'title' => 'Edit', 'class' => 'btn btn-primary']
                  );

                  $actions .= $this->Html->link(
                    $icons['delete'],
                    ['controller' => 'articles', 'action' => 'delete', $article->id],
                    [
                      'confirm' => 'Are you sure you wish to delete this article?',
                      'escape' => false, 'title' => 'Delete', 'class' => 'btn btn-danger'
                    ]
                  );

                  $rows[] = [
                    $article->title,
                    substr(strip_tags($article->content), 0, 100),
                    [$actions, ['class' => 'icon']]
                  ];  
                }

                echo $this->Html->tableCells($rows);
              ?>

              <?php else: ?>
               <tr>
                  <td colspan="3" class="text-muted">
                    No articles found.
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>


      <?php endforeach; ?>

    <?php else: ?>
      No article categories found.
    <?php endif; ?>

  </div>

</div>