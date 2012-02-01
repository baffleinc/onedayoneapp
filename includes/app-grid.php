<div id="app-grid-wrapper">
	<div id="app-grid">
		<ul id="apps">
		
			<?php if(have_posts()) : ?>
			<?php while(have_posts()) : the_post(); ?>
				<li>
					<a href="<?php the_permalink(); ?>">
						<?php echo the_post_thumbnail(); ?>
						<span class="title"><?php the_title(); ?></span>
						<span class="date"><?php the_time('jS F Y'); ?></span>
					</a>
				</li>
			<?php endwhile; endif; ?>
			<li class="clearfix"></li>
		</ul>
		<div class="clearfix">
	</div>
</div>