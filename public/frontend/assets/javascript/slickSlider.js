
$(function(){
	$('.slider-thumb').slick({
		autoplay: true,
		vertical: true,
		infinite: true,
		verticalSwiping: true,
		slidesPerRow: 4,
		slidesToShow: 4,
		asNavFor: '.slider-preview',
		focusOnSelect: true,
		prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-up"></i></button>',
		nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-down"></i></button>',
		responsive: [
			{
				breakpoint: 767,
				settings: {
					vertical: false,
				}
			},
			{
				breakpoint: 479,
				settings: {
					vertical: false,
					slidesPerRow: 3,
					slidesToShow: 3,
				}
			},
		]
	});
	$('.slider-preview').slick({
		autoplay: true,
		vertical: false,
		infinite: true,
		slidesPerRow: 1,
		slidesToShow: 1,
		asNavFor: '.slider-thumb',
		arrows: true,
		prevArrow:"<i class='bx bxs-chevron-left slick-btn-left'></i>",
		nextArrow:"<i class='bx bxs-chevron-right slick-btn-right'></i>",
		draggable: true,
		responsive: [
			{
				breakpoint: 767,
				settings: {
					vertical: false,
					fade: false,
					dots: false,
					autoplay: false,
					arrows: false,
				}
			},
		]
	});
});

