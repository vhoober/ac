/********** Swazz Javascript Calendar **********/
// v 1.0 3rd November 2006
// By Oliver Bryant
// http://calendar.swazz.org
// Modified by: Ziyad Goulamgookhan for Orinux ltd (http://www.orinux.com)
// Modified by: Dannisen Chellen for Orinux ltd (http://www.orinux.com)

function getObj(objID){
	if (document.getElementById) {return document.getElementById(objID);}
	else if (document.all) {return document.all[objID];}
	else if (document.layers) {return document.layers[objID];}
} // end function



function checkClick(e) {
	e?evt=e:evt=event;
	CSE=evt.target?evt.target:evt.srcElement;
	if (getObj('fc'))
	if (!isChild(CSE,getObj('fc')))
	getObj('fc').style.display='none';
} // end function



function isChild(s,d) {
	while(s) {
		if (s==d)
		return true;
		s=s.parentNode;
	}
	return false;
} // end function
	


function Lefty(obj){
	var curleft = 0;
	if (obj.offsetParent){
		while (obj.offsetParent){
		curleft += obj.offsetLeft
		obj = obj.offsetParent;
		}
	}
	else if (obj.x)
		curleft += obj.x;
	return curleft;
} // end function



function Topty(obj){
	var curtop = 0;
	if (obj.offsetParent){
		while (obj.offsetParent){
			curtop += obj.offsetTop
			obj = obj.offsetParent;
		}
	}
	else if (obj.y)
		curtop += obj.y;
	return curtop;
} // end function

//Change Z-index if working with IE, if higher than Z-indexes of items in html, calendar will
//display above the other items
//document.write('<table id="fc" style="Z-INDEX: 999;position:absolute;top:356px;left:380px;border-collapse:collapse;background:#FFFFFF;border:1px solid #ABABAB;display:none" cellpadding=2>');
//First row of table, holds current month and year
//document.write('<tr><td style="cursorointer" onclick="csubm()"><img src="images/caldown.gif"></td><td colspan=5 id="mns" align="center" style="font:bold 13px Arial"></td><td align="right" style="cursorointer" onclick="caddm()"><img src="images/calup.gif"></td></tr>');
//Second row of year, holds weekday names
//document.write('<tr><td align=center style="background:#6495ED;font:10px Arial;Color:#FFFFFF">Sun</td><td align=center style="background:#6495ED;font:10px Arial;Color:#FFFFFF ">Mon</td><td align=center style="background:#6495ED;font:10px Arial;Color:#FFFFFF ">Tue</td><td align=center style="background:#6495ED;font:10px Arial;Color:#FFFFFF">Wed</td><td align=center style="background:#6495ED;font:10px Arial;Color:#FFFFFF">Thu</td><td align=center style="background:#6495ED;font:10px Arial;Color:#FFFFFF">Fri</td><td align=center style="background:#6495ED;font:10px Arial;Color:#FFFFFF">Sat</td></tr>');

document.write('<table id="fc" style="Z-INDEX:999;position:absolute;border-collapse:collapse;background:#47668c;border:1px solid #555555;display:none" cellpadding=2>');
document.write('<tr><td style="cursor:pointer" onclick="csubm()" style="background-color:#47668c;">&laquo;</td><td colspan=5 id="mns" align="center" style="font:bold 13px Arial;color:#FFFFFF;background-color:#47668c"></td><td align="right" style="cursor:pointer" style="background-color:#47668c" onclick="caddm()">&raquo;&nbsp;&nbsp;</td></tr>');
document.write('<tr><td align=center style="background:#1C1C1C;font:12px Arial;color:#ffffff">D</td><td align=center style="background:#1C1C1C;font:12px Arial;color:#ffffff">L</td><td align=center style="background:#1C1C1C;font:12px Arial;color:#ffffff">M</td><td align=center style="background:#1C1C1C;font:12px Arial;color:#ffffff">M</td><td align=center style="background:#1C1C1C;font:12px Arial;color:#ffffff">J</td><td align=center style="background:#1C1C1C;font:12px Arial;color:#ffffff">V</td><td align=center style="background:#1C1C1C;font:12px Arial;color:#ffffff">S</td></tr>');


//Used to make sunday the first day of the week
for(var kk=1;kk<=6;kk++) {
	document.write('<tr>');
	//Play with this for loop's parameters to change starting day of week
	for(var tt=1;tt<=7;tt++) {
		num=7 * (kk-1) - (-tt);
		document.write('<td id="v' + num + '" style="width:18px;height:18px"> </td>');
	}
	document.write('</tr>');
}

