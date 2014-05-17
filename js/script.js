$(document).ready(function() {
	
	// Mobile slideshow
	//$(".rslides").responsiveSlides();
	$("#slides").slidesjs({
		width: 950,
    	height: 300,
		navigation: {
			active: false
		},
		pagination: {
			active: false
		}
	  });
	
	// Add class to each li item in the main nav for colours (Only for first level nav)
	$("nav.desktop*:not(li) > ul > li").addClass("levelone");
	
	$('nav.desktop ul li.levelone').addClass(function (i) {
    	return 'col' + (i+1);
	});
	
	$('.post-type-archive-faqs #main .sub-container section h1').eq(0).addClass('first');
	
	// Submit client login for
	$('.refer').click(function(){
			if ($('.login-content').is(":hidden")){
				$('.login-content').slideDown("slow");
			}
			else{
				$('.login-content').slideUp("slow");
			}
		});
	});
	setTimeout(function(){$(".login-content").hide();},1000);

	
	// Add class to each featured treatment	
	$('#main .colone').addClass(function (i) {
    	return 'treatment' + (i+1);
	});
	
	// Style select box
	if (!$.browser.opera) {
		$('select.select').each(function(){
			var title = $(this).attr('title');
			if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
			$(this)
				.css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
				.after('<span class="select">' + title + '</span>')
				.change(function(){
					val = $('option:selected',this).text();
					$(this).next().text(val);
			})
		});
	};
	
	// Toggle mobile menu
	$('a.toggle').click(function()
	{
		$('nav.mobile').animate({height: 'toggle'}, 200);
		return false;
	});
	
	$("a[rel^='prettyPhoto']").prettyPhoto();
	
	
	$("#submitform").click(function()
	{
		$("#testimonials").submit();
	});
	
	
	
	// Mobile slideshow swipe 
	/*(function(window, $, PhotoSwipe){
				
		$(document).ready(function(){
			
			var options = {};
			$("#gallery a").photoSwipe(options);
		
		});
	}(window, window.jQuery, window.Code.PhotoSwipe));*/


	/*Equal height columns */
		$(document).ready(function(){  
		//set the starting bigestHeight variable  
		var biggestHeight = 0;  
		//check each of them  
		$('.equal_height').each(function(){  
			//if the height of the current element is  
			//bigger then the current biggestHeight value  
			if($(this).height() > biggestHeight){  
				//update the biggestHeight with the  
				//height of the current elements  
				biggestHeight = $(this).height();  
			}  
		});  
		//when checking for biggestHeight is done set that  
		//height to all the elements  
		$('.equal_height').height(biggestHeight);  
	  
}); 