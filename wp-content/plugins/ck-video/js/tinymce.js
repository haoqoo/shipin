function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

/* 集数前面补零 */  
function pad(num, n) {  
    var len = num.toString().length;  
    while(len < n) {  
        num = "0" + num;  
        len++;  
    }  
    return num;  
}  


function insertCK_Videocode() {
    var str = document.getElementById("cvurl").value;
	var strurl = str.split("||");
	var num = strurl.length;
    var startnum = parseInt(document.getElementById("startnum").value);
    var linenum = parseInt(document.getElementById("linenum").value);
	var endnum = num +startnum;
    var cvurl = " url=\"" + strurl[0]+"\"";
	var cvwidth = " width=\"" + document.getElementById("cvwidth").value+"\"";
	var cvheight = " height=\"" + document.getElementById("cvheight").value+"\"";
	var cvname = document.getElementById("cvname").value;
	if(document.getElementById("auto").checked){
	     var auto = " auto=\"1\" ";
		 }else auto = " auto=\"0\" ";
	var shortcode = "" ;
	if(num > 1){
	for(var i = 0; i < num ; i++)
		{
			cvurl = " url=\"" + strurl[i]+"\"";
			shortcode = shortcode+"[ckvideonext  "+ " auto=\"1\" " + cvurl + "]" + cvname + "第" + pad(startnum,endnum.toString().length) + "集" + "[/ckvideonext]" + "&nbsp;&nbsp;&nbsp;&nbsp;";
			startnum += 1 ;
			if(startnum%linenum == 1){shortcode +=  "<br></br>"}

		}
	}
	cvurl = " url=\"" + strurl[0]+"\"";
	shortcode = "[ckvideo  "+ auto + cvwidth + cvheight + cvurl + "]" + cvname + "[/ckvideo]"  + "<br></br>" + shortcode;
	window.tinyMCE.activeEditor.insertContent(shortcode);
	tinyMCEPopup.editor.execCommand('mceRepaint');
	tinyMCEPopup.close();
	return;
			   
}

function clearText() {
		document.getElementById("cvurl").value="";
		document.getElementById("cvname").value="";
}
// 多集连播框
function moreURLdiv(){
  if(document.getElementById('moreurl').checked){
      document.getElementById("cvurl").rows="10";
  }else     document.getElementById("cvurl").rows="1";
  document.getElementById('moreurldiv').style.display = document.getElementById('moreurldiv').style.display=='none'?'block':'none';
}
//官方地址
 function iframeurl(url)
{
  document.getElementById("video").src=url;
}
 function choice(url1,url2)
{ 
  if(document.getElementById("iframeurlcheck2").checked){
  document.getElementById("video").src=url2;
  }else{document.getElementById("video").src=url1;}
  
}