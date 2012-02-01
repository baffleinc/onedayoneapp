(function($){
	$(document).ready(function(){
		$('.tags-loading, .tags-done').hide();
		$('.sortable').each(function(i){
			var section = $(this).parents('.device-section');
			
			var device = section.attr('id');
			device = device.split('section-');
			device = device[1];
			
			$(this).sortable({
				connectWith: '.'+device+'ConnectedSortable',
				update: function(e, ui){
					if(ui.item.siblings('li.empty')){
						$('.empty').remove();
					}
					
					section.find('.tags-loading').fadeIn(300);
					var mytags = section.find('.active-tags-list.'+device+'ConnectedSortable').sortable('toArray');

					$.post(
						ajaxurl,
						{action: 'do_the_tags', type: device, info: mytags},
						function(data){
							section.find('.tags-loading').fadeOut(300);
							section.find('.tags-done').delay(300).fadeIn(300).delay(1000).fadeOut(300);
						}
					);
				}
			}).disableSelection();
		});
	});
})(jQuery);
