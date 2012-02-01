<?php if(is_tax()) : ?>

<?php 
	$o = get_queried_object();
	
	$device = explode('-app', $o->taxonomy);
	$device = $device[0];
	
	$c = get_terms($device.'-app-tags');
	
	
?>
<div id="tax-header">
	<h1>Archive</h1>
	<h2><?php echo $o->name; ?> apps</h2>
	<div id="archive-nav">
		<span>Filter by</span>
		<ul id="lists">
			<li><h3>Category</h3></li>
			<li><h3>Date</h3></li>
		</ul>
		<?php require_once('searchform.php'); ?>
		
		<ul id="lists-cats">
			<?php foreach($c as $cat) : ?>
				<li>
					<a href="<?php echo get_term_link($cat->slug, $device.'-app-tags'); ?>">
						<?php echo $cat->name; ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		
		<?php wp_custom_archive(); ?>
	</div>
</div>

<?php endif; ?>