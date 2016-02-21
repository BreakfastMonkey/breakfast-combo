<?= $this->element('Template/head'); ?>

<div id="wrapper">
	<?= $this->element('Template/sidenav'); ?>
	
	<div id="page-wrapper" class="gray-bg">
		<?= $this->element('Template/topnav'); ?>

    <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-xs-24">
        <h2><?= $title ?></h2>   

        <ol class="breadcrumb">
          <li><?= 
            $this->Html->link($icons['home'], 
              ['controller' => 'Articles', 'action' => 'index', 'prefix' => false], 
              ['escape' => false]) ?>
          </li>
          <li><?= $title ?></li>
        </ol>
      </div>
    </div>
    
    <div class="wrapper-content">
      <div class="row">
        <div class="col-xs-24">
          <?= $this->Flash->render() ?>
          <?= $this->fetch('content') ?>
        </div>
      </div>
    </div>
    
    <?= $this->element('Template/copyright'); ?>
  </div>
</div>

<?= $this->element('Template/foot'); ?>
