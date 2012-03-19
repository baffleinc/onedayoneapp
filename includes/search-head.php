<div class="wrapper">
<form name="search" class="search" action="<?php bloginfo('url'); ?>" method="post">
	<p>
		<strong>Search results for:</strong>
		<input type="text" name="search-query" class="search-query" value="<?php echo $_REQUEST['s']; ?>" />
		<label for="search">Search</label>
	</p>
</form>
</div>