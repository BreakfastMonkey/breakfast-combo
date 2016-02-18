    <?php
      echo $this->Html->script([
        'jquery-2.1.1',
        'bootstrap.min',
        
        'plugins/metisMenu/jquery.metisMenu',
        'plugins/slimscroll/jquery.slimscroll.min',
        'plugins/pace/pace.min',
        'plugins/iCheck/icheck.min',
        
        'jquery-ui-1.10.4.min',
        'jquery-ui.custom.min',
        
        'inspinia',
      ]);
      
      echo $this->Html->scriptBlock("
        
        $('.i-checks').iCheck({
          checkboxClass: 'icheckbox_square-green',
          radioClass: 'iradio_square-green',
          increaseArea: '20%' // optional
        });
        
      ", ['block' => true]);
      
      echo $this->fetch('script');
    ?>
  </body>
</html>