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
        </style>

        <article>
            <div class="top_section">
                <h1></h1>
                <img class="cover_billede" src="" alt="">
            </div>
            <section class="main_section"></section>
        </article>
        <div class="relateret_artikler">
            <h2></h2>
            <div class="relateret_artikler_loop"></div>
        </div>


        <template>
                <div class="relateret_artikel">
                    <img class="relateret_artikel_img" src="" alt="">
                    <h3 class="relateret_artikel_overskrift"></h3>
                    <p class="relateret_artikel_dato"></p>
                </div>


        </template>

        <script>
        let artikel;
        let aktuelArtikel = "<?php echo get_the_ID() ?>";
        console.log("ID: " + aktuelArtikel);
        document.addEventListener("DOMContentLoaded", loadJSON)

        async function loadJSON() {
            console.log("loadJSON");
            const JSONData = await fetch("https://victorhegelund.dk/kea/10_eksamen/pædagogisk-rideterapi/wp-json/wp/v2/artikel/" + aktuelArtikel);
            console.log(JSONData);
            artikel = await JSONData.json();
            console.log("artikel");
            console.log("artikel: ", artikel);


            const JSONData2 = await fetch("https://victorhegelund.dk/kea/10_eksamen/pædagogisk-rideterapi/wp-json/wp/v2/artikel?per_page=100");
            artikler = await JSONData2.json();

            console.log("Episoder:", artikler);
            visArtikel();
            visArtikler();
        }

        function visArtikel() {
            document.querySelector(".cover_billede").src = artikel.cover_billede.guid;
            document.querySelector("h1").textContent = artikel.title.rendered;
            document.querySelector(".main_section").innerHTML = artikel.content.rendered;
        }

        function visArtikler() {
        console.log("visArtikler");

        const dest = document.querySelector(".relateret_artikler_loop");
        const template = document.querySelector("template").content;
        dest.textContent = "";
        console.log("Her til!");
        artikler.forEach(artiklen => {
            console.log("artiklen: " + artiklen);

                console.log(artiklen);
                const klon = template.cloneNode(true);
                klon.querySelector(".relateret_artikel_img").src = artiklen.cover_billede.guid;
                klon.querySelector(".relateret_artikel_img").addEventListener("click", () => visDetaljer(artiklen))
                klon.querySelector(".relateret_artikel_overskrift").textContent = artiklen.title.rendered;
                klon.querySelector(".relateret_artikel_overskrift").addEventListener("click", () => visDetaljer(artiklen))
                klon.querySelector(".relateret_artikel_dato").textContent = artiklen.date;
                dest.appendChild(klon);

        })

    }

    function visDetaljer(artiklen) {
        location.href = artiklen.link;
    }

    </script>


	</div><!-- #primary -->
		<!-- VORES KODE SLUT I SKABELON -->





		<?php get_sidebar(); ?>

		<?php do_action('blocksy:single:container:bottom'); ?>
	</div>

<?php

blocksy_display_page_elements('separated');

have_posts();
wp_reset_query();
