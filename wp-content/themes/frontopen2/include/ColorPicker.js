
var SelRGB = "#7F7F7F";
var DrRGB = "#7F7F7F";
var SelGRAY = "120";

var hexch = new Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F");

function $(doc){return document.getElementById(doc)}

function ToHex(n){	
	var h, l;
	n = Math.round(n);
	l = n % 16;
	h = Math.floor((n / 16)) % 16;
	return (hexch[h] + hexch[l]);
}

function DoColor(c, l){ 
	var r, g, b;
	r = "0x" + c.substring(1, 3);
	g = "0x" + c.substring(3, 5);
	b = "0x" + c.substring(5, 7);
	if(l > 120){
		l = l - 120;
		r = (r * (120 - l) + 255 * l) / 120;
		g = (g * (120 - l) + 255 * l) / 120;
		b = (b * (120 - l) + 255 * l) / 120;
	}
	else{
		r = (r * l) / 120;
		g = (g * l) / 120;
		b = (b * l) / 120;
	}
	return "#" + ToHex(r) + ToHex(g) + ToHex(b);
}

function EndColor(){ 
	var i;
	if(DrRGB != SelRGB){
		DrRGB = SelRGB;
		for(i = 0; i <= 30; i ++){
			$("GrayTable").rows[i].bgColor = DoColor(SelRGB, 240 - i * 8);
		}
	}
	$("SelColor").value = DoColor($("RGB").innerHTML, $("GRAY").innerHTML);
	$("ShowColor").bgColor = $("SelColor").value;
}

document.write("<style>#ColorPicker td,#ColorPicker div,#ColorPicker span{font-family:Arial;font-size:12px;}</style>")
document.write("<div id='ColorPicker' style='opacity:1;-moz-opacity:1;filter:alpha(opacity=100);position:absolute; left:0px; top:0px;background:#efefef;border:1px solid #cccccc;padding:10px 20px;display:none;'>")
document.write("<div id='divTitle' style='cursor: move;'><b>颜色选择器V1.0</b></div>")
document.write("<table border='0' cellpadding='0' cellspacing='0'>")
document.write("<tr><td>")
document.write("<table border='0' cellpadding='0' cellspacing='0' id='ColorTable'>")
function wc(r, g, b, n){
	r = ((r * 16 + r) * 3 * (15 - n) + 0x80 * n) / 15;
	g = ((g * 16 + g) * 3 * (15 - n) + 0x80 * n) / 15;
	b = ((b * 16 + b) * 3 * (15 - n) + 0x80 * n) / 15;
	document.write("<td bgcolor=\"#" + ToHex(r) + ToHex(g) + ToHex(b) + "\" height='8' width='8'></td>");
}
var cnum = new Array(1, 0, 0, 1, 1, 0, 0, 1, 0, 0, 1, 1, 0, 0, 1, 1, 0, 1, 1, 0, 0);
for(i = 0; i < 16; i ++){
	document.write("<tr>");
	for(j = 0; j < 30; j ++)
	{
		n1 = j % 5;
		n2 = Math.floor(j / 5) * 3;
		n3 = n2 + 3;
		wc((cnum[n3] * n1 + cnum[n2] * (5 - n1)),
		(cnum[n3 + 1] * n1 + cnum[n2 + 1] * (5 - n1)),
		(cnum[n3 + 2] * n1 + cnum[n2 + 2] * (5 - n1)), i);
	}
	document.writeln("</tr>");
}
document.write("</table>")
document.write("</td><td style='padding-left:10px'>")

document.write("<table border='0' cellpadding='0' cellspacing='0' id='GrayTable'>")
for(i = 255; i >= 0; i -= 8.5){
	document.write("<tr bgcolor=\"#" + ToHex(i) + ToHex(i) + ToHex(i) + "\"><td title=\"" + Math.floor(i * 16 / 17) + "\" height='4' width='20'></td></tr>");
}
document.write("</table>")
document.write("</td></tr>")
document.write("</table>")
document.write("<table height='20' border='0' cellpadding='0' cellspacing='2'><tr><td>选中的色彩</td><td id='ShowColor' width='45' bgcolor='#7F7F7F'></td><td>&nbsp;&nbsp;基色：<SPAN id='RGB'>#7F7F7F</SPAN></td></tr>")
document.write("<tr><td width='60' colspan='2'>亮度：<SPAN id='GRAY'>120</SPAN></td><td>&nbsp;&nbsp;代码：<INPUT id='SelColor' size='7' value='#7F7F7F'></td></tr></table>")
document.write("<div align='center' style='padding:5px'><input type='button' style='border:1px solid #999999; background:#eeeeee' value=' 确定 ' onclick='setColor()'>&nbsp;&nbsp;&nbsp;<input type='button' style='border:1px solid #999999; background:#eeeeee' value=' 取消 ' onclick=\"$('ColorPicker').style.display='none'\"></div>")
document.write("</div>")

