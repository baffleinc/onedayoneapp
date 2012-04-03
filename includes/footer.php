<?php if(!is_singular_app() || is_home()) : ?>
<div id="nearly-bottom">
	<div class="container_12">
		<div class="grid_4" id="wake-up-call">
			<?php include('wake-up-call.php'); ?>
		</div>
		<div class="grid_4" id="keep-in-touch">
			<h3>Lets keep in touch</h3>
			<ul>
				<?php
					$buttons = array(
						'twitter' => 'Follow us on Twitter',
						'facebook' => 'Stay updated through Facebook',
						'email' => 'Get our Daily Mail',
						'rss' => 'Subscribe to RSS Feed',
					);
				
					foreach($buttons as $id => $desc) : 
				?>
					<li id="footer-<?php echo $id; ?>-link"><a href="#<?php echo $id; ?>"><?php echo $desc; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="grid_4" id="latest-posts">
			<?php include_once('latest-posts.php'); ?>
		</div>
		<div class="grid_4" id="geek-therapy">
			<h3>Geek Therapy</h3>
			<div>and be a total geek.</div>
		</div>
	</div>	
</div>
<?php endif; ?>
<p class="clear">&nbsp;</p>
<div id="bottom">
	
		<?php 
			wp_nav_menu(array(
		'menu' => 'footer-menu'
	));
			?>


	<p>All Rights Reserved <?php echo str_replace(' ', '', get_bloginfo('name')); ?>.com &copy; <?php echo date('Y'); ?></p>
	<p class="credit">crafted by <a href="pushcollaborative.com">Push Collaborative</a><br>
enhanced for web by <a href="http://baffleinc.com">Baffle! inc.</a></p>
</div>