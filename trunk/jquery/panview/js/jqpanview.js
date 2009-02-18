/**
 * @author SeViR
 */


/*
 *  Add a pan viewer in images
 *  @param {integer} width of the window
 *  @param {integer} height of the window
 */
jQuery.fn.panview = function(width, height){
	num = 0;
	return this.each(function(){
		new jQuery.panview(this, width, height, num++);
	});
}

jQuery.panview = function(obj, width, height, num){
	posicionx = 0;
	posiciony = 0 - (height + 2) ;
		
	posicionLeft = posicionx + width - 100;
	icony = posiciony + height - 150;
	iconx = posicionLeft + 50;
	
	tamanobrowser =  ($("img",obj).get(0).offsetHeight > $("img",obj).get(0).offsetWidth)?"height: 99px":"width:99px;";
	
	cuadroimagen = "<div class='panviewer' id='panview_"+num+"' style='background-color: #3b3b3b; text-align: center; border: #ccc 1px solid ;width: "+width+"px; height: "+height+"px; overflow: hidden;' class='panviewer'><img src='"+obj.href+"'/></div>";
	browserimagen = "<div class='panviewer' id='browserpan_"+num+"' style='background-color: #3b3b3b; text-align: center; border: 1px #ccc solid; width: 100px; height: 100px; z-index: 100; position:relative; top: "+posiciony+"px; left: "+posicionLeft+"px; overflow: hidden;' class='panviewer'><img src='"+$("img",obj).get(0).src+"' style='"+tamanobrowser+"; cursor: crosshair;' /></div>";
	maximize_icon = "<div class='panviewer' id='resize_icon_"+num+"' style='z-index: 100; position:relative; top: "+icony+"px; left: "+iconx+"px;' class='panviewer'><a href='"+obj.href+"' target='_blank'><img title='Open maximized image' src='imgs/resize_icon.jpg' style='border:none;' /></a></div>";
	$(obj).after("<div class='panviewer' style='margin-bottom: -150px;'>"+cuadroimagen + browserimagen+maximize_icon+"</div>");
	
	$("#browserpan_"+num).get(0).scaley = Math.round($("#panview_"+num+" img").get(0).offsetHeight / $("#browserpan_"+num+" img").get(0).offsetHeight);
	$("#browserpan_"+num).get(0).scalex = Math.round($("#panview_"+num+" img").get(0).offsetWidth / $("#browserpan_"+num+" img").get(0).offsetWidth);
	$("#browserpan_"+num).get(0).bigimage = $("#panview_"+num).get(0); 
	
	$("#browserpan_"+num).hover(function(){
		$(document.body).get(0).browserpan = this;
		
		$(document.body).mousemove(function(e){
			mouse = new MouseEvent(e);
			
			scrolly = mouse.y - this.browserpan.offsetTop - 10; 
			this.browserpan.bigimage.scrollTop = scrolly * this.browserpan.scaley;
			
			scrollx = mouse.x - this.browserpan.offsetLeft - 20; 
			this.browserpan.bigimage.scrollLeft = scrollx * this.browserpan.scalex;
		});
	},function(){
		$(document.body).unbind("mousemove");
	});
	
	$(document).resize(function(){
		$(document).unbind("resize");
		$(".panviewer").remove();
		$(obj).get(0).style.display = "block";
		
	});
	
	obj.style.display = "none";
	
	function MouseEvent(e) {
		this.e = e ? e : window.event; 
		this.source = e.target ? e.target : e.srcElement;
		this.x = this.e.pageX ? this.e.pageX : this.e.clientX;
		this.y = this.e.pageY ? this.e.pageY : this.e.clientY;
		if(window.event) {
			this.x = (document.body.scrollLeft) ? this.x + document.body.scrollLeft : this.x;
			this.y = (document.body.scrollTop) ? this.y + document.body.scrollTop : this.y;
		}
	}	
}