var theSBtnObj;
var theInputName;
function CreateCPBtn(inputName,imgUrl){
	var CPBtnStyle;
	if($(inputName).value!="") CPBtnStyle="background:"+$(inputName).value;
    document.write("<img src=\"" + imgUrl + "\" style=\""+CPBtnStyle+"\" align=\"absmiddle\" onClick=\"showColorPicker(this,event,'"+inputName+"')\">")	
}
function showColorPicker(sBtnObj,event,inputName) {
	$("ColorPicker").style.display="";
	$("ColorPicker").style.top=(event.clientY+document.body.scrollTop+15)+"px";
	$("ColorPicker").style.left=(event.clientX)+"px";
	theSBtnObj=sBtnObj;
	theInputName=inputName;
	defaultColor=$(theInputName).value;
	if(defaultColor!=""){
		if(defaultColor.substring(0,1)!="#") defaultColor="#"+defaultColor;
		$("RGB").innerHTML=defaultColor;
		$("ShowColor").bgColor=defaultColor;
		$("SelColor").value=defaultColor;
		SelRGB=defaultColor;
	}else{
		$("RGB").innerHTML="#7F7F7F";
		$("ShowColor").bgColor="#7F7F7F";
		$("SelColor").value="#7F7F7F";
		SelRGB="#7F7F7F";
	}
	EndColor();
}
$("ColorTable").onclick=function(event){
	var event = event || window.event;
	var eEle = event.srcElement ? event.srcElement : event.target;
	SelRGB = eEle.bgColor;
	EndColor();
}
$("ColorTable").onmouseover=function(event){
	var event = event || window.event;
	var eEle = event.srcElement ? event.srcElement : event.target;
	$("RGB").innerHTML = eEle.bgColor;
	EndColor();
}
$("ColorTable").onmouseout=function(){
	$("RGB").innerHTML = SelRGB;
	EndColor();
}
$("GrayTable").onclick=function(event){
	var event = event || window.event;
	var eEle = event.srcElement ? event.srcElement : event.target;
	SelGRAY = eEle.title;
	EndColor();
}
$("GrayTable").onmouseover=function(event){
	var event = event || window.event;
	var eEle = event.srcElement ? event.srcElement : event.target;
	$("GRAY").innerHTML = eEle.title;
	EndColor();
}
$("GrayTable").onmouseout=function(){
	$("GRAY").innerHTML = SelGRAY;
	EndColor();
}

function setColor(){
	$(theInputName).value = $("SelColor").value;
	theSBtnObj.style.background=$("SelColor").value;
	$("ColorPicker").style.display="none";
}

 /*-------------------------鼠标拖动---------------------*/ 
 var od = $("divTitle");
 var odContent = $("ColorPicker"); 
 var dx,dy,mx,my,mouseD;
 var odrag;
 var isIE = document.all ? true : false;
 document.onmousedown = function(e){
  var e = e ? e : event;
  if(e.button == (document.all ? 1 : 0))
  {
   mouseD = true;   
  }
 }
 document.onmouseup = function(){
  mouseD = false;
  odrag = "";
  if(isIE)
  {
   od.releaseCapture();
   odContent.filters.alpha.opacity = 100;
  }
  else
  {
   window.releaseEvents(od.MOUSEMOVE);
   odContent.style.opacity = 1;
  }  
 }
 
 
 //function readyMove(e){ 
 od.onmousedown = function(e){
  odrag = this;
  var e = e ? e : event;
  if(e.button == (document.all ? 1 : 0))
  {
   mx = e.clientX;
   my = e.clientY;
   od.style.left = od.offsetLeft + "px";
   od.style.top = od.offsetTop + "px";
   if(isIE)
   {
    od.setCapture();    
    odContent.filters.alpha.opacity = 70;
   }
   else
   {
    window.captureEvents(Event.MOUSEMOVE);
    odContent.style.opacity = 0.7;
   }
  } 
 }
 document.onmousemove = function(e){
  var e = e ? e : event;
  if(mouseD==true && odrag)
  {  
   var mrx = e.clientX - mx;
   var mry = e.clientY - my; 
   od.style.left = parseInt(od.style.left) +mrx + "px";
   od.style.top = parseInt(od.style.top) + mry + "px";   
   odContent.style.left = parseInt(odContent.style.left) +mrx + "px";
   odContent.style.top = parseInt(odContent.style.top) + mry + "px";   
   mx = e.clientX;
   my = e.clientY;
   
  }
 }