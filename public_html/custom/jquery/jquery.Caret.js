/**
 * 差込タグ
 * 
 * http://archiva.jp/web/javascript/getRange_in_textarea.html
 * http://ok2nd.blog87.fc2.com/blog-entry-246.html
 * http://ok2nd.blog87.fc2.com/blog-entry-129.html
 */

function surroundHTML(tag, obj) {
	var target = document.getElementById(obj);
	var pos = getAreaRange(target);
	
	var insertNode;
	insertNode = '%%' + tag + '%%';
	
	
	if (isIE && (pos.start == pos.end)) {
		target.focus();
		var selection = document.selection.createRange();
		selection.text = insertNode + selection.text;
		return;
	}
	
	var val = target.value;
	var range = val.slice(pos.start, pos.end);
	var beforeNode = val.slice(0, pos.start);
	var afterNode  = val.slice(pos.end);
	
	if (range || pos.start != pos.end) {
		//insertNode = '<' + tag + '>' + range + '</' + tag + '>';
		target.value = beforeNode + insertNode + afterNode;
	} else if (pos.start == pos.end) {
		//insertNode = '<' + tag + '>' + '</' + tag + '>';
		target.value = beforeNode + insertNode + afterNode;
	}
	
	target.focus();
	
	if (isIE) {
		r = target.createTextRange();
		
		if (retmatch = beforeNode.match(/\r\n/g)) {
			retnum = retmatch.length;
		} else {
			retnum = 0;
		}
		
		if (range) {
			if (retmatch = range.match(/\r\n/g)) {
				retnum += retmatch.length;
			}
		}
		
		r.move('character', pos.end + insertNode.length - retnum);
		r.select();
	} else {
		var newpos = pos.end + insertNode.length - range.length;
		target.setSelectionRange(newpos, newpos);
	}
}

function getAreaRange(obj) {
	var pos = new Object();
	
	if (isIE) {
		obj.focus();
		var range = document.selection.createRange();
		var clone = range.duplicate();
		
		clone.moveToElementText(obj);
		clone.setEndPoint( 'EndToEnd', range );
		
		pos.start = clone.text.length - range.text.length;
		//pos.end   = clone.text.length - range.text.length + range.text.length;
		pos.end   = clone.text.length - range.text.length;
	} else if(window.getSelection()) {
		pos.start = obj.selectionStart;
		pos.end   = obj.selectionEnd;
	}

	return pos;
//	alert(pos.start + "," + pos.end);
}

var isIE = (navigator.appName.toLowerCase().indexOf('internet explorer')+1?1:0);