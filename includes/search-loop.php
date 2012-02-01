<?php 
		while ( have_posts() ) : the_post(); 
				
						thematic_abovepost(); ?>
		
						<div id="post-<?php the_ID();?>" <?php post_class(); ?>>
					
		     				<?php //thematic_postheader(); ?>
							<div class="entry-content">
		
								<div class="post-thumb">
									
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
						</div><!-- #post -->
		
					<?php 
				
						thematic_belowpost();
				
				endwhile;