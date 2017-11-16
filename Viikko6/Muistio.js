array = ['black','red','orange','blue','green'];

function ButtonClick(){
	text = $('input').val();
	$('ul').append("<li>"+ text +"</li>");
	$('input').val("");
	
	r = Math.floor(Math.random() * 5)  
	$('ul li:last-child').css('color',array[r]);
}
