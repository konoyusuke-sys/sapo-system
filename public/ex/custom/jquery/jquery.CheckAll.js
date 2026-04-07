// JavaScript Document

/**
 * チェックボックス全て選択
 */
$(function(){
	$('.checkAll').on('ifChecked', function(event){
		$('.' + this.id).iCheck('check');
	});
	$('.checkAll').on('ifUnchecked', function(event){
		$('.' + this.id).iCheck('uncheck');
	});
});