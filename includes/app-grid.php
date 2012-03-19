<div id="grid-container">
	<div id="app-grid-wrapper">
		<div id="app-grid">
			<ul id="apps">
				<?php
					$type = get_queried_object();
					$type = $type->name;
					$page_args = array(
						'post_type' => $type,
						'posts_per_page' => 25
					);
				?>
				<?php if(have_posts()) : if(is_page()) query_posts($page_args); ?>
				<?php while(have_posts()) : the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>">
							<span class="inner">
								<span class="image"><?php echo the_post_thumbnail(); ?></span>
								<span class="title"><?php the_title(); ?></span>
								<span class="date"><?php the_time('jS F Y'); ?></span>
							</span>
						</a>
					</li>
				<?php endwhile; endif; ?>
				<li class="clearfix"></li>
			</ul>
			<div class="clearfix">
		</div>
	</div>
</div>
</div>
<div id="nav-container">
&nbsp;
</div>
