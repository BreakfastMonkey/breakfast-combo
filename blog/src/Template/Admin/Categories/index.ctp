<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5 style="line-height: 28px;">Blog Categories</h5>
    <div class="ibox-tools">
      
      <div class="pull-left" style="margin-right: 10px;">
      <?=
        $this->html->link(
          'Add a New Category',
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
            'Category Name',
            'Total Blogs',
            ''
          ]);
        ?>
      </thead>
      <tbody>
        <?php
          $rows = [];
          
          if(!$categories->isEmpty()) {
            foreach($categories as $category) {

              $disabled = '';
              $totalArticles = count($category->articles);

              if($totalArticles > 0) 
                $disabled = 'disabled';

              $actions = $this->Html->link(
                $icons['view'],
                ['controller' => 'Articles', 'action' => 'index', $category->id],
                ['escape' => false, 'title' => 'View Articles', 'class' => 'btn btn-warning']
              );

              $actions .= $this->Html->link(
                $icons['edit'],
                ['controller' => 'Categories', 'action' => 'edit', $category->id],
                ['escape' => false, 'title' => 'Edit', 'class' => 'btn btn-primary']
              );
              
              $actions .= $this->Form->postLink(
                $icons['delete'],
                ['controller' => 'Categories', 'action' => 'delete', $category->id],
                [
                  'escape' => false,
                  'title' => 'Delete',
                  'class' => 'btn btn-danger ' . $disabled,
                  'confirm' => 'Do you really want to delete ' . $category->name . '?'
                ]
              );       
              
              $rows[] = [
                $category->name,
                $totalArticles,
                [$actions, ['class' => 'icon']]
              ];
              
            }
          }
          else {
            $rows[] = [
              ['No categories found.', ['colspan' => 4, 'class' => 'text-muted']]
            ];
          }
          
          echo $this->Html->tableCells($rows);
        ?>
      </tbody>
    </table>
    
    <?php //echo $this->Paginator->numbers(); ?>
    
  </div>
</div>