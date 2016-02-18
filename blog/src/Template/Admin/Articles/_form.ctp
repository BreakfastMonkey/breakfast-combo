<?= $this->element('ckeditor'); ?>

<?= $this->Form->create($article) ?>
<div class="row">
  <div class="col-xs-24"> 
    <div class="ibox">
      <div class="ibox-content">  
        <?= $this->Form->input('title', ['autofocus' => 'autofocus']); ?>
        <?= $this->Form->input('category_id'); ?>
        <?= $this->Form->input('content', ['type' => 'textarea', 'class' => 'ckeditor']); ?>
      </div>
    </div> 
  </div>
</div>

<div class="submit-big">
  <?= $this->Form->submit('Save Article', ['bootstrap-type' => 'primary']); ?>
</div>
<?= $this->Form->end() ?>