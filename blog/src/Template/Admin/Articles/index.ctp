<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5 style="line-height: 28px;">Articles</h5>
    <div class="ibox-tools">
      
      <div class="pull-left" style="margin-right: 10px;">
      <?=
        $this->html->link(
          'Add a New Article',
          ['action' => 'add'],
          ['class' => 'btn btn-primary btn-sm']
        );
      ?>
      </div>
    </div>
  </div>
  <div class="ibox-content">
    
    <table class="table">
      <thead>
        <?php
          echo $this->Html->tableHeaders([
            $this->Paginator->sort('title'),
            $this->Paginator->sort('created'),
            'Author'
          ]);
        ?>
      </thead>
      <tbody>
        <?php
          $rows = array();
          
          if(!$articles->isEmpty()) {
            foreach($articles as $article) {
              
              $actions = $this->Html->link(
                $icons['edit'],
                ['controller' => 'Articles', 'action' => 'edit', $article->id],
                ['escape' => false, 'title' => 'Edit', 'class' => 'btn btn-primary']
              );
              
              $actions .= $this->Form->postLink(
                $icons['delete'],
                ['controller' => 'Articles', 'action' => 'delete', $article->id],
                [
                  'escape' => false,
                  'title' => 'Delete',
                  'class' => 'btn btn-danger',
                  'confirm' => 'Do you really want to delete ' . $article->name . '?'
                ]
              );
              
              
              $rows[] = array(
                $article->title,
                $article->body,
                [$actions, ['class' => 'icon']]
              );
              

            }
          }
          else {
            $rows[] = [
              ['No articles found.', ['colspan' => 4, 'class' => 'text-muted']]
            ];
          }
          
          echo $this->Html->tableCells($rows);
        ?>
      </tbody>
    </table>
    
    <?php //echo $this->Paginator->numbers(); ?>
    
  </div>
</div>