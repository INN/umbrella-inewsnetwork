<?php
/*
 * Adds a custom feeds at http://inewsnetwork.org/?feed=bento
 * And http://inewsnetwork.org/?feed=centerpiece
 * for importing into PBS Bento CMS
 */
function inews_custom_rss() {
	add_filter('pre_option_rss_use_excerpt', '__return_zero');
	load_template( get_stylesheet_directory() . '/custom-feed.php' );
}
add_feed( 'bento', 'inews_custom_rss' );
add_feed( 'centerpiece', 'inews_custom_rss' );

if ( ! defined( 'INN_MEMBER' ) ) {
	define( 'INN_MEMBER', true );
}
if ( ! defined( 'INN_HOSTED' ) ) {
	define( 'INN_HOSTED', true );
}

// Analytics
function inews_eloqua() { ?>
	<!-- Eloqua -->
	<script type="text/javascript">
		var _elqQ = _elqQ || [];
		_elqQ.push(['elqSetSiteId', '590918421']);
		_elqQ.push(['elqTrackPageView']);

		(function () {
			function async_load() {
				var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
				s.src = '//img.en25.com/i/elqCfg.min.js';
				var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
			}
			if (window.addEventListener) window.addEventListener('DOMContentLoaded', async_load, false);
			else if (window.attachEvent) window.attachEvent('onload', async_load);
		})();
	</script>
<?php }
add_action( 'wp_footer', 'inews_eloqua' );
