/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	
	// Config
	config.language = 'en';
	config.height = 500;
	config.resize_dir = 'vertical';
	config.toolbarCanCollapse = true;
	config.contentsCss = '/css/ckeditor.css';
	config.bodyClass = 'container';
	config.bodyId = 'content';
	
	// Allow anything
	config.allowedContent = true;
	
	config.toolbar = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Maximize', '-', 'Source', '-', 'ShowBlocks' ] },
		{ name: 'clipboard', groups: [  'undo', 'clipboard' ], items: [ 'Undo', 'Redo', '-', 'PasteText', 'PasteFromWord', '-', 'Scayt' ] },
		//{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
		//{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
		{ name: 'insert', items: [ 'NumberedList', 'BulletedList', '-', 'Blockquote', 'Table', '-', 'HorizontalRule', 'SpecialChar', '-', 'doksoft_instant_file' ] },
		{ name: 'images', items: [ 'Image', 'doksoft_instant_image'] },
		{ name: 'tools' },
		{ name: 'others' },
		'/',
		{ name: 'styles', items: [ 'Styles', /*'Format', 'Font', 'FontSize'*/ ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', groups: [ 'align', 'indent', 'blocks', 'bidi' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Outdent', 'Indent' ] },
		//{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		//{ name: 'about' }
	];
	
	// Overall Setup
	config.removeButtons = '';
	config.removeDialogTabs = 'link:advanced,images:advanced';
	config.extraPlugins = 'tab,widget,lineutils,doksoft_instant_image,doksoft_instant_file,imagebrowser,linkbrowser';
	
	// Uploader
	config.doksoft_uploader_url = '/js/ckeditor/plugins/doksoft_uploader/uploader.php';
	
	// Browse Server Buttons
	config.imageBrowser_listUrl = '/admin/app/images';
	config.linkBrowser_listUrl = '/admin/app/links';
	
	// Spell Checker
	config.disableNativeSpellChecker = false;
	config.scayt_autoStartup = true;
	config.scayt_sLang = 'en_CA';
	config.scayt_contextCommands = 'ignore|add|ignoreall';
	config.scayt_uiTabs = '1,0,0';
	
};