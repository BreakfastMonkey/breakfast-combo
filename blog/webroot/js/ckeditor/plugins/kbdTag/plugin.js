CKEDITOR.plugins.add( 'kbdTag', {
  icons: 'kbd',
  init: function( editor ) {
    editor.addCommand( 'wrapKbd', {
      exec: function( editor ) {
        editor.insertHtml( '<kbd>' + editor.getSelection().getSelectedText() + '</kbd>' );
      }
    });
    editor.ui.addButton( 'kbd', {
      label: 'Wrap kbd',
      command: 'wrapKbd',
      toolbar: 'insert'
    });
  }
});