<?php 

$obj = get_queried_object();
$tit = strtolower($obj->post_title);
if($tit == 'ipad'){
	$hometags = get_option($tit.'_homepage_tags');
	echo '<ul id="'.$tit.'-tag-menu" class="tabs-tags">';
	foreach($hometags as $tag) :
	$term = get_term($tag, $tit.'-app-tags');
	//pr($term);
 ?>
		<li class="tag-menu-item-<?php echo $term->slug; ?>">
			<a href="<?php echo get_term_link($term, $tit.'-app-tags'); ?>"><?php echo $term->name; ?></a>
		</li>
	<?php endforeach;
	echo '</ul>';
}
?>

<?php echo '<div id="TAKETHEWRAPPER"><div id="loading">&nbsp;</div></div><div id="TAKETHENAV">&nbsp;</div>';









//	 [term_id] => 378
//   [name] => news
//   [slug] => news-3
//   [term_group] => 0
//   [term_taxonomy_id] => 395
//   [taxonomy] => ipad-app-tags
//   [description] => 
//   [parent] => 0
//   [count] => 2