//Used to have Monday as the first day of the week
//for(var kk=1;kk<=6;kk++)
//{
// document.write('<tr>');
//Play with this for loop parameters to change starting day of week
// for(var tt=-5;tt<=1;tt++) {
// num=7 * (kk-1) - (-tt);
// document.write('<td id="v' + num + '" style="width:18px;height:18px; background-color:#C4D3EA; border:solid 1px #6487AE"> </td>');
// }
// document.write('</tr>');
//}

document.write('</table>');

document.all?document.attachEvent('onclick',checkClick):document.addEventListener('click',checkClick ,false);


// Calendar script
var now = new Date;
var sccm=now.getMonth();
var sccy=now.getFullYear();
var ccm=now.getMonth();
var ccy=now.getFullYear();
var selectedMonth = now.getMonth();
var selectedDay=now.getDate();
var currentYear = now.getFullYear();
var updobj;

//Determines if the background is the current date or not
var selectedDate = false;



function getPosition(pObject) {
	var x = y = 0;
	if (pObject.offsetParent) 
	{
		x = pObject.offsetLeft
		y = pObject.offsetTop
		while (pObject = pObject.offsetParent) 
		{
			x += pObject.offsetLeft
			y += pObject.offsetTop
		}
	}
	tArray = new Array();
	tArray['x'] = x;
	tArray['y'] = y;
	return tArray;
}// end function getPosision



function lcs(ielem) {
	updobj=ielem;

//	getObj('fc').style.left=Lefty(ielem);
//	getObj('fc').style.top=Topty(ielem)+ielem.offsetHeight;

	pos = getPosition(ielem);
	getObj('fc').style.left = pos['x']+'px';
	getObj('fc').style.top = (pos['y']+20)+'px';
	

	getObj('fc').style.display='';
	
	// First if check date is valid
	curdt=ielem.value;
	curdtarr=curdt.split('/');
	isdt=true;
	for(var k=0;k<curdtarr.length;k++) {
		if (isNaN(curdtarr[k]))
		isdt=false;
	}
	if (isdt&(curdtarr.length==3)) {
		ccm=curdtarr[1]-1;
		ccy=curdtarr[0];
		selectedDay=curdtarr[2];
		selectedMonth = curdtarr[1]-1;
		
		//a bug will occur when the date format is changed where the
		//wrong year will be displayed when the user clicks on the calendar again
		//after choosing a date, to fix this, the following line must be changed in
		//accordance with the current date format. Currently the format of the
		//date is YYYY/MM/DD, so curdtarr[2] represents the year,
		//curdtarr[1]-1 represents the month, and curdtarr[0] represents the day
		//If the date format is changed to MM/DD/YYYY, the first parameter becomes curdtarr[1],
		//the second paramter becomes curdtarr[0]-1, and the third parameter
		//becomes curdtarr[2].
		prepcalendar(curdtarr[2],curdtarr[1]-1,curdtarr[0]);
	}
	
} // end function



function evtTgt(e){
	var el;
	if(e.target)el=e.target;
	else if(e.srcElement)el=e.srcElement;
	if(el.nodeType==3)el=el.parentNode; // defeat Safari bug
	return el;
} // end function



function EvtObj(e){
	if(!e)e=window.event;return e;
} // end function



//Affects color when mouse hovers over date
function cs_over(e) {
//	evtTgt(EvtObj(e)).style.background='#EEFFFF';
	evtTgt(EvtObj(e)).style.background='#47668c';
	evtTgt(EvtObj(e)).style.color='#FFFFFF';
} // end function



//changes color back when mouse moves away from the date
function cs_out(e) {
//	evtTgt(EvtObj(e)).style.background='#C4D3EA';
	evtTgt(EvtObj(e)).style.background='#555555';
	evtTgt(EvtObj(e)).style.color='#FFFFFF';
} // end function



function cs_click(e) {
	updobj.value=calvalarr[evtTgt(EvtObj(e)).id.substring(1,evtTgt(EvtObj(e)) .id.length)];
	getObj('fc').style.display='none';
} // end function



//var mn=new Array('JAN','FEB','MAR','APR','MAY','JUN','JUL','A UG','SEP','OCT','NOV','DEC');
var mn=new Array('janvier','fevrier','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre');
var mnn=new Array('31','28','31','30','31','30','31','31','30' ,'31','30','31');
var mnl=new Array('31','29','31','30','31','30','31','31','30' ,'31','30','31');
var calvalarr=new Array(42);



// mouse over cell
function f_cps(obj) {
	obj.style.background='#555555';
	obj.style.font='10px Arial';
	obj.style.color='#FFFFFF';
	obj.style.textAlign='center';
	obj.style.textDecoration='none';
	obj.style.border='1px solid #ABABAB';
	obj.style.cursor='pointer';
} // end function f_cps(obj)



