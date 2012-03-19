<?php 
		while ( have_posts() ) : the_post(); 
				
						thematic_abovepost();
						 //pr(get_post(the_ID()));
						  ?>
						
						<div id="post-<?php the_ID();?>" class="post">
					
		     				<?php //pr(get_post(the_ID()))
		     				  //thematic_postheader(); ?>
							<div class="entry-content">
		
								<div class="post-thumb">
									<a href="<?php the_permalink(); ?>"><?php $img = wp_get_attachment_image_src(get_post_meta(get_the_ID(), '_thumbnail_id', true)); ?>
										<img src="<?php echo $img[0]; ?>" alt="" />
									</a>
								</div>
								<div class="post-info">
									<h2 class="entry-title">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
									</h2>
									<div class="post-meta">
										<?php the_date('jS M Y'); ?>
									</div>
									<div class="the-content">
										<?php the_content(); ?>
									</div>
									<?php comments_popup_link('Comments','Comments','Comments'); ?>
								</div>
		
							</div><!-- .entry-content -->
							<?php //thematic_postfooter(); ?>
							<div class="clearfix"></div>
						</div><!-- #post -->
		
					<?php 
				
						thematic_belowpost();
				
				endwhile;