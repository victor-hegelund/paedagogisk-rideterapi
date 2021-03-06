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
<div class="<?php echo trim($container_class) ?>" <?php echo wp_kses_post(blocksy_sidebar_position_attr()); ?> <?php echo $data_container_output; ?> <?php echo blocksy_get_v_spacing() ?>>

    <?php do_action('blocksy:single:container:top'); ?>

    <!-- VORES KODE I SKABELON -->

    <style>

        .relateret_artikler_loop {
            display: flex;
            overflow-x: scroll;
            min-width: 100%;
        }

        .relateret_artikel {
            min-width: 75%;
            margin-right: 40px;
        }

        /* Tablet og op */
        @media screen and (min-width: 689.98px) {
            .top_section .cover_billede {
                float: right;
                width: 50%;
                margin-top: -18px;
                margin-left: 30px;
            }

            .relateret_artikel {
                min-width: 300px;
            }

            .relateret_artikel_img,
            .relateret_artikel_overskrift {
                cursor: pointer;
            }
        }
    </style>

    <article>
        <div class="top_section">
            <h1></h1>
            <img class="cover_billede hexagon" src="" alt="">
        </div>
        <section class="main_section"></section>

        <div class="relateret_artikler">
            <h2>L??s ogs?? disse artikler</h2>
            <div class="relateret_artikler_loop"></div>
        </div>
    </article>

    <template>
        <div class="relateret_artikel">
            <img class="relateret_artikel_img hexagon" src="" alt="">
            <h3 class="relateret_artikel_overskrift"></h3>
            <p class="relateret_artikel_dato"></p>
        </div>
    </template>

    <script>
        //Lav globale variabel
        let artikel;
        let aktuelArtikel = "<?php echo get_the_ID() ?>";

        document.addEventListener("DOMContentLoaded", loadJSON)

        //Load JSON data fra WP REST API
        async function loadJSON() {
            console.log("loadJSON");

            //Hent artikelen
            const JSONData = await fetch("/kea/10_eksamen/p??dagogisk-rideterapi/wp-json/wp/v2/artikel/" + aktuelArtikel);
            artikel = await JSONData.json();
            console.log("artikel: ", artikel);

            //Hent alle artikler
            const JSONData2 = await fetch("/kea/10_eksamen/p??dagogisk-rideterapi/wp-json/wp/v2/artikel?per_page=100");
            artikler = await JSONData2.json();
            console.log("artikler:", artikler);

            visArtikel();
        }

        //Vis den aktuele artikel
        function visArtikel() {
            console.log("visArtikel");
            document.querySelector(".cover_billede").src = artikel.cover_billede.guid;
            document.querySelector("h1").textContent = artikel.title.rendered;
            document.querySelector(".main_section").innerHTML = artikel.content.rendered;
            visArtikler();
        }

        //Vis alle artikler
        function visArtikler() {
            console.log("visArtikler");

            const dest = document.querySelector(".relateret_artikler_loop");

            //Henvis til indhold fra template
            const template = document.querySelector("template").content;

            dest.textContent = "";

            //K??rer funktionen ??n gang for hver enkel artikel
            artikler.forEach(artiklen => {
                const klon = template.cloneNode(true);
                klon.querySelector(".relateret_artikel_img").src = artiklen.cover_billede.guid;
                klon.querySelector(".relateret_artikel_img").addEventListener("click", () => visDetaljer(artiklen))
                klon.querySelector(".relateret_artikel_overskrift").textContent = artiklen.title.rendered;
                klon.querySelector(".relateret_artikel_overskrift").addEventListener("click", () => visDetaljer(artiklen))
                klon.querySelector(".relateret_artikel_dato").textContent = artiklen.dato;
                dest.appendChild(klon);
            })
        }

        //Linker til den enkelte artikel
        function visDetaljer(artiklen) {
            location.href = artiklen.link;
        }

    </script>

    <!-- VORES KODE SLUT I SKABELON -->

    <?php get_sidebar(); ?>

    <?php do_action('blocksy:single:container:bottom'); ?>
</div>

<?php

blocksy_display_page_elements('separated');

have_posts();
wp_reset_query();
