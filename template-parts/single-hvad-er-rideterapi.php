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
        .hidden {
            display: none;
        }

        .play_video {
            cursor: pointer;
        }

        .video {
            padding: 50px;
            position: fixed;
            background-color: #fff;
            z-index: 10001;
            height: 100vh;
            width: 100%;
            top: 0;
            left: 0;
        }

        .video video {
            margin: 0 auto;
            padding: 15vh;
            height: 70vh;
            position: absolute;
            left: 0;
            right: 0;
            margin: auto;
            cursor: pointer;
        }

        .video svg {
            height: 30px;
            width: 30px;
            right: 50px;
            cursor: pointer;
            position: absolute;
            z-index: 10002;
        }
    </style>

    <div class="video hidden">

        <svg xmlns="http://www.w3.org/2000/svg" width="126.213" height="126.213" viewBox="0 0 126.213 126.213">
            <g id="Group_115" data-name="Group 115" transform="translate(-168.893 -298.893)">
                <line id="Line_5" data-name="Line 5" x2="105" y2="105" transform="translate(179.5 309.5)" fill="none" stroke="#87391e" stroke-width="30" />
                <line id="Line_6" data-name="Line 6" x1="105" y2="105" transform="translate(179.5 309.5)" fill="none" stroke="#87391e" stroke-width="30" />
            </g>
        </svg>

        <video class="mobil_video hidden" controls>
            <source src="/kea/10_eksamen/p%C3%A6dagogisk-rideterapi/wp-content/uploads/mobil_interview.mp4" type="video/mp4">
            Din telefon kan ikke afspille denne video.
        </video>

        <video class="desktop_video hidden" controls>
            <source src="https://victorhegelund.dk/kea/10_eksamen/p%C3%A6dagogisk-rideterapi/wp-content/uploads/desktop_interview.mp4" type="video/mp4">
            Din computer kan ikke afspille denne video.
        </video>
    </div>

    <script>

        document.addEventListener("DOMContentLoaded", start)

        function start() {
            console.log("start")
            document.querySelector(".play_video").addEventListener("click", () => screenSize())
        }


        //Tjek om browseren er høj- eller bredformat
        function screenSize() {
            console.log("screenSize")
            if (window.innerWidth < window.innerHeight) {
                //Mobil
                document.querySelector(".mobil_video").classList.remove("hidden");
                playVideo()
            } else {
                //Computer
                document.querySelector(".desktop_video").classList.remove("hidden");
                playVideo()
            }
        }

        //Vis video
        function playVideo() {
            console.log("playVideo")
            document.querySelector(".video").classList.remove("hidden");
            document.querySelector(".video svg").addEventListener("click", () => lukVideo())
        }

        //Skjul video
        function lukVideo() {
            console.log("lukVideo")
            document.querySelector(".video").classList.add("hidden");
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

    <!-- VORES KODE UNDER INDHOLD -->
    <style>
        .img img {
            width: 100%;
            height: 100%;
        }

        #filtrering button {
            margin: 5px 30px;
        }

        .imgImg,
        .overskrift {
            cursor: pointer;
        }

        .overskrift {
            margin-top: -20px;
        }

        #liste {
            display: flex;
            overflow-x: scroll;
            min-width: 100%;
        }

        .artikel {
            min-width: 75%;
            margin-right: 40px;
        }

        /* Tablet og op */
        @media screen and (min-width: 689.98px) {
            .artikel {
                min-width: 300px;
            }

            .artikel .img,
            .artikel .overskrift {
                cursor: pointer;
            }
        }

    </style>

    <article>
        <section id="liste"></section>
    </article>
    <template>
        <article class="artikel">
            <div class="img">
                <img class="imgImg hexagon" src="" alt="">
            </div>
            <h3 class="overskrift"></h3>
            <p class="dato"></p>
            <a class="button">Læs mere</a>
        </article>
    </template>

    <script>

        //Lav global variabel
        let filter = 4;

        document.addEventListener("DOMContentLoaded", loadJSON)

        //Load JSON data fra WP REST API
        async function loadJSON() {
            console.log("loadJSON");

            //Hent artikler
            const JSONData = await fetch("/kea/10_eksamen/pædagogisk-rideterapi/wp-json/wp/v2/artikel?per_page=100");
            artikler = await JSONData.json();
            console.log("Artikler", artikler);

            //Hent kategorier
            const catJSONData = await fetch("/kea/10_eksamen/pædagogisk-rideterapi/wp-json/wp/v2/artikel_kategori");
            categories = await catJSONData.json();
            console.log("Categories", categories);

            visArtikler();
        }

        function visArtikler() {
            console.log("visArtikler");
            const dest = document.querySelector("#liste");

            //Henvis til indhold fra template
            const template = document.querySelector("template").content;

            dest.textContent = "";

            //Kører funktionen én gang for hver artikel som opfylder if sætningen (kategori = "Viden")
            artikler.forEach(artikel => {
                console.log("artikel categories: " + artikel.artikel_kategori);
                console.log(filter)
                if (filter == artikel.artikel_kategori) {
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

        //Linker til den enkelte artikel
        function visDetaljer(artikel) {
            location.href = artikel.link;
        }

    </script>

    <!-- VORES KODE UNDER INDHOLD SLUT -->

    <?php get_sidebar(); ?>

    <?php do_action('blocksy:single:container:bottom'); ?>
</div>

<?php

blocksy_display_page_elements('separated');

have_posts();
wp_reset_query();
