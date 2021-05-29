<?php
add_action( 'wp_enqueue_scripts', 'enqueue_important_files' );
function enqueue_important_files() {
// This will load child style.css file
	wp_enqueue_style('blocksy-child-style', get_stylesheet_uri());
}
?>
