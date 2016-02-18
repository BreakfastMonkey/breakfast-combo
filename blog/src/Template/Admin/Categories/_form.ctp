<?= $this->Form->create($category) ?>
<div class="row">
  <div class="col-xs-24"> 
    <div class="ibox">
      <div class="ibox-content">  
        <?= $this->Form->input('name', ['autofocus' => 'autofocus']); ?>
      </div>
    </div> 
  </div>
</div>

<div class="submit-big">
  <?= $this->Form->submit('Save Category', ['bootstrap-type' => 'primary']); ?>
</div>
<?= $this->Form->end() ?>