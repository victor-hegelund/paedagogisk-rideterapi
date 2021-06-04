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
		<style>

			.mobil_video{
				display: block;
			}

			.mobil_video_tekst{
				text-align: center;
			}

			.desktop_video{
				display: none;
			}

			.velkommen{
				margin-top: 60px;
			}

			.velkommen img{
				margin-top: -18px;
			}

			.velkommen_tekst, .anmeldelse{
				margin: auto 0;
			}

			.anmeldelse{
				display: block;
			}

			.anmeldelser_section{
				background-color: #EDE8E4;
				margin-top: 60px;
				padding-top: 60px;
			}

			.anmeldelser_section h2{
				text-align: center;
			}

			[data-vertical-spacing*='bottom']{
				padding-bottom: 0 !important;
			}

			main#main.site-main.hfeed{
				margin-bottom: 0;
			}

			footer{
				margin-top: 0;
			}

			.mobil_video_tekst .pil_ned{
					display: block;
				}


			.anmeldelser_tekst{
				font-weight: bold;
			}

			@media screen and (min-width: 689.98px) {
				footer{
				margin-top: -64px;
			}
			}

			@media screen and (min-width: 1000px) {
				.mobil_video{
					display: none;
				}
				.desktop_video{
					display: block;
					height: calc(100vh - 120px) !important;
					position: relative;
				}
				.desktop_video video{
					object-fit: cover;
					width: 100%;
					height: calc(100vh - 120px) !important;
				}

				.desktop_video svg{
					position: absolute;
					width: 60%;
					height: auto;
					max-height: 70%;
					display: block;
					margin: 0 auto;
					max-height: calc(100vh - 120px) !important;
					bottom: 0px;

					left: 0;
					right: 0;
					margin-left: auto;
					margin-right: auto;
				}

				.disktop_video_tekst{
					position: absolute;
					width: 45%;
					left: 0;
					right: 0;
					margin-left: auto;
					margin-right: auto;
					bottom: 0px;
					text-align: center;
					padding-bottom: 30px;
				}

				.disktop_video_tekst h1{
					margin-bottom: 10px;
				}

				.disktop_video_tekst p{
					margin-bottom: 10px;
				}

				.disktop_video_tekst svg{
					height: 15px;
					margin-bottom: 10px;
					display: block;
				}

				footer{
					margin-top: -100px;
				}
			}
		</style>


		<div class="mobil_video skabelon">
			<video class="hexagon" style="opacity:1;" data-mode="fill" playsinline="playsinline" webkit-playsinline="webkit-playsinline" onloadstart="this.n2LoadStarted=1;" data-keepplaying="1" preload="metadata" muted="muted" loop="loop" data-reset-slide-change="1" autoplay loop>
				<source src="https://victorhegelund.dk/kea/10_eksamen/p%C3%A6dagogisk-rideterapi/wp-content/uploads/front-mobil.mp4" type="video/mp4">
			</video>
			<div class="mobil_video_tekst">
				<h1>Velkommen til</br>Pædagogisk Rideterapi</h1>
				<p>hos Maria Knak</p>
				<a class="anmeldelser_tekst" href="#anmeldelser">Læs vores anmeldelser</a>
				<a class="pil_ned" href="#anmeldelser">
					<svg xmlns="http://www.w3.org/2000/svg" width="30.637" height="14.364" viewBox="0 0 30.637 14.364">
						<path id="Path_154" data-name="Path 154" d="M172.775,692.691l14.393,11.278,14.393-11.278" transform="translate(-171.85 -691.51)" fill="none" stroke="#84391e" stroke-width="3"/>
					</svg>
				</a>
			</div>
		</div>


		<div class="desktop_video">
			<video class="" style="opacity:1;" data-mode="fill" playsinline="playsinline" webkit-playsinline="webkit-playsinline" onloadstart="this.n2LoadStarted=1;" data-keepplaying="1" preload="metadata" muted="muted" loop="loop" data-reset-slide-change="1" autoplay loop>
				<source src="https://victorhegelund.dk/kea/10_eksamen/p%C3%A6dagogisk-rideterapi/wp-content/uploads/front-desktop.mp4" type="video/mp4">
			</video>
			<svg xmlns="http://www.w3.org/2000/svg" width="1127.64" height="474.36" viewBox="0 0 1127.64 474.36">
				<path id="Path_161" data-name="Path 161" d="M1127.64,474.36H47.22L0,298.42,306.3,0l702.94,188.47Z" fill="#eae5e1" opacity="0.9"/>
			</svg>
			<div class="disktop_video_tekst">
				<h1>Velkommen til</br>Pædagogisk Rideterapi</h1>
				<p>hos Maria Knak</p>
				<a class="anmeldelser_tekst" href="#anmeldelser">Læs vores anmeldelser</a>
				<a href="#anmeldelser">
					<svg xmlns="http://www.w3.org/2000/svg" width="30.637" height="14.364" viewBox="0 0 30.637 14.364">
						<path id="Path_154" data-name="Path 154" d="M172.775,692.691l14.393,11.278,14.393-11.278" transform="translate(-171.85 -691.51)" fill="none" stroke="#84391e" stroke-width="3"/>
					</svg>
				</a>
			</div>
		</div>


	<!-- VORES KODE SLUT UDENFOR SKABELON -->
	<div
		class="<?php echo trim($container_class) ?>"
		<?php echo wp_kses_post(blocksy_sidebar_position_attr()); ?>
		<?php echo $data_container_output; ?>
		<?php echo blocksy_get_v_spacing() ?>>

		<?php do_action('blocksy:single:container:top'); ?>

		<!-- VORES KODE I SKABELON -->
		<article>
			<div id="velkommen" class="velkommen two_columns">
				<img class="hexagon" src="https://victorhegelund.dk/kea/10_eksamen/p%C3%A6dagogisk-rideterapi/wp-content/uploads/IMG_0135-3.jpg" alt="">
				<div class="velkommen_tekst">
					<h2>Pædagogisk ridning i Nakskov</h2>
					<p>Pædagogisk ridning er et specielt tilrettelagt forløb i samvær med hesten. I pædagogisk ridning arbejdes der med klientens kropssprog, tillid, koncentration, opmærksomhed og relation til hesten gennem læring i omgang med hesten. I arbejdet med hesten handler det om at opbygge en tillid op til sig selv. Der lægges vægt på, at det hele foregår i trygge rammer og at der er ro omkring arbejdet og samværet med hesten. Det hele foregår på min gård i Nakskov, sammen med mig Maria Knak.</p>
					<a class="button" href="/kea/10_eksamen/pædagogisk-rideterapi/hvad-er-rideterapi">Hør mig fortælle mere</a>
				</div>
			</div>
		</article>


		<section class="anmeldelser_section" id="anmeldelser">
			<div class="skabelon">
				<h2>Mine anmeldelser</h2>

				<div class="two_columns">
					<img class="hexagon" src="https://victorhegelund.dk/kea/10_eksamen/p%C3%A6dagogisk-rideterapi/wp-content/uploads/anmeldelseEt.jpg" alt="Kvinde">
					<div class="anmeldelse anmeldelseEt">
						<h3>Anmeldelse fra Hanne Olsen</h3>
						<p>"Maria er utrolig rar og varm om hjertet, hun går til min datter i undervisningen, med et åbent sind og en stor respekt for min datters integritet.</p>
						<p>Maria er god til at aflæse min datter, og får hende til at føle sig tryg - samtidig med at hun at hun bliver udfordret. Jeg kan varmt anbefale Maria"</p>
					</div>

					<div class="anmeldelse anmeldelseTo">
						<h3>Anmeldelse fra Marianne Carlsen</h3>
						<p>"Maria Knak og hendes heste er fantastiske - de har gjort alverden for vores datter  da hun startede lå hendes selvtillid på et meget lille sted - hun var usikker på sin krop og ballance, men hun er kommet rigtig rigtig langt, og hun udvikler sig stadig for hver gang hun kommer. Vi kan kun give Pædagogisk Ridning vores klare anbefaling"</p>
					</div>
					<img class="hexagon" src="https://victorhegelund.dk/kea/10_eksamen/p%C3%A6dagogisk-rideterapi/wp-content/uploads/anmeldelseTo.jpg" alt="Kvinde">
				</div>
			</div>
		</section>


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

