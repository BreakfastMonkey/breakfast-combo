/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

/**
 * @fileOverview Image plugin based on Widgets API
 */

'use strict';

CKEDITOR.dialog.add( 'image2', function( editor ) {

	// RegExp: 123, 123%, empty string ""
	var regexGetSizeOrEmpty = /(^\s*(\d+)(\%)?\s*$)|^$/i,

	lang = editor.lang.image2,
	commonLang = editor.lang.common,

	helpers = CKEDITOR.plugins.image2,

	// Editor instance configuration.
	config = editor.config,

	// Content restrictions defined by the widget which
	// impact on dialog structure and presence of fields.
	features = editor.widgets.registered.image.features,
	
	// Functions inherited from image2 plugin.
	checkHasNaturalRatio = helpers.checkHasNaturalRatio,
	getNatural = helpers.getNatural,

	// Global variables referring to the dialog's context.
	doc, widget, image,

	// Global variable referring to this dialog's image pre-loader.
	preLoader,
	
	// Global variables holding the original size of the image.
	domWidth,
	
	// Global variables related to image pre-loading.
	preLoadedWidth, srcChanged,

	// Global variables referring to dialog fields and elements.
	widthField, maxWidthField,

	natural;
	


	
	
	// Validates dimension. Allowed values are:
	// "123%", "123", "" (empty string)
	function validateDimension() {
		var match = this.getValue().match( regexGetSizeOrEmpty ),
			isValid = !!( match && parseInt( match[ 1 ], 10 ) !== 0 );

		if ( !isValid )
			alert( commonLang[ 'invalid' + CKEDITOR.tools.capitalize( this.id ) ] );

		return isValid;
	}

	
	
	
	// Creates a function that pre-loads images. The callback function passes
	// [image, width, height] or null if loading failed.
	//
	// @returns {Function}
	function createPreLoader() {
		var image = doc.createElement( 'img' ),
			listeners = [];

		function addListener( event, callback ) {
			listeners.push( image.once( event, function( evt ) {
				removeListeners();
				callback( evt );
			} ) );
		}

		function removeListeners() {
			var l;

			while ( ( l = listeners.pop() ) )
				l.removeListener();
		}

		// @param {String} src.
		// @param {Function} callback.
		return function( src, callback, scope ) {
			addListener( 'load', function() {
				// Don't use image.$.(width|height) since it's buggy in IE9-10 (#11159)
				var dimensions = getNatural( image );

				callback.call( scope, image, dimensions.width );
			} );

			addListener( 'error', function() {
				callback( null );
			} );

			addListener( 'abort', function() {
				callback( null );
			} );

			image.setAttribute( 'src',
				( config.baseHref || '' ) + src + '?' + Math.random().toString( 16 ).substring( 2 )
			);
		};
	}
	
	
	// This function updates width and height fields once the
	// "src" field is altered. Along with dimensions, also the
	// dimensions lock is adjusted.
	function onChangeSrc() {
		var value = this.getValue();
		
		// Remember that src is different than default.
		if ( value !== widget.data.src ) {
			
			// Update dimensions of the image once it's preloaded.
			preLoader( value, function( image, width ) {
				
				// Fill maxWidth field with the width of the new image.
				maxWidthField.setValue( width );
				
				// Cache the new width.
				preLoadedWidth = width;
			} );

			srcChanged = true;
		}

		// Value is the same as in widget data but is was
		// modified back in time. Roll back dimensions when restoring
		// default src.
		else if ( srcChanged ) {
			
			// Restore width field with cached width.
			maxWidthField.setValue( domWidth );

			// Src equals default one back again.
			srcChanged = false;
		}

		// Value is the same as in widget data and it hadn't
		// been modified.
		else {
			
		}
	}
	
	

	var hasFileBrowser = !!( config.filebrowserImageBrowseUrl || config.filebrowserBrowseUrl ),
		srcBoxChildren = [
			{
				id: 'src',
				type: 'text',
				label: commonLang.url,
				
				onKeyup: onChangeSrc,
				onChange: onChangeSrc,
				
				setup: function( widget ) {
					this.setValue( widget.data.src );
				},
				
				commit: function( widget ) {
					widget.setData( 'src', this.getValue() );
				},
				
				validate: CKEDITOR.dialog.validate.notEmpty( lang.urlMissing )
			}
		];

	// Render the "Browse" button on demand to avoid an "empty" (hidden child)
	// space in dialog layout that distorts the UI.
	if ( hasFileBrowser ) {
		srcBoxChildren.push( {
			type: 'button',
			id: 'browse',
			// v-align with the 'txtUrl' field.
			// TODO: We need something better than a fixed size here.
			style: 'display:inline-block;margin-top:18px;',
			align: 'center',
			label: editor.lang.common.browseServer,
			hidden: true,
			filebrowser: 'info:src'
		} );
	}

	return {
		title: lang.title,
		minWidth: 250,
		minHeight: 100,
		
		onLoad: function() {
			// Create a "global" reference to the document for this dialog instance.
			doc = this._.element.getDocument();

			// Create a pre-loader used for determining dimensions of new images.
			preLoader = createPreLoader();
		},
		
		onShow: function() {
			// Create a "global" reference to edited widget.
			widget = this.widget;

			// Create a "global" reference to widget's image.
			image = widget.parts.image;
			
			// Reset global variables.
			srcChanged = false;
			
			// Natural dimensions of the image.
			natural = getNatural( image );
			
			// Get the natural width of the image.
			preLoadedWidth = domWidth = natural.width;

			// Get the natural height of the image.
			//preLoadedHeight = domHeight = natural.height;
		},
		
		contents: [
			{
				id: 'info',
				label: lang.infoTab,
				elements: [
					{
						type: 'vbox',
						padding: 0,
						children: [
							{
								type: 'hbox',
								widths: [ '100%' ],
								children: srcBoxChildren
							}
						]
					},
					
					{
						id: 'alt',
						type: 'text',
						label: lang.alt,
						setup: function( widget ) {
							this.setValue( widget.data.alt );
						},
						commit: function( widget ) {
							widget.setData( 'alt', this.getValue() );
						}
					},
					
					{
						type: 'hbox',
						children: [
							{
								type: 'text',
								width: '45px',
								id: 'width',
								label: commonLang.width + ' (%)',
								validate: validateDimension,
								
								onLoad: function() {
									widthField = this;
								},
								
								setup: function( widget ) {
									this.setValue( widget.data.width );
								},
								
								commit: function( widget ) {
									widget.setData( 'width', this.getValue() );
								}
							},
							
							{
								type: 'text',
								hidden: true,
								width: '45px',
								id: 'maxWidth',
								label: 'Max ' + commonLang.width + ' (px)',
								
								onLoad: function() {
									maxWidthField = this;
								},
								
								setup: function( widget ) {
									this.setValue( widget.data.maxWidth );
								},
								
								commit: function( widget ) {
									widget.setData( 'maxWidth', this.getValue() );
								}
							}
						]
					},
					
					{
						type: 'hbox',
						id: 'alignment',
						requiredContent: features.align.requiredContent,
						children: [
							{
								id: 'align',
								type: 'radio',
								items: [
									[ commonLang.alignNone, 'none' ],
									[ commonLang.alignLeft, 'left' ],
									[ commonLang.alignCenter, 'center' ],
									[ commonLang.alignRight, 'right' ] ],
								label: commonLang.align,
								setup: function( widget ) {
									this.setValue( widget.data.align );
								},
								commit: function( widget ) {
									widget.setData( 'align', this.getValue() );
								}
							}
						]
					},
					
					{
						type: 'vbox',
						padding: 0,
						children: [
							
							{
								type: 'html',
								html: '<label>Margins</label>',
							},
							
							{
								type: 'hbox',
								children: [
									
									{
										type: 'checkbox',
										id: 'marginTop',
										label: 'Top',
										setup: function( widget ) {
											this.setValue( widget.data.marginTop );
										},
										commit: function( widget ) {
											widget.setData( 'marginTop', this.getValue() );
										}
									},
									
									{
										type: 'checkbox',
										id: 'marginLeft',
										label: 'Left',
										setup: function( widget ) {
											this.setValue( widget.data.marginLeft );
										},
										commit: function( widget ) {
											widget.setData( 'marginLeft', this.getValue() );
										}
									},
									
									{
										type: 'checkbox',
										id: 'marginBottom',
										label: 'Bottom',
										setup: function( widget ) {
											this.setValue( widget.data.marginBottom );
										},
										commit: function( widget ) {
											widget.setData( 'marginBottom', this.getValue() );
										}
									},
									
									{
										type: 'checkbox',
										id: 'marginRight',
										label: 'Right',
										setup: function( widget ) {
											this.setValue( widget.data.marginRight );
										},
										commit: function( widget ) {
											widget.setData( 'marginRight', this.getValue() );
										}
									},
								]
							}
						]
					},
					
					{
						id: 'hasCaption',
						type: 'checkbox',
						label: lang.captioned,
						requiredContent: features.caption.requiredContent,
						setup: function( widget ) {
							this.setValue( widget.data.hasCaption );
						},
						commit: function( widget ) {
							widget.setData( 'hasCaption', this.getValue() );
						}
					}
				]
			},
			
			{
				id: 'Upload',
				hidden: true,
				filebrowser: 'uploadButton',
				label: lang.uploadTab,
				elements: [
					{
						type: 'file',
						id: 'upload',
						label: lang.btnUpload,
						style: 'height:40px'
					},
					{
						type: 'fileButton',
						id: 'uploadButton',
						filebrowser: 'info:src',
						label: lang.btnUpload,
						'for': [ 'Upload', 'upload' ]
					}
				]
			}
		]
	};
	
});