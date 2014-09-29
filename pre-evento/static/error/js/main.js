$(function() {		
	$('.noticiaHome').on('mouseover', function() {
		$(this).children('.over').show();
		$(this).css({
			backgroundColor: '#75CAE9',
			color: 'white'
		});
		$(this).find('.descripcion').css({
			borderTop: '1px solid white',
			color: 'white'
		});		
		$(this).find('.titulo').css({
			color: 'white'
		})
		$(this).find('.more').children('span').hide();
		$(this).find('.more').stop().animate({
			width: 22
		}, 100);		
	}).on('mouseout', function(event) {
		$(this).children('.over').hide();
		$(this).css({
			backgroundColor: 'white',
			color: 'black'
		});
		$(this).find('.titulo').css({
			color: '#1d7188'
		})
		$(this).find('.descripcion').css({
			borderTop: 'none',
			color: 'black'
		});		
		$(this).find('.more').stop().animate({
			width: 90
		}, 100, function() {
			$(this).children('span').show();
		});
	});	
});


var mySwiper = new Swiper('.swiper-container',{
    // pagination: '.pagination',
    paginationClickable: true,
    slidesPerView: 3,
    loop: false
});
$('.arrow-left').on('click', function(e){
    e.preventDefault()
    mySwiper.swipePrev()
});
$('.arrow-right').on('click', function(e){
    e.preventDefault()
    mySwiper.swipeNext()
});
