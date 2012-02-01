<?php 

//THIS LOADS ALL BOSS COMPONENTS
require_once('metaboxes.php');
require_once('posttypes.php');
require_once('t-options.php');
require_once('config_args.php');

//pulls in arguments

new metaboxLAB('App meta', array('ipad-app', 'iphone-app', 'mac-app'), $metabox_fields['App']);

new posttypeLAB('iPad App', 'iPad Apps', $post_type_args['iPad'], $post_tax_args['iPad']);
new posttypeLAB('iPhone App', 'iPhone Apps', $post_type_args['iPhone'], $post_tax_args['iPhone']);
new posttypeLAB('Mac App', 'Mac Apps', $post_type_args['Mac'], $post_tax_args['Mac']);

new optionsLAB('Theme settings', $theme_options_args);