// grey out cell
function f_cpps(obj) {
	obj.style.background='#555555';
	obj.style.font='10px Arial';
	obj.style.color='#777777';
	obj.style.textAlign='center';
	obj.style.textDecoration='none';
	obj.style.border='1px solid #ABABAB';
	obj.style.cursor='default';
} // end function f_cpps(obj)



//affects color of currently selected date
function f_hds(obj) {
	obj.style.background='#FFFFFF';
	obj.style.font='bold 10px Arial';
	obj.style.color='#1C1C1C';
	obj.style.textAlign='center';
	obj.style.border='1px solid #ABABAB';
	obj.style.cursor='pointer';
} // end function f_hds(obj)



// day currently in textbox
//hd = day. cm = month, cy = year
function prepcalendar(hd,cm,cy) {
	now=new Date();
	sd=now.getDate();
	td=new Date();
	td.setDate(1);
	td.setFullYear(cy);
	td.setMonth(cm);
	cd=td.getDay();
	//Places name of month and year in top row
	getObj('mns').innerHTML=mn[cm]+ ' ' + cy;
	//determines if it is a leapyear or not
	marr=((cy%4)==0)?mnl:mnn;
	
	for(var d=1;d<=42;d++) {
		f_cps(getObj('v'+parseInt(d)));
		if ((d >= (cd -(-1))) && (d<=cd-(-marr[cm]))) {
			
			var dip = false;
			selectedDate = false
			
			//if dip is true, date cannot be selected
			if(cy<(currentYear-1) || cy > (currentYear + 5)){
				dip = true;
			}
			
			var htd=((hd!='')&&(d-cd==hd));
			
			if (dip){
				f_cpps(getObj('v'+parseInt(d)));
				selectedDate = false
			}
			else if (htd){
				f_hds(getObj('v'+parseInt(d)));
				selectedDate = true
			}
			else{
				f_cps(getObj('v'+parseInt(d)));
				selectedDate = false
			}
			
			getObj('v'+parseInt(d)).onmouseover=(dip||selectedDate)?null:cs_over;
			getObj('v'+parseInt(d)).onmouseout=(dip||selectedDate)?null:cs_out;
			getObj('v'+parseInt(d)).onclick=(dip)?null:cs_click;
			
			getObj('v'+parseInt(d)).innerHTML=d-cd;
			if( d-cd < 10 ){ // adds a leading zero for the day number
				day = "0" + (d-cd);
			}else{
				day = (d-cd);
			}
			
			if( cm+1 < 10 ) { // adds a leading zero for the month number
				month = "0" + (cm+1);
			}else{
				month = (cm+1);
			}
			year = cy;
			
			//calvalarr[d]=''+year+'-'+month+'-'+day;
                        calvalarr[d]=''+day+'-'+month+'-'+year;
		} // end if
		else {
			getObj('v'+d).innerHTML=' ';
			getObj('v'+parseInt(d)).onmouseover=null;
			getObj('v'+parseInt(d)).onmouseout=null;
			getObj('v'+parseInt(d)).style.cursor='default';
		} // end else
	} // end for
} // end function prepcalendar(hd,cm,cy)



//Set initial date to current day
prepcalendar(now.getDate(),ccm,sccy);


//Increase month when right button is clicked
function caddm() {
	marr=((ccy%4)==0)?mnl:mnn;
	
	ccm+=1;
	if (ccm>=12) {
		ccm=0;
		sccy++;
	}
	cdayf();
	
	if (ccm == now.getMonth() && selectedMonth == now.getMonth() ){
		prepcalendar(now.getDate(),ccm,sccy);
	}
	else if (ccm == selectedMonth){
		prepcalendar(selectedDay,ccm,sccy);
	}
	else{
		prepcalendar('',ccm,sccy);
	}
} // end function caddm()



//decrease month when left button is clicked
function csubm(){
	marr=((ccy%4)==0)?mnl:mnn;
	
	ccm-=1;
	if (ccm<0){
		ccm=11;
		sccy--;
	}
	cdayf();
	
	if (ccm == now.getMonth() && selectedMonth == now.getMonth() ){
		prepcalendar(now.getDate(),ccm,sccy);
	}
	else if (ccm == selectedMonth){
		prepcalendar(selectedDay,ccm,sccy);
	}
	else{
		prepcalendar('',ccm,sccy);
	}
	
} // end function csubm()



function cdayf() {
	if ((ccy>sccy)|((ccy==sccy)&&(ccm>=sccm)))
		return;
	else {
		ccy=sccy;
		sccm=ccm;
	}
} // end function cdayf()

