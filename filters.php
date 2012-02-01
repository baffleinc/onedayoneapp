<?php

add_filter('thematic_postcomment_text', 'change_comments_title');
add_filter('thematic_singlecomment_text', 'change_single_comment_number');
add_filter('thematic_multiple_comments_number', 'change_multiple_comments_number');
add_filter('thematic_comment_form_args', 'edit_commentform_args');
add_filter('thematic_sidebar', 'rid_of_sidebar');

function change_comments_title($content){
	$content = 'Leave a comment'; return $content;}

function change_single_comment_number($content){
	$content = 'Comments [1]'; return $content;}
	
function change_multiple_comments_number($content){
	$content = 'Comments [%d]'; return $content;}

function rid_of_sidebar($bool){return false;}
	
function edit_commentform_args($args){

	$args['comment_notes_after'] = '';
	$args['comment_notes_before'] = '<p class="comment-notes">Share your thoughts...</p>';
	$args['fields'] =  array(
		'author' => '<div id="form-section-author" class="form-section"><div class="form-label">' . '<label for="author">' . __( 'Name', 'thematic' ) . '</label> ' . ( $req ? __('<span class="required">*</span>', 'thematic') : '' ) . '</div>' . '<div class="form-input">' . '<input placeholder="Name" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' .  ' maxlength="20" tabindex="3"' . $aria_req . ' /></div></div><!-- #form-section-author .form-section -->',
		'email'  => '<div id="form-section-email" class="form-section"><div class="form-label"><label for="email">' . __( 'Email', 'thematic' ) . '</label> ' . ( $req ? __('<span class="required">*</span>', 'thematic') : '' ) . '</div><div class="form-input">' . '<input placeholder="Email" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="50" tabindex="4"' . $aria_req . ' /></div></div><!-- #form-section-email .form-section -->',
		'url'    => '<div id="form-section-url" class="form-section"><div class="form-label"><label for="url">' . __( 'Website', 'thematic' ) . '</label></div>' . '<div class="form-input"><input placeholder="Website" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="50" tabindex="5" /></div></div><!-- #form-section-url .form-section -->',
	);
	return $args;
}

function childtheme_override_page_title() {
	
	global $post;
	
	$content = '';
	if (is_attachment()) {
			$content .= '<h2 class="page-title"><a href="';
			$content .= apply_filters('the_permalink',get_permalink($post->post_parent));
			$content .= '" rev="attachment"><span class="meta-nav">&laquo; </span>';
			$content .= get_the_title($post->post_parent);
			$content .= '</a></h2>';
	} elseif (is_author()) {
			$content .= '<h1 class="page-title author">';
			$author = get_the_author_meta( 'display_name' );
			$content .= __('Author Archives: ', 'thematic');
			$content .= '<span>';
			$content .= $author;
			$content .= '</span></h1>';
	} elseif (is_category()) {
			$content .= '<h1 class="page-title">';
			$content .= __('Category Archives:', 'thematic');
			$content .= ' <span>';
			$content .= single_cat_title('', FALSE);
			$content .= '</span></h1>' . "\n";
			$content .= '<div class="archive-meta">';
			if ( !(''== category_description()) ) : $content .= apply_filters('archive_meta', category_description()); endif;
			$content .= '</div>';
	} elseif (is_search()) {
			$content .= '<h1 class="page-title">';
			$content .= __('Search Results for:', 'thematic');
			$content .= ' <span id="search-terms">';
			$content .= esc_html(stripslashes($_GET['s']));
			$content .= '</span></h1>';
	} elseif (is_tag()) {
			$content .= '<h1 class="page-title">';
			$content .= __('Tag Archives:', 'thematic');
			$content .= ' <span>';
			$content .= __(thematic_tag_query());
			$content .= '</span></h1>';
	} elseif (is_tax()) {
		    global $taxonomy;
			$content .= '<h1 class="page-title">';
			$tax = get_taxonomy($taxonomy);
			$content .= $tax->labels->name . ' ';
			$content .= __('Archives:', 'thematic');
			$content .= ' <span>';
			$content .= thematic_get_term_name();
			$content .= '</span></h1>';
	}	elseif (is_day()) {
			$content .= '<h1 class="page-title">';
			$content .= sprintf(__('Daily Archives: <span>%s</span>', 'thematic'), get_the_time(get_option('date_format')));
			$content .= '</h1>';
	} elseif (is_month()) {
			$content .= '<h1 class="page-title">';
			$content .= sprintf(__('Monthly Archives: <span>%s</span>', 'thematic'), get_the_time('F Y'));
			$content .= '</h1>';
	} elseif (is_year()) {
			$content .= '<h1 class="page-title">';
			$content .= sprintf(__('Yearly Archives: <span>%s</span>', 'thematic'), get_the_time('Y'));
			$content .= '</h1>';
	} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
			$content .= '<h1 class="page-title">';
			$content .= __('Blog Archives', 'thematic');
			$content .= '</h1>';
	}
	$content .= "\n";
	echo apply_filters('thematic_page_title', $content);
}
