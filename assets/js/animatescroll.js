$(window).scroll(function() {
	$('.profile-card').each(function(){
	var imagePos = $(this).offset().top;

	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+400) {
			$(this).addClass("animated bounceIn");
		}
	});
});
$(window).scroll(function() {
	$('.section-heading').each(function(){
	var imagePos = $(this).offset().top;

	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+500) {
			$(this).addClass("animated fadeIn");
		}
	});
});
$(window).scroll(function() {
	$('.p-color').each(function(){
	var imagePos = $(this).offset().top;

	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+400) {
			$(this).addClass("animated fadeInLeft");
		}
	});
});
$(window).scroll(function() {
	$('.socialIcon').each(function(){
	var imagePos = $(this).offset().top;

	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+450) {
			$(this).addClass("animated rollIn");
		}
	});
});
$(window).scroll(function() {
	$('.parlex-back').each(function(){
	var imagePos = $(this).offset().top;

	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+400) {
			$(this).addClass("animated flipInX");
		}
	});
});
$(window).scroll(function() {
	$('.sublime-text').each(function(){
	var imagePos = $(this).offset().top;

	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+500) {
			$(this).addClass("animated flipInY");
		}
	});
});

$(window).scroll(function() {
	$('.btn').each(function(){
	var imagePos = $(this).offset().top;

	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+500) {
			$(this).addClass("animated bounceIn");
		}
	});
});
$(window).scroll(function() {
	$('.photo-edit').each(function(){
	var imagePos = $(this).offset().top;

	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+500) {
			$(this).addClass("animated bounceIn");
		}
	});
});
// Contact
$(window).scroll(function() {
	$('.p-animate').each(function(){
	var imagePos = $(this).offset().top;

	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+500) {
			$(this).addClass("animated bounceInLeft");
		}
	});
});
$(window).scroll(function() {
	$('#form-div').each(function(){
	var imagePos = $(this).offset().top;

	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+500) {
			$(this).addClass("animated fadeIn");
		}
	});
});