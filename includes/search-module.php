<?php //searchform?
	//wp_list_cats();
	?>
	<div class="search-wrap">
		<div class="search-module">
			<form name="search" class="search" action="<?php bloginfo('url'); ?>" method="post">
				<p>
					<input type="text" name="search-query" class="search-query" />
					<label for="search">Search</label>
				</p>
			</form>
			<ul class="search-categories">
				<?php
					$cats = array(
						'Business',
						'Creative',
						'Design Tools',
						'Education',
						'Entertainment',
						'Finance',
						'Games',
						'Health &amp; Fitness',
						'Interactive',
						'Lifestyle',
						
					);
					foreach($cats as $name) : ?>
					<li><a href="#<?php sanitize_title($name); ?>"><?php echo $name; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>