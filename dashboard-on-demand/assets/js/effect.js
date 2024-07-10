// Bu Bir WebKodu.com ÃƒÅ“rÃƒÂ¼nÃƒÂ¼dÃƒÂ¼r. http://www.webkodu.com
  var snowsrc="assets/images/try.png"

  var no = 10;

  var hidesnowtime = 0;

  var snowdistance = "pageheight";
// Bu Bir WebKodu.com ÃƒÅ“rÃƒÂ¼nÃƒÂ¼dÃƒÂ¼r. http://www.webkodu.com

// Bu Bir WebKodu.com ÃƒÅ“rÃƒÂ¼nÃƒÂ¼dÃƒÂ¼r. http://www.webkodu.com
  var ie4up = (document.all) ? 1 : 0;
  var ns6up = (document.getElementById&&!document.all) ? 1 : 0;

	function iecompattest(){
	return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
	}// Bu Bir WebKodu.com ÃƒÅ“rÃƒÂ¼nÃƒÂ¼dÃƒÂ¼r. http://www.webkodu.com

  var dx, xp, yp;   
  var am, stx, sty;  
  var i, doc_width = 150, doc_height = 400; 
  
  if (ns6up) {
    doc_width = self.innerWidth;
    doc_height = self.innerHeight;
  } else if (ie4up) {
    doc_width = iecompattest().clientWidth;
    doc_height = iecompattest().clientHeight;
  }// Bu Bir WebKodu.com ÃƒÅ“rÃƒÂ¼nÃƒÂ¼dÃƒÂ¼r. http://www.webkodu.com

  dx = new Array();
  xp = new Array();
  yp = new Array();
  am = new Array();
  stx = new Array();
  sty = new Array();
  snowsrc=(snowsrc.indexOf("http://www.webkodu.com")!=-1)? "http://www.webkodu.com/kod-kaynak/wk-altin-para-efekt.png" : snowsrc
  for (i = 0; i < no; ++ i) {  
    dx[i] = 0;                       
    xp[i] = Math.random()*(doc_width-50);  
    yp[i] = Math.random()*doc_height;
    am[i] = Math.random()*20;        
    stx[i] = 0.02 + Math.random()/10; // set step variables
    sty[i] = 0.7 + Math.random();    
		if (ie4up||ns6up) {
      if (i == 0) {
        document.write("<div id=\"dot"+ i +"\" style=\"POSITION: absolute; Z-INDEX: "+ i +"; VISIBILITY: visible; TOP: 15px; LEFT: 15px;\"><a href=\"http://www.webkodu.com\"><img src='"+snowsrc+"' border=\"0\"><\/a><\/div>");
      } else {
        document.write("<div id=\"dot"+ i +"\" style=\"POSITION: absolute; Z-INDEX: "+ i +"; VISIBILITY: visible; TOP: 15px; LEFT: 15px;\"><img src='"+snowsrc+"' border=\"0\"><\/div>");
      }
    }// Bu Bir WebKodu.com ÃƒÅ“rÃƒÂ¼nÃƒÂ¼dÃƒÂ¼r. http://www.webkodu.com
  }
// Bu Bir WebKodu.com ÃƒÅ“rÃƒÂ¼nÃƒÂ¼dÃƒÂ¼r. http://www.webkodu.com
  function snowIE_NS6() { 
    doc_width = ns6up?window.innerWidth-10 : iecompattest().clientWidth-10;
		doc_height=(window.innerHeight && snowdistance=="windowheight")? window.innerHeight : (ie4up && snowdistance=="windowheight")?  iecompattest().clientHeight : (ie4up && !window.opera && snowdistance=="pageheight")? iecompattest().scrollHeight : iecompattest().offsetHeight;
    for (i = 0; i < no; ++ i) {  
      yp[i] += sty[i];
      if (yp[i] > doc_height-50) {
        xp[i] = Math.random()*(doc_width-am[i]-30);
        yp[i] = 0;
        stx[i] = 0.02 + Math.random()/10;
        sty[i] = 0.7 + Math.random();
      }
      dx[i] += stx[i];
      document.getElementById("dot"+i).style.top=yp[i]+"px";
      document.getElementById("dot"+i).style.left=xp[i] + am[i]*Math.sin(dx[i])+"px";  
    }// Bu Bir WebKodu.com ÃƒÅ“rÃƒÂ¼nÃƒÂ¼dÃƒÂ¼r. http://www.webkodu.com
    snowtimer=setTimeout("snowIE_NS6()", 10);
  }// Bu Bir WebKodu.com ÃƒÅ“rÃƒÂ¼nÃƒÂ¼dÃƒÂ¼r. http://www.webkodu.com

	function hidesnow(){
		if (window.snowtimer) clearTimeout(snowtimer)
		for (i=0; i<no; i++) document.getElementById("dot"+i).style.visibility="hidden"
	}
		// Bu Bir WebKodu.com ÃƒÅ“rÃƒÂ¼nÃƒÂ¼dÃƒÂ¼r. http://www.webkodu.com

if (ie4up||ns6up){
    snowIE_NS6();
		if (hidesnowtime>0)
		setTimeout("hidesnow()", hidesnowtime*1000)
		}
	// Bu Bir WebKodu.com ÃƒÅ“rÃƒÂ¼nÃƒÂ¼dÃƒÂ¼r. http://www.webkodu.com