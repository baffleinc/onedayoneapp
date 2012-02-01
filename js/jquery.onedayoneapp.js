(function($){
	$(function(){
	
		$.Placeholder.init();
		
			parent_scroller = $('.parent-scroll-container');
			parent_scroller.scrollable({
				items: '.parent-scroll-items',
				next:	'.parent-next',
				prev:	'.parent-prev',
				easing:'easeOutBounce',
				speed: 1500
			});
			
			latest_post_scrollers = $('.latest-posts-scroller-container');
			latest_post_scrollers.each(function(i){
				$(this)
					.addClass('lps-'+i)
					.scrollable({
					items: '.lps-'+i+' .latest-posts-scroller-items',
					vertical: true,
					circular: true
				}).autoscroll(5000);
			});
		
			$('.scroll_ctrl').click(function(event){
				event.preventDefault();
			});
			
			function commence_screenshot_scrolling(){
				$('.screenshot-scroll-container').each(function(i){
				
					var scroll_api = $(this).data("scrollable");
					
					$(this)
						.addClass('scroll-item-'+i)
						.scrollable({
							items: '.scroll-item-'+i+' .screenshot-scroll-items',
							circular: true,
							disabledClass: 'disabled-scroller-nav'})
						.autoscroll({interval: 1000, autoplay: false});
					var scroll_api = $(this).data("scrollable");
					if(i == 0){
						scroll_api.play();
					}
				});
			}
			
			$('.slider-content .info').css({display: 'block'}).hide();
			
			if($('body').hasClass('single')){
				$('.expand-info').animate({paddingTop: 55}, 300).next('.info').fadeIn(300);
				$('.expand-info').siblings('.app-name').animate({top: -80}, 700, 'easeOutExpo');
				$('.expand-info').addClass('turn-x');
			}
			
			$('.expand-info').click(function(){
				if($(this).hasClass('open')){
					$(this).animate({paddingTop: 0}, 300).next('.info').fadeOut(300);
					$(this).siblings('.app-name').animate({top: 0}, 300);
					$(this).removeClass('open');
				} else {
					$(this).animate({paddingTop: 55}, 300).next('.info').fadeIn(300);
					$(this).siblings('.app-name').animate({top: -80}, 700, 'easeOutExpo');
					$(this).addClass('open');
				}
			});
		
			commence_screenshot_scrolling();
		
			$('.app-grid-scroller-item').each(function(){
				wwwidth = $('.app-grid-container').width();
				$(this).width(wwwidth);
			});
			
			/*$('.app-grid-tabs').tabs('.app-grid-panes > div', {
				effect: 'fade',
				fadeInSpeed:  1000,
				fadeOutSpeed: 1000
			});*/
			
			app_grid_panes = $('.app-grid-scroller-pane');
			app_grid_panes.each(function(i){
				var elem = '.ags-'+i;
				$(this)
					.addClass('.ags-'+i)
					.find('.app-grid-scroller-container')
					.scrollable({
						items: elem + ' .app-grid-scroller-items'
						//next:  elem + ' .app-grid-next',
						//prev:  elem + ' .app-grid-prev'
					}).autoscroll(1000);
			});
		
		$('.contact-right-col').hide();
		
		$('#sa-button').live('click', function(){
			$('.active-type-button').removeClass('active-type-button');
			$('.contact-right-col').slideDown(1000);
			$(this).addClass('.active-type-button');
			$('#contact-type').val('app');
			$('.submit label').text('Have you filled out both columns?').next('input').val('Submit App');
		});
		
		$('#ge-button').click(function(){
			$('.active-type-button').removeClass('active-type-button');
			$('.contact-right-col').fadeOut(500);
			$(this).addClass('.active-type-button');
			$('#contact-type').val('message');
			$('.submit label').text('Alrighty!').next('p input').val('Submit App');
		});
		
		$('.loading').css({display: 'block'}).hide();
		$('#contact-form').submit(function(){
			$('.loading').fadeIn(100);
		});
		
		$('.contact-form-fields .radiogroup input, .cat-group').hide();
		$('.contact-form-fields .radiogroup li').each(function(i){
		
			$(this).click(function(){
				$(this).find('input[checked=checked]').attr('checked', '');
				$(this).find('input[type=radio]').attr('checked', 'checked');
				$('.active-radio').removeClass('active-radio');
				$(this).addClass('active-radio');
				
				//filling categories			
				id = jQuery('#cat-field-id').val();
				ii = i+1;
				type = jQuery(this).find('input').attr('title');
					
				$('select.active_cats').fadeOut(400).attr('name', '').removeClass('active_cats');
				$('.categories select#'+type+'-cat-group').delay(400).fadeIn(400).addClass('active_cats').attr('name', id);
			});
		});
		
		//$('#archive-nav ul ul').hide();
		
		$('#archive-nav>li').toggle(function(){
			$(this).find('ul').slideDown();
		}, function(){
			$(this).find('ul').slideUp();
		});
		
		function resize_image(){
			aw = $('#app-grid li a').width();
			$('#app-grid li a img').height(aw);
		}
		
		resize_image();
		
		$(window).resize(function(){
			resize_image();
		});		
		
		
		
		//$('#result').load('ajax/test.html #container');
	});
})(jQuery);