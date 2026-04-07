// JavaScript Document

/**
 * modal iframe起動
 */
$(function(){
	$('.openModal').click(function(){
		$('#myModal iframe').attr("src", $(this).attr('data-href'));
		$('#myModal').modal({
			show:true
		});
	});
});