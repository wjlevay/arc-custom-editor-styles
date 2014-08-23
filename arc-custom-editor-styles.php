<?php
/*
  Plugin Name: ARC TinyMCE Styles
  Description: Adds custom style options to the TinyMCE editor.

  see here: http://www.wpkube.com/add-dropdown-css-style-selector-visual-editor/
  and here: https://codex.wordpress.org/TinyMCE_Custom_Styles
*/

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

// Add the Button CSS to the Dropdown Menu
// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {
 
// Define the style_formats array
$style_formats = array(
 
// Each array child is a format with its own settings
array(
	'inline' => 'span',
	'title' => 'Highlight',
	'classes' => 'highlight',
),
array(
	'inline' => 'span',
	'title' => 'Lightweight',
	'classes' => 'lightweight',
),
array(
	'inline' => 'span',
	'title' => 'Mediumweight',
	'classes' => 'mediumweight',
),
array(
	'inline' => 'span',
	'title' => 'Heavyweight',
	'classes' => 'heavyweight',
),
);
 
// Insert the array, JSON ENCODED, into 'style_formats'
$init_array['style_formats'] = json_encode( $style_formats );
return $init_array;
}
 
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

// Display custom style in the TinyMCE editor
function plugin_mce_css( $mce_css ) {
	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	$mce_css .= plugins_url( 'custom-editor-style.css', __FILE__ );

	return $mce_css;
}
add_filter( 'mce_css', 'plugin_mce_css' );