// JavaScript Document

$(function(){
	/**
	 * modal iframe起動
	 */
	/*
	$('.openModal').click(function(){
		var height = $(window).height() - 120;
    	$('.modal-body').css('height', height);
    	
		$('#myModal iframe').attr("src", $(this).attr('data-href'));
		
		$('#myModal').modal({
			show:true
		});
	});
	*/
	
	/**
	 * modal シャットダウン
	 */
	/*
	$.hideModal = function() {
		$('#myModal').modal('hide');
	};
	*/
	
	/**
	 * 画像解除
	 */
	$('.resetFile').click(function() {
		var target = $(this).attr('data-target');
		var noimage = $(this).attr('data-noimage');
		var preview = $(this).attr('data-preview');
		
		var fileId = $(':hidden[name="' + target + '_id"]').val();
		var fileName = $(':hidden[name="' + target + '_name"]').val();
		
		if (!preview) {
			var preview = target;
		}
		
		$(':hidden[name="' + target + '_name"]').val('');
		$(':hidden[name="' + target + '_id"]').val('');
		$('.' + preview + '_preview').attr("src", noimage);
		
		$('<input>').attr({
			type: 'hidden',
			name: target + '_delete',
			value: fileId
		}).appendTo($(this).parents('form'));
	});
});