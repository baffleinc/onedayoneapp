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
					
					if($device == 'ipad'){
						$ledevice = 'ipad-app-vertical';
						$h      = 430;
						$w      = 320;
						if(get_post_meta(get_the_ID(), 'horizontal-ipad-app', true)) {
							$ledevice = 'ipad-app-horizontal';
							$w      = 430;
							$h      = 320;
						}
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
					
					$screens = array();
					$x = 0;
					while($x <= 6){
						if($x==0){
							$image = wp_get_attachment_image_src(get_post_meta(get_the_ID(), '_thumbnail_id', true), 'large');
							$screens[0] = $image[0];
							$derp = $image[0];
						} else {
							$image = wp_get_attachment_image_src(get_post_meta(get_the_ID(), 'ipad-app_screenshot-'.$x.'_thumbnail_id', true),  'large');
							if($image) $screens[] = $image[0];
						}
					$x++;}
					$shit['dev-link'] = get_post_meta(get_the_ID(), 'app-developer-link', true);
					$shit['dev'] = get_post_meta(get_the_ID(), 'app-developer', true);
					$shit['price'] = get_post_meta(get_the_ID(), 'price-of-app', true);
					$shit['appstore'] = get_post_meta(get_the_ID(), 'appstore-link', true);
			?>
				<li class="parent-scroll-item <?php echo $ledevice.'-scroll-item'; ?>">
					<div class="device-bg">
						<div class="slider-images">
							<div class="screenshot-scroll-container" id="sssc-<?php echo $n; ?>">
							<?php 
								if($shit['video-embed'] && $o == $shit['insert-video-after-image']){
									$vid = $shit['video-embed'];
								}
							 ?>
								<ul class="screenshot-scroll-items">
									<?php $o = 0; foreach($screens as $screen) : ?>
										<li class="screenshot-scroll-item">
											<div class="scroller-screenshot">
												<?php if($vid) : ?>
													<iframe class="youtube-player" type="text/html" width="<?php echo $w; ?>" height="<?php echo $h; ?>" src="http://www.youtube.com/embed/<?php echo $vid; ?>" frameborder="0">
													</iframe>
												<?php else : ?>
												<?php echo '<img src="'.get_bloginfo('stylesheet_directory').'/thumbs/thumb.php?src='. $screen.'&w='.$w.'&h='.$h.'" alt="Screenshot '.$o.'">'; ?>
												<?php endif; ?>
											</div>
										</li>
									<?php $o++; endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="slider-content">
						<span class="date">Today's App 7th July 2010</span>
						<h2 class="app-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<span class="developer">Developed by <a href="<?php echo $shit['dev-link']; ?>"><?php echo $shit['dev']; ?></a></span>
						
						<span class="price">Price <?php echo $shit['price']; ?></span>
						
						<a href="<?php the_permalink(); ?>" class="expand-info">Info</a>
						<div class="info">
							<p color="white"><?php the_content(); ?></p>
						</div>
						<div class="social-appstore-row">
							<a href="#" class="twitter-link">Twitter this</a>
							<a href="#" class="facebook-link">Facebook this</a>
							<a href="" class="email-link">Email this</a>
							<a href="<?php echo $shit['appstore']; ?>" class="appstore-link">Appstore Link</a>
							
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