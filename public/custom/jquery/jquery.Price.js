/**
 * 3桁ごとにカンマを付ける
 */
$(function(){
	$('.price-format')
	.focusout(function(){
		var str = $(this).val();
		str = str.replace(/,/g,'');
		if (str.match(/^(|-)[0-9]+$/)) {
			str = str.replace(/^[0]+([0-9]+)/g, '$1');
			str = str.replace(/([0-9]{1,3})(?=(?:[0-9]{3})+$)/g, '$1,');
		}
		$(this).val(str);
	})
	.focusin(function() {
		var str = $(this).val();
		str = str.replace(/,/g, '');
		$(this).val(str);
	})
	.keyup(function(){
		var s = new Array();
		$.each($(this).val().split(''), function(i, v){
			if( v.match(/[0-9]/gi) ) s.push(v);
		});
		if(s.length > 0) $(this).val( s.join('') );
		else $(this).val(''); 
	});
});