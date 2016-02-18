<?= $this->element('Template/head'); ?>

<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>

<?= $this->element('Template/foot'); ?>
