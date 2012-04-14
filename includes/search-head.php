<div class="wrapper">
<form class="search addClasses" action="<?php bloginfo('url'); ?>" method="post">
	<p>
		<strong>Search results for:</strong>
		<input type="text" placeholder="Search" value="<?php echo $_REQUEST['s']; ?>" />
		<input type="submit" value="Search again">
	</p>
</form>
</div>