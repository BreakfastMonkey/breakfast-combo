<nav class="navbar navbar-default">
  <div class="container">
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNavCollapsable">
        <span class="sr-only"><?= __('Toggle navigation') ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
      <?=
        $this->Html->link(
          $this->Html->image('logo.png', ['srcset' => '2x', 'alt' => '']),
          '/',
          ['escape' => false, 'class' => 'navbar-brand']
        );
      ?>
    </div>
    
    <div class="collapse navbar-collapse" id="mainNavCollapsable">
      <ul class="nav navbar-nav navbar-right">
        <?= $this->element('Template/Nav/bootstrap-navbar-ul', ['navToPrint' => $nav]); ?>
      </ul>
    </div>
    
  </div>
</nav>