function addEvent( obj, type, fn ) {
  if ( obj.attachEvent ) {
    obj['e'+type+fn] = fn;
    obj[type+fn] = function(){obj['e'+type+fn]( window.event );}
    obj.attachEvent( 'on'+type, obj[type+fn] );
  } else
    obj.addEventListener( type, fn, false );
}
function removeEvent( obj, type, fn ) {
  if ( obj.detachEvent ) {
    obj.detachEvent( 'on'+type, obj[type+fn] );
    obj[type+fn] = null;
  } else
    obj.removeEventListener( type, fn, false );
}

SlidePlayer.prototype.container=null;
SlidePlayer.prototype.imageList=null;
SlidePlayer.prototype.width=0;
SlidePlayer.prototype.height=0;
SlidePlayer.prototype.currentNum=1;
SlidePlayer.prototype.playTimer=null;
SlidePlayer.prototype.loopTimer;
SlidePlayer.prototype.intervalTime=50;
SlidePlayer.prototype.waiting=3000;
SlidePlayer.prototype.isPause=false;
SlidePlayer.prototype.isPlaying=false;
SlidePlayer.prototype.endPlay=new Function;
SlidePlayer.prototype.initial=new Function;
SlidePlayer.prototype.getCurrnetNum=function(){
	return this.currentNum;
	};
var isIE5 = navigator.userAgent.toLowerCase().indexOf("msie 5.0")>0;

SlidePlayer.prototype.goToPlay=function(n){
	var o=this;
	if(o.playTimer||o.playTimer!=null){
		window.clearInterval(o.playTimer);
	}
	if(o.loopTimer){
		window.clearTimeout(o.loopTimer);
	}
	var d;
	for(var i=0;i<o.imageList.length;i++){
		o.imageList[i].style.display="none";
		if(o.imageList[i].parentNode&&o.imageList[i].parentNode.tagName.toLowerCase()=='a'){
			d=o.imageList[i].parentNode;
		}else{
			d=o.imageList[i];
		}
		d.style.zIndex="1";
		d.style.filter="alpha(opacity=100)";
		d.style.MozOpacity=1;
		d.style.opacity=1;
	}
	o.isPlaying=false;
	o.imageList[o.currentNum-1].style.display="block";
	o.play(n);
};

SlidePlayer.prototype.play=function(num){
	var o=this;
	if(o.isPlaying){
		return;
		}
	if(num){
		var nn=num;var on=o.currentNum;
	}
	else{
		var nn=o.currentNum+1;
		var on=o.currentNum;
	}
	if(nn>o.imageList.length){nn=1;}
	if(on==nn){
		o.loopTimer=window.setTimeout(function(){
		o.play();
		 },o.waiting);
		return;
	}
	if(o.playTimer||o.playTimer!=null){
		window.clearInterval(o.playTimer);
	}
	if(o.loopTimer){
		window.clearTimeout(o.loopTimer);
	}
	var n_el=(o.imageList[nn-1].parentNode&&o.imageList[nn-1].parentNode.tagName.toLowerCase()=='a')?o.imageList[nn-1].parentNode:o.imageList[nn-1];
	var o_el=(o.imageList[on-1].parentNode&&o.imageList[on-1].parentNode.tagName.toLowerCase()=='a')?o.imageList[on-1].parentNode:o.imageList[on-1];
	var delayBegin = false;
	if (o.beginPlay) {
		if (o.isPause)
			delayBegin = true;
		else
			o.beginPlay(nn-1);
	}
	o_el.style.zIndex=10;
	n_el.style.zIndex=1;
	o_el.style.filter="alpha(opacity=100)";
	o_el.style.MozOpacity=1;
	o_el.style.opacity=1;
	n_el.style.filter="alpha(opacity=100)";
	n_el.style.MozOpacity=1;
	n_el.style.opacity=1;
	o.imageList[nn-1].style.display="block";
	o.isPlaying=true;
	var n=100;
	var anim=function(){
		if(o.isPause){
			o_el.style.filter="alpha(opacity=100)";
			o_el.style.MozOpacity=1;
			o_el.style.opacity=1;
			return;
		}
		n-=20;
		if(n<=0){
			o_el.style.filter="alpha(opacity=0)";
			o_el.style.MozOpacity=0;
			o_el.style.opacity=0;
			o_el.style.zIndex=1;
			o.imageList[on-1].style.display="none";
			o.isPlaying=false;
			o.currentNum=nn;
			o.loopTimer=window.setTimeout(function(){
		    o.play();
            },o.waiting);
			window.clearInterval(o.playTimer);
			o.endPlay();
		}else{
			if (delayBegin && o.beginPlay) {
				o.beginPlay(nn-1);
				delayBegin = false;
			}
			o_el.style.filter="alpha(opacity="+n+")";
			o_el.style.MozOpacity=n/100;
			o_el.style.opacity=n/100;
		}
	}
	if (!isIE5)
		o.playTimer=window.setInterval(anim,o.intervalTime);
	else {
		o.imageList[on-1].style.display="none";
		o.isPlaying=false;
		o.currentNum=nn;
		o.endPlay();
	}
};

function SlidePlayer(con_id){
	var o=this;
	var cont=document.getElementById(con_id);
	if(!cont){return;}
	var imgs=cont.getElementsByTagName("img");
	if(!imgs||imgs.length<=0){
		return;
		}
	o.container=cont;
	o.imageList=imgs;
	//var img=new Image();
	//img.src=imgs[0].src;
	//o.width=img.width;
	//o.height=img.height;
	//o.container.style.width=o.width+"px";
	//o.container.style.height=o.height+"px";
	imgs[0].style.display="block";
	addEvent(o.container,'mouseover',function(){
											  o.isPause = !o.isPlaying;
											  });
	addEvent(o.container,'mouseout',function(){
											 o.isPause = false;
											 });
	if (!isIE5)
		o.loopTimer=window.setTimeout(function(){
											   o.play();
											   },o.waiting);
	o.initial();
}
function initSlidePlayer(i){
	if(!document.getElementById('SlidePlayer'+i)) return;
	var obj = new SlidePlayer('SlidePlayer'+i),slidenum,t_num,li;
	obj.waiting = 3000;
	slidenum = document.getElementById('SlideNum'+i);
	if(obj && slidenum){
		t_num = "<ul class=\"SlideNumber\"><li class=\"CurSlideNumber\">1</li>";
		for(var i=1;i<obj.imageList.length; i++){
			t_num +="<li id=\"SlideNumberLI" + (i+1) + "\">"+(i+1)+"</li>";
		}
		t_num += "</ul>"
		//t_num += "<div id='SlideCaption'>" + (obj.imageList[0].title || obj.imageList[0].alt) + "</div>";
		slidenum.innerHTML = t_num;
		li = slidenum.getElementsByTagName("li");
		for(var j=0; j<li.length;j++){
			addEvent(li[j],'click',function(e){
				var el = (navigator.userAgent.toLowerCase().indexOf('msie')>0)? e.srcElement : this;
				for(var i=0; i<li.length;i++){
					 li[i].className = '';
				}
				el.className = "CurSlideNumber";
				obj.goToPlay(parseInt(el.innerHTML));
			});
		}
	}
	obj.endPlay = function(){
		if(li){
			for(var i=0; i<li.length;i++){
				li[i].className = '';
			}
			li[obj.getCurrnetNum()-1].className = 'CurSlideNumber';
		}
	}
}