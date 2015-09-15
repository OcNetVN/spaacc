/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    //config.extraPlugins = 'Zoom';
    
	// Toolbar configuration generated automatically by the editor based on config.toolbarGroups.
    config.toolbar = [
    	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source'] },
    	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
    	//{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
    	//{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
    	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
        '/',
    	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
    	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
    	'/',
    	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
    	{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
    ];
    
    config.filebrowserBrowseUrl= 'http://loyhongo.com/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl= 'http://loyhongo.com/ckfinder/ckfinder.html?Type=Images';
    config.filebrowserFlashBrowseUrl= 'http://loyhongo.com/ckfinder/ckfinder.html?Type=Flash';
    config.filebrowserUploadUrl= 'http://loyhongo.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl= 'http://loyhongo.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl= 'http://loyhongo.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
    
    

};
