(function($){
	$(document).ready(function(){
		
		$('.sortable').each(process_tags);
		
		$('.tags-loading, .tags-done').hide();
		
		
		function process_tags(){
			var letype = $(this).data('list');
			var section = $(this).parents('.device-section');
			var device = section.attr('id');
			if(device){
				device = device.split('section-');
				device = device[1];
				$(this).sortable({
					connectWith: '.'+device+'ConnectedSortable',
					update: function(e, ui){
						if($(' li', ui.sender).length == 0){
							$(ui.sender).addClass('empty');
						} else if ($(' li', ui.sender).length > 0) {
							$(this).removeClass('empty');
						}
						if(letype == 'active-tags'){
							
							section.find('.tags-loading').fadeIn(300);
							var mytags = $(this).sortable('toArray');
							var i = 0;
							$.post(
								ajaxurl,
								{action: 'do_the_tags', type: device, info: mytags},
								function(data){
									section.find('.tags-loading').fadeOut(300);
									section.find('.tags-done').delay(300).fadeIn(300).delay(1000).fadeOut(300);
									i++;
								}//der
							);
						}
					}
				}).disableSelection();
			}
		}
	});
})(jQuery);
