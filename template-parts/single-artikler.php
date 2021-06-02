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
            .img svg {

            }
            .img img {

                width: 100%;
            }

            #filtrering button{
                margin: 5px 30px;
            }

            .imgImg, .overskrift{
                cursor: pointer;
            }

        </style>

        <article id="primary" class="content-area">
          <h1>Artikler</h1>
          <div class="custom-select">
            <nav id="filtrering">
                <button class="button valgt" data-kategori="alle">Alle</button>
            </nav>
          </div>
          <section id="liste" class="two_columns"></section>
        </article><!-- #primary -->
    <template>
        <article>
            <div class="img">
                <img class="imgImg hexagon" src="" alt="">
            </div>
            <h2 class="overskrift"></h2>
            <p class="dato"></p>
            <a class="button">Læs mere</a>
        </article>
    </template>

<script>
    let filter = "alle";
    document.addEventListener("DOMContentLoaded", loadJSON)

    async function loadJSON() {
        console.log("loadJSON");
        const JSONData = await fetch("/kea/10_eksamen/pædagogisk-rideterapi/wp-json/wp/v2/artikel?per_page=100");
        const catJSONData = await fetch("/kea/10_eksamen/pædagogisk-rideterapi/wp-json/wp/v2/artikel_kategori");
        artikler = await JSONData.json();
        console.log("Artikler", artikler);
        categories = await catJSONData.json();
        console.log("Categories", categories);
        opretKnapper();
    }

    function opretKnapper(){
        console.log("opretKnapper");
        categories.forEach(cat =>{
            document.querySelector("#filtrering").innerHTML += `<button class="button" data-kategori="${cat.id}">${cat.name}</button>`
        })
        const filterKnapper = document.querySelectorAll("nav button");
        filterKnapper.forEach(knap => knap.addEventListener("click", filterKategori));
        visArtikler();
    }

    function filterKategori() {
        console.log("filterKategori");
        filter = this.dataset.kategori;
        document.querySelector(".valgt").classList.remove("valgt")
        this.classList.add("valgt");
        visArtikler();
    }

    function visArtikler() {
        console.log("visArtikler");
        const dest = document.querySelector("#liste");
        const template = document.querySelector("template").content;
        dest.textContent = "";
        artikler.forEach(artikel => {
            console.log("artikel categories: " + artikel.artikel_kategori);
            console.log(filter)
            if ( filter == "alle" || filter == artikel.artikel_kategori){
                const klon = template.cloneNode(true);
                console.log("featured_image: " + artikel.cover_billede.guid);
                klon.querySelector(".imgImg").src = artikel.cover_billede.guid;
                klon.querySelector(".imgImg").addEventListener("click", () => visDetaljer(artikel))
                klon.querySelector(".overskrift").textContent = artikel.title.rendered;
                klon.querySelector(".overskrift").addEventListener("click", () => visDetaljer(artikel))
                klon.querySelector(".dato").textContent = artikel.dato;
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

