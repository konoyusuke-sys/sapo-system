// JavaScript Document

/**
 * modal confirm起動
 */
$(function(){
	$('.openConfirm').click(function(){
		var current = $(this);
		
		if ($(this).attr('data-title')) {
			$('#myConfirm .modal-content .modal-title').text($(this).attr('data-title'));
		}
		if ($(this).attr('data-comment')) {
			$('#myConfirm .modal-content .modal-body').html("<p>" + $(this).attr('data-comment') + "</p>");
		}
		
		$('#myConfirm').modal({
			show:true
		});
		$('#myConfirm').on('click', '.modal-footer .btn-primary', function(){
			$('#myConfirm').modal('hide');
			$(current).parent('form').submit();
		});
	});
	$('.openConfirmSend').click(function(){
		var current = $(this);
		
		if ($(this).attr('data-title')) {
			$('#myConfirmSend .modal-content .modal-title').text($(this).attr('data-title'));
		}
		if ($(this).attr('data-comment')) {
			$('#myConfirmSend .modal-content .modal-body').html("<p>" + $(this).attr('data-comment') + "</p>");
		}
		
		$('#myConfirmSend').modal({
			show:true
		});
		$('#myConfirmSend').on('click', '.modal-footer .btn-primary', function(){
			$('#myConfirmSend').modal('hide');
			$(current).parents('form').submit();
		});
	});
});