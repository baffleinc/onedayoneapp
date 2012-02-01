			<h3>Latest Posts</h3>
			<div class="latest-posts-scroller-container">
				<ul class="latest-posts-scroller-items">
					<?php 
						$dummy_posts = array(
							'ideapad',
							'angry birds',
							'creative forces',
							'dubstep attack',
							'sexy ui right guys?',
							'free giveaway at sitepoint.com',
							'MORE POSTS',
							'fixed my iphone screen',
						);
						
						foreach($dummy_posts as $d_post) :
				
					?>
							<li class="latest-posts-scroller-item">
								<h4><a href="#"><?php echo $d_post; ?> </a></h4>
								<p class="latest-post-content">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim ...  <a href="#" class="read-more">read more</a>
								</p>
							</li>
					<?php endforeach; ?>
					
				</ul>
			</div>