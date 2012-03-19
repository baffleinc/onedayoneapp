<?php //searchform?
	//wp_list_cats();
	
	
	if(is_app_home()){
		$obj = get_queried_object();
		$terms = get_terms(strtolower($obj->post_title).'-app-tags');
	}
	?>
	<div class="search-wrap">
		<div class="search-module">
			<form name="search" class="search" action="<?php bloginfo('url'); ?>" method="post">
			
				<p>
					<input type="text" name="search-query" class="search-query" />
					<label for="search">Search</label>
				</p>
			</form>
			<?php if($terms) : ?>
				<ul class="search-categories">
					<?php foreach($terms as $term) : ?>
						<li><a href="<?php get_permalink($term->term_ID); ?>"><?php echo $term->name; ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>