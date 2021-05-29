<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blocksy
 */

get_header();

get_mobilmenu();

if (
	! function_exists('elementor_theme_do_location')
	||
	! elementor_theme_do_location('archive')
) {
	get_template_part('template-parts/archive');
}

get_footer();
