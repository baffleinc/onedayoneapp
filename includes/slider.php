<?php
	$device = (string) '';
	if(is_page('iPad') || is_singular('ipad-app')){$device = 'ipad';}
	elseif(is_page('iPhone') || is_singular('iphone-app')){$device = 'iphone';}
	elseif(is_page('Mac') || is_singular('mac-app')){$device = 'mac';}
?>

<div id="slider">
	<div class="hideTheSlide">&nbsp;</div>
	<span class="height-<?php echo $device; ?>">&nbsp;</span>
	<?php if(!is_singular_app()) : ?>
		<a href="#" class="parent-prev scroll_ctrl">&lsaquo;</a>
		<a href="#" class="parent-next scroll_ctrl">&rsaquo;</a>
	<?php endif; ?>
	<div class="parent-scroll-container <?php echo $device; ?>-scroll">
		<ul class="parent-scroll-items">
			<?php				
				$args = array(
					'post_type' => $device.'-app',
					'posts_per_page' => 7
				);
				$n = 0;
				if(have_posts()) : if(is_page()) query_posts($args);
				while(have_posts()) : the_post();
					$lemeta = array();
					$lemeta = get_post_custom($post->ID);
					//pr($lemeta);
					$screens = array();
					$x = 0;
					while($x <= 6) :
						$img = "";
						if($x == 0){
							$img = get_post_meta(get_the_ID(), '_thumbnail_id', true);
							if($img){$screens[] = wp_get_attachment_image_src($img, 'full');}
						} else {
							$img = get_post_meta(get_the_ID(), $device.'-app_screenshot-'.$x.'_thumbnail_id', true);
							if($img){
								$screens[] = wp_get_attachment_image_src($img, 'full');
							}
						}
					$x++;
					
					endwhile;
					
					if($device == 'ipad'){
						if($lemeta['horizontal-ipad-app'][0] == "horizontal-app"){
							$device = 'ipad-app-horizontal';
							$w      = 430;
							$h      = 320;
						} else {
							$device = 'ipad-app-vertical';
							$h      = 430;
							$w      = 320;}
					} elseif($device == 'iphone'){
						$w = 211;
						$h = 316;
					} elseif($device == 'mac'){
						$w = 428;
						$h = 265;
					}
					
					$t = get_the_taxonomies(get_the_ID());
					$t = explode('iPad App Categories: ', $t['ipad-app-category']);
					$t = explode(' and ', $t[1]);
					$last = array_pop($t);
					$t[] = substr($last, 0, -1);
					
									
			?>
				<li class="parent-scroll-item <?php echo $device.'-scroll-item'; ?>">
					<div class="device-bg">
						<div class="slider-images">
							<div class="screenshot-scroll-container" id="sssc-<?php echo $n; ?>">
								<ul class="screenshot-scroll-items">
									<?php $o = 0; foreach($screens as $screen) : ?>
										<li class="screenshot-scroll-item">
											<div class="scroller-screenshot">
												<?php //pr($screens); ?>
												<?php echo '<img src="'.get_bloginfo('stylesheet_directory').'/thumbs/thumb.php?src='. $screen[0].'&w='.$w.'&h='.$h.'" alt="Screenshot '.$o.'">'; ?>
											</div>
										</li>
									<?php $o++; endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="slider-content">
						<span class="date">Today's App 7th July 2010</span>
						<h2 class="app-name"><?php //pr($lemeta['horizontal-ipad-app']); ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<span class="developer">Developed by <a href="<?php echo $lemeta['app-developer-link'][0]; ?>"><?php echo $lemeta['app-developer'][0]; ?></a></span>
						<span class="price">Price <?php echo $lemeta['price-of-app'][0]; ?></span>
						<a href="<?php the_permalink(); ?>" class="expand-info">Info</a>
						<div class="info">
							<p color="white"><?php the_content(); ?></p>
						</div>
						<div class="social-appstore-row">
							<a href="#" class="twitter-link">Twitter this</a>
							<a href="#" class="facebook-link">Facebook this</a>
							<a href="" class="email-link">Email this</a>
							<a href="<?php echo get_post_meta($post->ID, 'appstore-link', true); ?>" class="appstore-link">Twitter this</a>
							
						</div>
						<?php if(!is_singular()) : ?>
							<span class="comments-link"><?php comments_popup_link('[Comments]'); ?></span>
						<?php else : ?>
							<div id="tags">
								<?php foreach($t as $tax) { echo $tax; } ?>
							</div>
						<?php endif; ?>
					</div>
				</li>
			<?php $n++; unset($lemeta); endwhile; endif; wp_reset_query(); ?>
		</ul>
	</div>
</div>
<?php //endif; ?>