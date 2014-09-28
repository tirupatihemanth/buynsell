slideint=1;
slidenext=2;
$(document).ready(function(){
     $('#slider>img#1').fadeIn(300);            
startslide();
 	 
	

 $('#1l').hover(
	 function(){
	 stoploop();
	 $('#slider>img').fadeOut(300);
	 $('#slider>img#1').fadeIn(300);
	 },
	 function(){
	 startslide();
	 }
	 );

   $('#2l').hover(
	 function(){
	 stoploop();
	 $('#slider>img').fadeOut(300);
	 $('#slider>img#2').fadeIn(300);
	 },
	 function(){
	 startslide();
	 }
	 );
	 
	 
	 
	 $('#3l').hover(
	 function(){
	 stoploop();
	 $('#slider>img').fadeOut(300);
	 $('#slider>img#3').fadeIn(300);
	 },
	 function(){
	 startslide();
	 }
	 );
	 
	 
	 
	 $('#4l').hover(
	 function(){
	 stoploop();
	 $('#slider>img').fadeOut(300);
	 $('#slider>img#4').fadeIn(300);
	 },
	 function(){
	 startslide();
	 }
	 );
	 
	 
	 
	});	 
	
	 
	 
	 
	 function startslide(){
	 
	 var count=$('#slider>img').size();
	 
	 
	
	 
	 
    
	 loop=setInterval(function(){
	 if(slidenext>count)
	 {
	 slidenext=1;
	 slideint=1;
	 }
	    $('#slider>img').fadeOut(300);
		$('#slider>img#'+slidenext).fadeIn(300);
     slideint=slidenext;
	 slidenext=slidenext+1;
	
	 },3000)
	 }
	 
	 
	 function prev(){
	 newslide=slideint-1;
	 showslide(newslide);
	 }
	 
	 function next(){
	 newslide=slideint+1;
	 showslide(newslide);
	 
     }
	 
function stoploop(){
clearInterval(loop);
}

	 
function showslide(id){
stoploop();
var count=$('#slider>img').size();
if(id>count)
{
id=1;
}
else if(id<1)
{
id=count;
}
  $('#slider>img').fadeOut(300);
  $('#slider>img#'+id).fadeIn(300);
     slideint=id;
	 slidenext=id+1;
     startslide();
}	 
	 

	 

