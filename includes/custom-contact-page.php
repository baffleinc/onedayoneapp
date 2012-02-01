<form id="contact-form" action="/contact/" method="post">
	<h2>Get in touch <div class="loading">&nbsp;</div></h2>
	
	<div id="content-or-contact-box">
		<ul>
			<li id="ge-button" class="active-type-button">general enquiries</li>
			<li id="sa-button">submit an app</li>
		</ul>
		<input type="hidden" name="contact_type" id="contact-type" class="text" value="message" >
	</div>
	<div class="contact-form-fields">
		<?php
			$contact_fields = array();
			
			$contact_fields[] = array(
				'type' => 'text',
				'label' => 'Your name'
			);
			
			$contact_fields[] = array(
				'type' => 'text',
				'label' => 'Your email',
				'valid' => 'email'
			);
			
			$contact_fields[] = array(
				'type' => 'textarea',
				'label' => 'A nice description'
			);
			
			$contact_fields[] = array(
				'type' => 'submit',
				'label' => 'Alrighty!'
			);
			
			$contact_fields[] = array(
				'type' => 'text',
				'label' => 'App Name'
			);
			
			$contact_fields[] = array(
				'type' => 'radiogroup',
				'label' => 'App Type'
			);
			
			$contact_fields[] = array(
				'type' => 'categories',
				'label' => 'Category'
			);
			
			$contact_fields[] = array(
				'type' => 'text',
				'label' => 'App Store Link'
			);
			
			$contact_fields[] = array(
				'type' => 'text',
				'label' => 'Developer Name'
			);
			
			$contact_fields[] = array(
				'type' => 'text',
				'label' => 'Developer Link'
			);
			
			$contact_fields[] = array(
				'type' => 'text',
				'label' => 'Price'
			);
			
			echo '<div class="contact-left-col">';
			foreach($contact_fields as $field) : 
			
				//if($field['valid'] $validate = 'validate_'.$field['valid'];
				$the_id = 'contact_vars['.strtolower(str_replace(' ', '_', $field['label'])).']';
				echo '<div class="contact-input '.$field['type'].'">';
					echo '<label for="'.$the_id.'" class="contact-label">'.$field['label'].'</label>';
					switch($field['type']){
					
						case 'text' : ?>
						
							<p><input type="text" name="<?php echo $the_id; ?>" id="<?php echo $the_id ?>" /></p>
						
		<?php break;	case 'textarea' : ?>
		
							<p><textarea name="contact_vars[contact_message]" id="<?php echo $the_id ?>"></textarea></p>
							
		<?php break;	case 'submit' : ?>
							
							<p><input type="submit" name="contact_vars[submit_contact_form]" id="<?php echo $the_id; ?>" value="Send Message"/></p>
							
		<?php break;	case 'radiogroup' : ?>
		
								<div class="app-type-buttons">
									<ul>
										<?php $types = array('ipad', 'iphone', 'mac'); ?>
										<?php foreach($types as $type) : ?>
											<li id="app-type-button-<?php echo $type; ?>" title="<?php echo $type.'-cat-group'; ?>">
												<em>
												<input type="radio" name="<?php echo $the_id; ?>" id="<?php echo $the_id; ?>" value="<?php echo $type; ?>-app"  title="<?php echo $type; ?>" /><?php echo $type; ?></em>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							
		<?php break;	case 'categories' : ?>
							<input type="hidden" id="cat-field-id" value="<?php echo $the_id; ?>">
							
							<?php
								$args = array(
									'orderby' => 'count',
									'hide_empty' => 0
								);
								
								foreach($types as $type) : ?>
								
									<select id="<?php echo $type.'-cat-group'; ?>" class="cat-group">
									<?php foreach(get_terms($type.'-app-category', $args) as $cat) : ?>
										<option value="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></option>
									<?php endforeach; ?>
									</select><br>
								
						  <?php endforeach; 
				break; } // switch
					
				echo '</div>';
				
				if($field['type'] == 'submit') echo '</div> <div class="contact-right-col">';
				
			endforeach;
			echo '</div>';
		?>
	</div>
	<p>&nbsp;</p>
</form>