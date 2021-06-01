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
        <div id="primary" class="content-area">
          <h1>Artikler</h1>
          <div class="custom-select">
            <select id="filtrering">
                <option value="alle">Alle</option>
            </select>
          </div>
          <section id="liste"></section>
    </div><!-- #primary -->
    <template>
        <article>
            <div class="img">
                <img class="imgImg" src="" alt="">
            </div>
            <a class="button">Læs mere</a>
        </article>
    </template>

    <script>
    const header = document.querySelector("header h2");

    document.addEventListener("DOMContentLoaded", start)
    let artikler;
    let categories;
    let filterArtikel = "alle";

    // første funktion der kaldes efter DOM er loaded
    function start() {
        const filterKnapper = document.querySelectorAll("select option");
        loadJSON();
    }

    async function loadJSON() {
        const JSONData = await fetch("https://victorhegelund.dk/kea/10_eksamen/pædagogisk-rideterapi/wp-json/wp/v2/artikel?per_page=100");
        const catJSONData = await fetch("https://victorhegelund.dk/kea/10_eksamen/pædagogisk-rideterapi/wp-json/wp/v2/artikel_kategori");
        artikler = await JSONData.json();
        console.log(artikler);
        categories = await catJSONData.json();
        console.log("categories", categories);
        visArtikler();
        opretKnapper();
    }

    function opretKnapper(){
    categories.forEach(cat =>{
        document.querySelector("#filtrering").innerHTML += `<option class="filter" value="${cat.id}">${cat.name}</option>`

    })

    addEventListenerToButtons();
    }

    function addEventListenerToButtons(){
        console.log("addEventListenerToButtons");
        document.querySelector("#filtrering").addEventListener("change", (event) => {
        console.log(event.target.value);
        filterArtikel = event.target.value;
        visArtikler();
        });
    };

    //funktion der viser podcasts i liste view
    function visArtikler() {
        console.log("visArtikler");

        const dest = document.querySelector("#liste"); // container til articles med en podcast
        const template = document.querySelector("template").content; // select indhold af html skabelon (article)
        dest.textContent = "";
        artikler.forEach(artikel => {
            console.log("artikel categories: " + artikel.artikel_kategori.name);
            console.log(filterArtikel)
            if ( filterArtikel == "alle" || artikel.artikel_kategori.includes(parseInt(filterArtikel))){
            const klon = template.cloneNode(true);
            console.log("featured_image: " + artikel.cover_billede.guid);
            klon.querySelector(".imgImg").src = artikel.cover_billede.guid;
            klon.querySelector(".imgImg").addEventListener("click", () => visDetaljer(artikel))
            klon.querySelector(".button").addEventListener("click", () => visDetaljer(artikel))
            dest.appendChild(klon);
            }
        })
    }

    function visDetaljer(artikel) {
        location.href = artikel.link;
    }

    </script>
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

