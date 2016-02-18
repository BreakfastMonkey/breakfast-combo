<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5 style="line-height: 28px;">Index</h5>
    <div class="ibox-tools">
      
      <div class="pull-left" style="margin-right: 10px;">
      <?=
        $this->html->link(
          'Create New User',
          ['action' => 'add'],
          ['class' => 'btn btn-primary btn-sm']
        );
      ?>
      </div>
      
      <?= $this->Form->create(null, ['type' => 'get', 'class' => 'pull-right']) ?>
      <?=
        $this->Form->input('search_users', [
          'label' => false,
          'class' => 'input-sm',
          'placeholder' => 'Search...',
          'append' => $this->Form->button('Go', ['bootstrap-type' => 'primary', 'class' => 'btn-sm']),
        ])
      ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
  <div class="ibox-content">
    
    <table class="table">
      <thead>
        <?php
          echo $this->Html->tableHeaders([
            $this->Paginator->sort('role'),
            $this->Paginator->sort('email'),
            $this->Paginator->sort('Users.first_name', 'Name'),
            ''
          ]);
        ?>
      </thead>
      <tbody>
        <?php
          $rows = array();
          
          if(!$users->isEmpty()) {
            foreach($users as $user) {
              
              if($user->id == $authUser['id']) {
                $actions = '<a href="#" class="btn btn-primary disabled">' . $icons['unlock'] . '</a>';
              }
              else {
                $actions = $this->Form->postLink(
                  $icons['unlock'],
                  ['action' => 'loginAs', $user->id],
                  ['escape' => false, 'title' => 'Login As', 'class' => 'btn btn-primary']
                );
              }
              
              $actions .= $this->Html->link(
                $icons['edit'],
                ['controller' => 'Users', 'action' => 'edit', $user->id],
                ['escape' => false, 'title' => 'Edit', 'class' => 'btn btn-primary']
              );
              
              if($user->id == $authUser['id']) {
                $actions .= '<a href="#" class="btn btn-danger disabled">' . $icons['delete'] . '</a>';
              }
              else {
                $actions .= $this->Form->postLink(
                  $icons['delete'],
                  ['controller' => 'Users', 'action' => 'delete', $user->id],
                  [
                    'escape' => false,
                    'title' => 'Delete',
                    'class' => 'btn btn-danger',
                    'confirm' => 'Do you really want to delete ' . $user->name . '?'
                  ]
                );
              }
              
              $rows[] = array(
                [$user->role_label, ['class' => 'manager']],
                $user->email,
                $user->name,
                [$actions, ['class' => 'icon']]
              );
              
              
              
            }
          }
          else {
            $rows[] = [
              ['No users found.', ['colspan' => 4, 'class' => 'text-muted']]
            ];
          }
          
          echo $this->Html->tableCells($rows);
        ?>
      </tbody>
    </table>
    
    <?php echo $this->Paginator->numbers(); ?>
    
  </div>
</div>