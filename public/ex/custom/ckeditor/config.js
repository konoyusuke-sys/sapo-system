/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	// スキン
	config.skin = 'icy_orange';
	//config.skin = 'office2013';
	
	// HTMLソースの手動編集を行えるように、コードの自動整形を止める。
	config.allowedContent = true;
	
	// スペルチェック機能OFF
	config.scayt_autoStartup = false;
	
	// テンプレート挿入時に編集中の内容と置き換えるデフォルトのチェックを外す。
	config.templates_replaceContent = false;

	// Enterを押した際に改行タグを挿入
	config.enterMode = CKEDITOR.ENTER_BR;

	// Shift+Enterを押した際に段落タグを挿入
	config.shiftEnterMode = CKEDITOR.ENTER_P;

	// フォーマットタグの指定
	config.format_tags = 'p;h2;h3;h4;h5;h6;pre;div';

	// 編集領域にCSSファイルを読み込みたい（複数）
	//config.contentsCss = ['/css/mysitestyles.css', '/css/anotherfile.css'];

	// 編集領域にclassを指定したい
	//config.bodyClass = '';

	// 編集領域にidを指定したい
	//config.bodyId  = '';
	
	// 言語設定を日本語に
	config.language = 'ja';
	
	// エディタのサイズを指定
	//config.width = '480px';
	//config.height = '500px';
	
	// エディタのリサイズを無効に
	config.resize_enabled = 0;
	config.toolbarCanCollapse = 0;
	config.startupShowBorders = 0;
	CKEDITOR.config.tabSpaces = 4;
	
	 // 文字参照に変換する文字
	 config.entities_additional = '#9312,#9313,#9314,#9315,#9316,#9317,#9318,' +
	 							'#9319,#9320,#9321,#9322,#9323,#9324,#9325,' +
	 							'#9326,#9327,#9328,#9329,#9330,#9331';
	
	// 使用するプラグイン
	plugins:
	// "dialogui,dialog,about,a11yhelp,dialogadvtab," +
	"basicstyles," +
	// "bidi,blockquote," +
	"clipboard," +
	// "button,panelbutton,panel,floatpanel,colorbutton,colordialog,templates,menu," +
	"div," +
	// "resize," +
	"toolbar," +
	// "enterkey,entities,popup,filebrowser,find,fakeobjects,flash,floatingspace,listblock,richcombo," +
	"font," +
	// "forms,format,horizontalrule,htmlwriter,iframe," +
	"wysiwygarea,image," +
	// "indent,indentblock,indentlist,smiley," +
	"justify," +
	// "menubutton,language,link,list,magicline,maximize,newpage,pagebreak,pastetext,pastefromword,preview,print,removeformat,save,selectall,showblocks,showborders,sourcearea,specialchar,stylescombo,tab,table,undo,wsc" +
	"",
	
	config.toolbar = [
		['Undo','Redo','-','Cut','Copy','Paste',],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['NumberedList','BulletedList'],
		['Outdent','Indent'],
		['Table'],
		['Maximize','ShowBlocks'],
		['Source'],
		'/',
		['Format','FontSize'],
		['Bold','Italic','Underline','Strike'],
		['TextColor','BGColor'],
		['RemoveFormat'],
		['Blockquote','CreateDiv'],
		['Link','Unlink','Anchor'],
		['Image','HorizontalRule','Nbsp']
	];
	/*default*/
	/*
	config.toolbar = [
		['Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'],
		['Find','Replace'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['NumberedList','BulletedList'],
		['Outdent','Indent'],
		['Table'],
		['Source','Maximize','ShowBlocks'],
		'/',
		['Format','FontSize'],
		['Bold','Italic','Underline','Strike','Subscript','Superscript'],
		['TextColor','BGColor'],
		['RemoveFormat'],
		['Blockquote','CreateDiv'],
		['Link','Unlink','Anchor'],
		['Image','HorizontalRule','Nbsp']
	];
	*/
};
