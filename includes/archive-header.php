<?php if(is_tax()) : ?>

<?php 
	$o = get_queried_object();
	
	$device = explode('-app', $o->taxonomy);
	$device = $device[0];
	
	$c = get_terms($device.'-app-tags');
	
	$obj = get_queried_object();
	$terms = get_terms($obj->taxonomy);
	//pr($terms);
?>
<div id="tax-header">
	<h1>Archive</h1>
	<h2><?php echo $o->name; ?> apps</h2>
	<div id="archive-nav">
		<ul id="lists">
			<li>Filter by:</li>
			<li class="catc"><h3>Category</h3></li>
			<li class="datec"><h3>Date</h3></li>
		</ul>
	</div>
		<form name="search" class="search" action="<?php bloginfo('url'); ?>" method="post">
			<p>
				<input type="text" name="search-query" class="search-query" value="<?php echo $_REQUEST['s']; ?>" />
				<label for="search">Search</label>
			</p>
		</form>
		
		<!--<ul id="lists-cats">
			<?php foreach($c as $cat) : ?>
				<li>
					<a href="<?php echo get_term_link($cat->slug, $device.'-app-tags'); ?>">
						<?php echo $cat->name; ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>-->
		<div class="push-header-archives">&nbsp;</div>
		<div class="header-categories">
			<ul class="search-categories">
				<?php foreach($terms as $term) : ?>
					<li><a href="<?php get_permalink($term->term_ID); ?>"><?php echo $term->name; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="header-archives">
			<?php them_archives(); ?>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<?php endif; ?>