<?php 

class metaboxLAB{
	private $box;
	private $registered_images;
	//adding post type for array entry
	private $post_types;
	private $registered_fields;
	public $boss_images;
	
	function __construct($name, $post_type = null, $machine_args = null){
		if(is_array($post_type)) {
			foreach($post_type as $type){ 
				$this->post_types[] = $type;
			}
		}
		elseif(!$post_type){ $this->post_types[] = 'post'; }
		else { $this->post_types[] = $post_type; }
		
		$this->boss_images = array();
		
		foreach($machine_args as $field){
			if($field['type'] == 'image'){
				foreach($this->post_types as $type){
					$this->registered_images[] = $field['name'];
				}
			}
			
		}
		
		if(!$machine_args) :
			$machine_args = array(
				0 => array(
					'type' => 'empty_args',
					'desc' => 'GO SON, create a new metabox with the code in <code>config/config.metaboxes.php</code>',
					'name' => 'You\'ve just made a metabox like a BOSS.'
				)
			);
		endif;
		
		$this->box = array(
			'name'	=> $name,
			'id'	=> sanitize_title($name),
			'post_types' => $this->post_types,
			'opts'		=> $machine_args,
		);
		
		$this->registered_fields = array();
		
		add_action('admin_init', array($this, 'boss_meta_init'));
		add_action('save_post', array($this, 'boss_save_meta'));
	}
	
	public function boss_meta_init(){
		
		foreach($this->post_types as $post_type) :

		    add_meta_box(
		    	$this->box['id'],
		    	$this->box['name'],
		    	array($this, 'boss_metabox_machine'),
		    	$post_type,
		    	'advanced',
		    	'low'
		    );
		endforeach;	
	}
	
	public function boss_metabox_machine(){
		global $post;
		
		echo '<div class="metabox-fields">';
		//echo '<a href="#" id="show_hide_meta">Show/hide Meta</a>';
		$theMeta = get_post_custom($post->ID);
		//pr($theMeta);
		foreach($this->box['opts'] as $field) : 
			$key = sanitize_title($field['name']);
			$value = get_post_meta($post->ID, $key, true);
			
			switch($field['type']){
			
				case 'empty_args' : ?>
					<div class="meta_row">
						<h2><?php echo $field['name']; ?></h2>
						<p class="heading-desc"><?php echo $field['desc']; ?></p>
					</div>
		<?php	break;
			
				/* Code for headings */
				case 'heading' : ?>
					<div class="meta_row">
						<div class="label">&nbsp;</div>
						<div class="data">
							 <h2><?php echo $field['name']; ?></h2>
							 <p class="heading-desc"><?php echo $field['desc']; ?></p>
						</div>
						<div class="clearfix"></div>
					</div>
		<?php 	
				
				break;
				/* Code for text inputs */
				case 'text' : ?>
					
					<div class="meta_row">
						<div class="label">
							<strong><label for="<?php echo sanitize_title($field['name']); ?>"><?php echo $field['name']; ?></label></strong>
							<p><?php echo $field['desc']; ?></p>
						</div>
						<div class="data">
							<div class="text-input">
								<input type="text" id="<?php echo sanitize_title($field['name']); ?>" name="<?php echo sanitize_title($field['name']); ?>" value="<?php echo $value; ?>" <?php if($field['placeholder']) echo 'placeholder="'.$field['placeholder'].'"'; ?>>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					
		<?php	break;
				
				/* Code for textareas inputs */
				case 'textarea' : ?>
					<div class="meta_row">
						<div class="label">
							<strong><label for="<?php echo sanitize_title($field['name']); ?>"><?php echo $field['name']; ?></label></strong>
							<p><?php echo $field['desc']; ?></p>
						</div>
						<div class="data">
							<div class="textarea">
								<textarea id="<?php echo sanitize_title($field['name']); ?>" name="<?php echo sanitize_title($field['name']); ?>"><?php echo $value; ?></textarea>
							</div>
							
						</div>
						<div class="clearfix"></div>
					</div>
		<?php	break;
				
				/* temp code for file input */
				
				case 'image' : 
				//handled by $this->add_the_damn_image();
		
				/* Code for file input. */
				
		break; case 'file' : ?>
					<div class="meta_row">
						<div class="label">
							<strong><label for="<?php echo sanitize_title($field['name']); ?>"><?php echo $field['name']; ?></label></strong>
							<p><?php echo $field['desc']; ?></p>
						</div>
						<div class="data">
							<div class="file-input">
								<?php if($value != '') : ?>
									<div class="meta_img">
										<img src="<?php echo $value; ?>" alt="">
									</div>
								<?php endif; ?>
								<input type="file" id="<?php echo sanitize_title($field['name']); ?>" name="<?php echo sanitize_title($field['name']); ?>" value="<?php echo $value; ?>">
								<p class="note">New file will be uploaded upon saving of post.</p>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
		<?php	break;
		
				/* Code for checkbox meta */
				case 'checkbox' : ?>
					<div class="meta_row">
						<div class="label">
							<strong><label for="<?php echo sanitize_title($field['name']); ?>"><?php echo $field['name']; ?></label></strong>
						</div>
						<div class="data">
							<div class="checkbox-input">
								<p><input type="checkbox" id="<?php echo sanitize_title($field['name']); ?>" name="<?php echo sanitize_title($field['name']); ?>" value="horizontal-app" <?php if($value == 'horizontal-app') echo 'checked="checked"'; ?>> <?php echo $field['desc']; ?></p>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
		<?php	break; 
		
				/* Code for select meta */
				case 'select' : ?>
					<div class="meta_row">
						<div class="label">
							<strong><label for="<?php echo sanitize_title($field['name']); ?>"><?php echo $field['name']; ?></label></strong>
							<p><?php echo $field['desc']; ?></p>
						</div>
						<div class="data">
							<div class="select-input">
								<select id="<?php echo sanitize_title($field['name']); ?>" name="<?php echo sanitize_title($field['name']); ?>">
									<?php foreach ($field['opts'] as $option) : ?>
										<option value="<?php echo $option; ?>"<?php if($value == $option) echo 'selected="selected"'; ?>><?php echo $option; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					
				
		<?php 	break;
					
			}
			
			//This adds every single field that IS rendered to a list.
			//This list will be saved in an option, and then reffered
			//to later when we need to save all the options.
			if($field['type'] != 'heading' || $field['type'] != 'empty_args' || $field['type'] != 'image') : 
				$this->registered_fields[] = sanitize_title($field['name']);
			endif;
			
		endforeach;
		//$extra_fields = '';
		//echo '<input type="hidden" id="extra_field_ids" name="extra_field_ids" value=""/>';
		echo '</div>';
		
		//array to string before update of list
		$final_load_register = implode(', ', $this->registered_fields);
		update_option('registered_meta_fields', $final_load_register);
		
	}
	
	public function boss_save_meta(){
		global $post;
		
		if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
		(defined('DOING_AJAX') && DOING_AJAX)
		|| isset($_REQUEST['bulk_edit'])){
			return $post_id;
		} else {
			$post_id = $post->ID;
		}
		//$extra_fields = $_POST['extra_field_ids'];
	
		//string to array before we save the options
		$fields_to_save = explode(', ', get_option('registered_meta_fields'));
		//array_push($fields_to_save, $post_image_links);
		foreach($fields_to_save as $field) : 
			update_post_meta($post_id, $field, $_POST[$field]);
		endforeach;
	}
}