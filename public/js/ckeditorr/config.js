/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

// CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.uiColor = '#AADC6E';

// };

CKEDITOR.editorConfig = function( config ) {
	config.language = 'id';
	config.toolbarGroups = [
	{ name: 'document', groups: [ 'document', 'doctools', 'mode' ] },
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
	{ name: 'forms', groups: [ 'forms' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
	'/',
	{ name: 'links', groups: [ 'links' ] },
	{ name: 'insert', groups: [ 'insert' ] },
	{ name: 'styles', groups: [ 'styles' ] },
	'/',
	{ name: 'colors', groups: [ 'colors' ] },
	{ name: 'tools', groups: [ 'tools' ] },
	{ name: 'others', groups: [ 'others' ] },
	{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'Save,NewPage,Print,Source,PasteText,PasteFromWord,Scayt,Form,TextField,Textarea,Select,Checkbox,Radio,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Iframe,About,Flash';
};