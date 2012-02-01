<?php

	/* Template Name: Empty Content */
	
	
    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>

		
	
	        <?php
	        
	        // calling the widget area 'page-top'
	        get_sidebar('page-top');
	
	        
	        thematic_belowpost();
       			        
	        // calling the widget area 'page-bottom'
	        get_sidebar('page-bottom');
	        
	        ?>
	
			

<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling the standard sidebar 
    //thematic_sidebar();
    
    // calling footer.php
    get_footer();

?>