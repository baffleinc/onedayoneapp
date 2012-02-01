<?php

class optionsLAB{

	private $title;
	private $slug;
	private $opts;
	private $do_sections;
	private $settings;

	public function __construct($title, $opts){
		$this->title 		= $title;
		$this->slug			= sanitize_title($title);
		$this->opts  		= $opts;
		$this->do_sections 	= array();
		$this->settings 	= get_option('boss_options');
		add_action('admin_menu', array($this, 'add_boss_page'));
		add_action('admin_head', array($this, 'boss_options_init'));
		add_action('wp_ajax_do_the_tags', array($this, 'do_the_tags'));
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('boss-admin', get_bloginfo('stylesheet_directory').'/boss/admin.js', array('jquery'));
	}
	
	public function add_boss_page(){
		add_theme_page(
			$this->title,
			$this->title,
			'edit_theme_options',
			$this->slug,
			array($this, 'boss_options_callback')
		);
	}
	
	public function do_the_tags(){
		extract($_POST);
		
		if(update_option($type.'_homepage_tags', $info)){
			echo 'success';
		} else {
			echo 'fail';
		}
	}
	
	public function boss_options_init(){
	
		register_setting('my_new_setting_id', 'My setting group title', array($this, 'boss_validate'));
		add_settings_section('my_new_section', 'Sweet as section', array($this, 'boss_says_NO'), $this->slug);
		echo $this->slug;
		add_settings_field(
			'my_field_id',
			'My field Title',
			array($this, 'boss_field_callback'),
			$this->slug,
			'my_new_section'
		);
		
		foreach($this->opts as $group => $options) : 
			$gslug = sanitize_title($group);
			register_setting($gslug, $group, array($this, 'boss_validate_options'));
			add_settings_section($group.'_section', $group, array($this, 'boss_says_NO'), sanitize_title($this->title));
				foreach($options as $field) : 
					add_settings_field(
						sanitize_title($field['name']),
						$field['name'],
						array($this, 'boss_field_callback'),
						$this->slug,
						$group.'_section'
					);
				endforeach;
				$this->do_sections[] = array(
					'setting' => sanitize_title($group),
					'section' => $group.'_section'
				);
		endforeach;
	}
	
	public function boss_says_NO(){
		//silence is golden bitchnit
		echo 'yessum';
	}
	
	public function boss_field_callback(){
		echo 'at least I\'m working';
	}
	
	public function boss_validate($input){
		//todo
		return $input;
	}
	
	public function boss_options_callback(){
		?>
			
			<div class="wrap">
				<?php //pr($this->opts); ?>
				<form id="boss_options_form" action="<?php echo get_bloginfo('url').$_SERVER['REQUEST_URI']; ?>" method="post">
					<div id="settings-menu">
						<ul>
							<?php foreach($this->opts as $group => $opts) : ?>
								<li id="link-<?php echo sanitize_title($group); ?>">
									<a href="#section-<?php echo sanitize_title($group); ?>">
										<?php echo $group; ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div id="settings-container">
						<div id="settings-scroller">
							<ul>
								<?php foreach($this->opts as $group => $opts) : ?>
									<li id="section-<?php echo sanitize_title($group); ?>">
										<div class="section-options">
											<ul>
												<?php foreach ($opts as $opt) : ?>
													<li class="form_row" id="opt-row-<?php echo sanitize_title($opt->name); ?>">
														<?php if($opt['type'] != 'freeform') : ?>
															<div class="opt-label">
																<label for="opt-<?php echo sanitize_title($opt->name); ?>">
																	<?php echo $opt['name']; ?>
																</label>
																<p><?php echo $opt['desc']; ?></p>
															</div>
															<div class="opt-input">
																<?php switch($opt['type']){ case 'text'; ?>
																	<input type="text" name="opt-<?php sanitize_title($opt->name); ?>" value="" />
																<?php break; ?>
																	
																<?php } ?>
															</div>
														<?php 
															else : 
																$letypes = array('ipad', 'iphone', 'mac');
																foreach($letypes as $type) :
																
																	//selected ones
																	$tags = get_option($type.'_homepage_tags');
																	
																	//all of them
																	$terms = get_terms($type.'-app-tags', array('exclude' => $tags));
														?>
																	<div class="device-section" id="section-<?php echo $type; ?>">
																		<h3>Available Tags</h3>
																		<div class="tag-bay">
																			<ul id="" class="<?php echo $type; ?>ConnectedSortable tag-bay-list sortable">
																				<?php 
																					foreach($terms as $term) :
																				?>
																					<li id="<?php echo $term->term_id; ?>">
																						<?php echo $term->name; ?>
																					</li>
																				<?php endforeach; ?>
																			</ul>
																			<div class="clearfix"></div>
																		</div>
																		<h3>Active Tags</h3>
																		<div class="active-tags">
																			<div class="tags-loading">&nbsp;</div>
																			<div class="tags-done">&nbsp;</div>
																			<ul class="<?php echo $type; ?>ConnectedSortable active-tags-list sortable">
																				<?php 
																					if($tags) :
																						foreach($tags as $tag) :
																							$tag = get_term($tag, $type.'-app-tags');
																							echo '<li id="'.$term->term_id.'">';
																							echo $tag->name;
																							echo '</li>';
																						endforeach;
																					else : 
																						echo '<li class="empty">Drag tag here</li>';
																					endif;
																				?>
																				
																			</ul>
																			<div class="clearfix"></div>
																		</div>
																	</div>
															<?php endforeach; ?>
														<?php endif; ?>
													</li>
												<?php endforeach; ?>
											</ul>
										</div>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</form>
			</div>
			
		
		<?php
	}

}

?>