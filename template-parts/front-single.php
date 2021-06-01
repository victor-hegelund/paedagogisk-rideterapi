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
			.sekund_section{
				background-color: #00464F;
			}

			.sekund_section p, .sekund_section h2, .sekund_section h3{
				color: #fff;
			}

			.sekund_section h2{
				text-align: center;
			}

		</style>

		<article>
			<section class="first_section">
				<img class="hexagon" src="https://victorhegelund.dk/kea/10_eksamen/p%C3%A6dagogisk-rideterapi/wp-content/uploads/hest_1000x886.jpg" alt="Maria Knak fra Pædagogisk Rideterapi">
				<h1>Pædagogisk Rideterapi</h1>
				<p>hos Maria Knak</p>
				<a href="#">Læs vores anmeldelser</a>
			</section>

			<section class="sekund_section">
				<h2>Mine anmeldelser</h2>
				<div class="two_columns">
					<div class="anmeldelse_et">
						<h3>Anmeldelse fra Hanne Olsen</h3>
						<p>"Maria er utrolig rar og varm om hjertet, hun går til min datter i undervisningen, med et åbent sind og en stor respekt for min datters integritet.</p>
						<p>Maria er god til at aflæse min datter, og får hende til at føle sig tryg - samtidig med at hun at hun bliver udfordret. Jeg kan varmt anbefale Maria"</p>
						<img class="hexagon" src="https://victorhegelund.dk/kea/10_eksamen/p%C3%A6dagogisk-rideterapi/wp-content/uploads/Women.jpg" alt="Kvinde">
					</div>
					<div class="anmeldelse_to">
					<h3>Anmeldelse fra Marianne Carlsen</h3>
					<p>"Maria Knak og hendes heste er fantastiske - de har gjort alverden for vores datter  da hun startede lå hendes selvtillid på et meget lille sted - hun var usikker på sin krop og ballance, men hun er kommet rigtig rigtig langt, og hun udvikler sig stadig for hver gang hun kommer. Vi kan kun give Pædagogisk Ridning vores klare anbefaling"</p>
					<img class="hexagon" src="https://victorhegelund.dk/kea/10_eksamen/p%C3%A6dagogisk-rideterapi/wp-content/uploads/Women.jpg" alt="Kvinde">
					</div>
				</div>
			</section>

		</article>
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

