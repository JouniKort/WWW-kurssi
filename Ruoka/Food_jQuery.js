$('document').ready(function(){
	$('.Panel').hover(
		function(){
			$(this).css('text-decoration','underline');			
		},
		function(){
			$(this).css('text-decoration','none');
		});

	$('.IngredientItem').hover(
		function(){
			$(this).css('text-decoration','underline');
		},
		function(){
			$(this).css('text-decoration','none');
		});

	$(window).scroll(function(){
		function footer(){
			//Hide the footer element when the page is scrolled
			var scroll = $(window).scrollTop();
			if(scroll<10){
				$('#footer').fadeIn('slow');
			}else{
				$('#footer').fadeOut('slow');
			}
		}
		footer();
	});
});