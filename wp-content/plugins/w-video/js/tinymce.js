function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function insertCK_Videocode() {
    var str = document.getElementById("cvurl").value;

	//var cvwidth = " width=\"" + document.getElementById("cvwidth").value+"\"";
	//var cvheight = " height=\"" + document.getElementById("cvheight").value+"\"";

	var shortcode = "[swf]"+str+"[/swf]";
	
	//cvurl = " url=\"" + strurl[0]+"\"";
	//shortcode = "[ckvideo  "+ auto + cvwidth + cvheight + cvurl + "]" + cvname + "[/ckvideo]"  + "<br></br>" + shortcode;
	window.tinyMCE.activeEditor.insertContent(shortcode);
	tinyMCEPopup.editor.execCommand('mceRepaint');
	tinyMCEPopup.close();
	return;
			   
}

function clearText() {
		document.getElementById("cvurl").value="";
		//document.getElementById("cvname").value="";
}
