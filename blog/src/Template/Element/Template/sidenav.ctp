<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav" id="side-menu">
      
      <?php if (isset($authUser) && !empty($authUser) && 
        $this->request->controller != 'Articles' && $this->request->action != 'view') : ?>
      <li class="nav-header">
        <div class="dropdown profile-element">
          <span>
            <?= $this->Html->image('user.jpg', ['class' => 'img-circle', 'width' => '48']); ?>
          </span>
          
          <?php if(!empty($nav['user'])): ?>
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <span class="clear">
                <span class="block m-t-xs">
                  <strong class="font-bold"><?= $authUser->name; ?></strong>
                </span>
                <span class="text-muted text-xs block"><?= $authUser->role_label; ?> <b class="caret"></b></span>
              </span>
            </a>
            
            <ul class="dropdown-menu m-t-xs">
              <?php foreach($nav['user'] as $navKey => $item): ?>
                <?php if(isset($item['divider'])): ?>
                  <li class="divider"></li>
                <?php else: ?>
                  <?php
                    $itemLink = $this->Url->build($item['route']);
              
                    if($itemLink == $nav['active'])
                      echo '<li class="active">';
                    else
                      echo '<li>';
                  ?>
                    <?= $this->Html->link(
                      (isset($item['icon'])) ? $item['icon'] . '&nbsp;' . $item['name'] : $item['name'],
                      $item['route'],
                      ['escape' => false]
                    ); ?>
                  </li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
            
          <?php else: ?>
            <p>
              <span class="clear">
                <span class="block m-t-xs">
                  <strong class="font-bold"><?= $authUser->name; ?></strong>
                </span>
                <span class="text-muted text-xs block"><?= $authUser->role_label; ?></span>
              </span>
            </p>
          <?php endif; ?>
          
        </div>
        <div class="logo-element">
          *
        </div>
      </li>
      <?php else: ?>
        <li class="nav-header">
          <div class="profile-element">
            <h1>WEBKITS</h1>
          </div>
        </li>
      <?php endif; ?>
      
      <?php
        
        foreach($nav['main'] as $itemKey => $item) {
          $liClasses = [];
          
          if(isset($item['children'])) {
            $liClasses[] = 'dropdown';
            
            $name = $item['icon'] . '<span class="nav-label">' . $item['name'] . '</span><span class="fa arrow"></span>';
            $link = '#';
            
            $linkOptions = [
              'escape' => false,
              'class' => 'dropdown-toggle',
              'data-toggle' => 'dropdown'
            ];
          }
          else {
            
            $name = $item['icon'] . '<span class="nav-label">' . $item['name'] . '</span>';
            $link = $this->Url->build($item['route']); 
            
            if($link == $nav['active'])
              $liClasses[] = 'active';
            
            $linkOptions = ['escape' => false];
          }
     
          echo '<li class="' . implode(' ', $liClasses) . '" id="nav-' . $itemKey . '">';
          
          echo $this->Html->link($name, $item['route'], $linkOptions);
          
          if(isset($item['children'])) {
            
            echo '<ul class="nav nav-second-level">';
            
            foreach($item['children'] as $subItem) {
              $subliClasses = [];
              $link = $this->Url->build($item['route']);
              
              if($link == $nav['active'])
                $subliClasses[] = 'active';
              
              echo '<li class="' . implode(' ', $subliClasses) . '" id="nav-' . $itemKey . '">'
                . $this->Html->link($subItem['name'], $link, ['escape' => false])
              . '</li>';
            }
            
            echo '</ul>';
            
          }
          
          echo '</li>';
        }
      ?>
      
    </ul>
  </div>
</nav>