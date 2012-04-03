<div class="post_footer">
	<p class="postmeta">
		Posted by <?php the_author(); ?> on <?php the_time('jS M Y'); ?>
	</p>
	<p class="actions">
		<a href="http://twitter.com/<?php the_permalink(); ?>" class="post-to-twitter">Twitter</a>
		<a href="http://facebook.com/<?php the_permalink(); ?>" class="post-to-facebook">Facebook</a>
		<a href="mailto:<?php the_permalink(); ?>" class="post-to-mail">Email</a>
		<span class="sep">|</span>
		<?php comments_popup_link(); ?>
		<span class="sep">|</span>
		<a href="<?php the_permalink(); ?>">Permalink</a>
		<span class="sep">|</span>
	</p>
</div>