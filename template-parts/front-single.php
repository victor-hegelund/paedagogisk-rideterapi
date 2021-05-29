<?php
/*
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blocksy
 */

if (have_posts()) {
	the_post();
}

/**
 * Note to code reviewers: This line doesn't need to be escaped.
 * Function blocksy_output_hero_section() used here escapes the value properly.
 */
if (apply_filters('blocksy:single:has-default-hero', true)) {
	echo blocksy_output_hero_section([
		'type' => 'type-2'
	]);
}

$page_structure = blocksy_get_page_structure();

$container_class = 'ct-container-full';
$data_container_output = '';

if ($page_structure === 'none' || blocksy_post_uses_vc()) {
	$container_class = 'ct-container';

	if ($page_structure === 'narrow') {
		$container_class = 'ct-container-narrow';
	}
} else {
	$data_container_output = 'data-content="' . $page_structure . '"';
}

ob_start();
the_content(
	sprintf(
		wp_kses(
			/* translators: %s: Name of current post. Only visible to screen readers */
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blocksy' ),
			array(
				'span' => array(
					'class' => array(),
				),
			)
		),
		get_the_title()
	)
);
$post_content = ob_get_clean();

?>
	<!-- VORES KODE UDENFOR SKABELON -->

	<!-- VORES KODE SLUT UDENFOR SKABELON -->
	<div
		class="<?php echo trim($container_class) ?>"
		<?php echo wp_kses_post(blocksy_sidebar_position_attr()); ?>
		<?php echo $data_container_output; ?>
		<?php echo blocksy_get_v_spacing() ?>>

		<?php do_action('blocksy:single:container:top'); ?>

		<!-- VORES KODE I SKABELON -->

		<style>
		.cls-2{
			fill:rgb(222,213,207,0.6);
		}

		.imgTestDiv{

		}

		.imgTest{
			width: 100%;
			height: 100%;
			/* object-fit: cover; */
			clip-path: polygon(26% 5%, 86% 21%, 100% 54%, 73% 95%, 11% 72%, 0 31%);
		}
		</style>
		<p>Tekst</p>
		<div class="imgTestDiv">
		<img class="imgTest" src="https://victorhegelund.dk/kea/10_eksamen/p%C3%A6dagogisk-rideterapi/wp-content/uploads/hest_1000x886.jpg" alt="">
		</div>

		<video class="imgTest video" controls poster="https://victorhegelund.dk/kea/10_eksamen/p%C3%A6dagogisk-rideterapi/wp-content/uploads/HestVideoCoverImg.png">
			<source src="https://victorhegelund.dk/kea/10_eksamen/p%C3%A6dagogisk-rideterapi/wp-content/uploads/videoTest.mp4" type="video/mp4">
			Your browser does not support HTML video.
		</video>
		<!-- VORES KODE SLUT I SKABELON -->

		<?php
			/**
			 * Note to code reviewers: This line doesn't need to be escaped.
			 * Function blocksy_single_content() used here escapes the value properly.
			 */
			echo blocksy_single_content($post_content);
		?>


		<?php get_sidebar(); ?>

		<?php do_action('blocksy:single:container:bottom'); ?>
	</div>

<?php

blocksy_display_page_elements('separated');

have_posts();
wp_reset_query();

