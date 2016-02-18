<!DOCTYPE html>
<html>
  <head>
    <?= $this->Html->charset() ?>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webkits Blog: <?= trim(strip_tags($title)) ?></title>
    
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
  
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('plugins/iCheck/custom.css') ?>
  
    <?= $this->fetch('css') ?>
    
  </head>
  <body>