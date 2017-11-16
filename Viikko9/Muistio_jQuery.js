$('document').ready(function(){
    $('Button').hover(
        function(){
            $(this).addClass("Hover");
        },
        function(){
            $(this).removeClass("Hover");
        }
    );

    $('body').on("mouseenter","li", function() {
		$(this).addClass('DatBoi');
    });
    $('body').on("mouseleave","li", function() {
		$(this).removeClass('DatBoi');
    });
     $('body').on("click","li", function() {
		$(this).fadeOut(500,0);
    });   
});