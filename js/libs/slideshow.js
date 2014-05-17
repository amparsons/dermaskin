$(window).load(function() {	

	var sliderWidth = 0;
	var imageWidth = $('#image-slider img:first').width();
	var count = 0;
	var imageCount = 0;
	var imageLeft = 0;
	resizeOverlay();
	repositionImages();
	
	setInterval(function(){
		$('a.move-right').trigger('click');
	},6000)
	
	$('#image-slider img').each(function(){
		sliderWidth = sliderWidth + $(this).width();
//		$(this).addClass('move-'+count);
	//	count++;
	});

	$('#image-slider').width(sliderWidth);
	
	function resizeOverlay() {
		var overlayWidth = ($(window).width() - 950) / 2;
		$('#left-overlay, #right-overlay').css({
			'opacity':'0.5',
			'width':overlayWidth
		});
	}
	
	function repositionImages() {
		imageLeft = 950 - (($(window).width() - 950) / 2);
		$('#image-slider img').css('left','-'+imageLeft+'px');
	}

	$('a.move-left').click(function(){
		if($('#image-slider img:not(":animated")').length != 0) {
			$('#image-slider img:first').addClass('move-0');
			firstImage = $('#image-slider').children('img.move-0').clone();
			$('#image-slider').width(sliderWidth+imageWidth);
			$('#image-slider').append(firstImage);
			$('#image-slider img').animate({'left':'-='+imageWidth}, 500 ,function(){
				$('#image-slider img:last').removeClass('move-0');
				$('#image-slider').children('img.move-0').remove();
				$('#image-slider img').css('left','-'+imageLeft+'px');
				$('.move-0').removeClass('move-0');
			})
		}
		return false;
	});

	$('a.move-right').click(function(){
		if($('#image-slider img:not(":animated")').length != 0) {
			$('#image-slider img:last').addClass('move-5');
			firstImage = $('#image-slider').children('img.move-5').clone();
			$('#image-slider').width(sliderWidth+imageWidth);
			$('#image-slider').prepend(firstImage);
			$('#image-slider img').css('left','-'+(imageLeft+imageWidth)+'px');
			$('#image-slider img').animate({'left':'+='+imageWidth}, 500 ,function(){
				$('#image-slider img:first').removeClass('move-5');
				$('#image-slider').children('img.move-5').remove();
				$('#image-slider img').css('left','-'+imageLeft+'px');
				$('.move-5').removeClass('move-5');
			})
		}
		return false;
	});
	
	$(window).resize(function(){
		repositionImages();
		resizeOverlay();
	})

/* END OF SCRIPT */
})