<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blocksy
 */

blocksy_after_current_template();
do_action('blocksy:content:bottom');

?>
	</main>

	<?php
		do_action('blocksy:content:after');
		do_action('blocksy:footer:before');

		blocksy_output_footer();

		do_action('blocksy:footer:after');
	?>
</div>

<?php wp_footer(); ?>

</body>
</html>

<!-- VORES KODE -->
<div class="mobil_bar">
	<div class="mobil_nav">

		<nav class="mobil_nav_nav">
			<a class="mobil_menu_left" href="https://victorhegelund.dk/kea/10_eksamen/pædagogisk-rideterapi/jeg-tilbyder">Jeg tilbyder</a>
			<a class="mobil_menu_right" href="https://victorhegelund.dk/kea/10_eksamen/pædagogisk-rideterapi/hvad-er-rideterapi">Rideterapi</a>
		</nav>

		<div class="mobil_menu_knap">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="106.985" height="96.841" viewBox="0 0 106.985 96.841">
				<defs>
					<filter id="Path_40" x="9.86" y="14.332" width="97.125" height="82.509" filterUnits="userSpaceOnUse">
						<feOffset dy="3" input="SourceAlpha" />
						<feGaussianBlur stdDeviation="3" result="blur" />
						<feFlood flood-opacity="0.161" />
						<feComposite operator="in" in2="blur" />
						<feComposite in="SourceGraphic" />
					</filter>
					<filter id="Path_41" x="0" y="0" width="94.753" height="77.431" filterUnits="userSpaceOnUse">
						<feOffset dy="3" input="SourceAlpha" />
						<feGaussianBlur stdDeviation="3" result="blur-2" />
						<feFlood flood-opacity="0.161" />
						<feComposite operator="in" in2="blur-2" />
						<feComposite in="SourceGraphic" />
					</filter>
				</defs>
				<g id="Group_7" data-name="Group 7" transform="translate(9 6)">
					<g id="Group_6" data-name="Group 6" transform="translate(0.003 0.002)">
						<path id="Path_39" data-name="Path 39" d="M-1783.661,2751.536l-53.464-14.332-23.29,22.7,9.86,36.734,56.131,19.411,22.994-34.941Z" transform="translate(1860.415 -2737.204)" fill="#84391e" />
					</g>
					<g transform="matrix(1, 0, 0, 1, -9, -6)" filter="url(#Path_40)">
						<path id="Path_40-2" data-name="Path 40" d="M-1776.41,2773.867l-22.994,34.941-56.131-19.411,66.893-45.1Z" transform="translate(1874.39 -2723.97)" fill="#9b4c30" />
					</g>
					<g transform="matrix(1, 0, 0, 1, -9, -6)" filter="url(#Path_41)">
						<path id="Path_41-2" data-name="Path 41" d="M-1783.664,2751.535l-66.893,45.1-9.86-36.733,23.29-22.7Z" transform="translate(1869.42 -2731.2)" fill="#84391e" />
					</g>
					<line id="Line_1" data-name="Line 1" x2="29.652" transform="translate(29.67 31.392)" fill="none" stroke="#eae5e1" stroke-linejoin="round" stroke-width="1.334" />
					<line id="Line_2" data-name="Line 2" x2="29.652" transform="translate(29.67 39.423)" fill="none" stroke="#eae5e1" stroke-linejoin="round" stroke-width="1.334" />
					<line id="Line_3" data-name="Line 3" x2="29.652" transform="translate(29.67 47.454)" fill="none" stroke="#eae5e1" stroke-linejoin="round" stroke-width="1.334" />
				</g>
			</svg>
		</div>
	</div>
	<nav class="mobil_menu hidden">
		<a href="https://victorhegelund.dk/kea/10_eksamen/pædagogisk-rideterapi/hvem-er-jeg">Hvem er jeg</a>
		<a href="https://victorhegelund.dk/kea/10_eksamen/pædagogisk-rideterapi/praktisk-info">Praktisk info</a>
		<a href="https://victorhegelund.dk/kea/10_eksamen/pædagogisk-rideterapi/artikler">Artikler</a>
		<a href="https://victorhegelund.dk/kea/10_eksamen/pædagogisk-rideterapi/kontakt">Kontakt</a>
	</nav>

</div>


<script>
window.addEventListener("load", sidenVises);

function sidenVises() {
	console.log("sidenVises");
	document.querySelector(".mobil_menu_knap").addEventListener("click", toggleMenu);
}

function toggleMenu() {
	console.log("toggleMenu");
	document.querySelector(".mobil_menu").classList.toggle("hidden");
}
</script>
<!-- VORES KODE SLUT -->
