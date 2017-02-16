<?php
/*
 * Template Name: I-News Custom Feed for Bento
 * Includes additional media elements
 */

$feed = get_query_var( 'feed' );

if ( $feed == 'bento' ) {
	$cat_id = 258;
} elseif ( $feed == 'centerpiece' ) {
	$cat_id = 711;
}

$numposts = 20;

function rss_date( $timestamp = null ) {
  $timestamp = ($timestamp==null) ? time() : $timestamp;
  echo date(DATE_RSS, $timestamp);
}

$posts = query_posts( array(
     'post_type' 	=> 'post',
     'cat'			=> $cat_id,
     'showposts' 	=> $numposts 
));

$lastpost = $numposts - 1;

header("Content-Type: application/rss+xml; charset=UTF-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<rss xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:station="http://www.publicbroadcasting.net/rss/namespaces/station/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:playlist="http://www.publicbroadcasting.net/rss/namespaces/playlist/" xmlns:g-core="http://base.google.com/ns/1.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:playlistsong="http://www.publicbroadcasting.net/rss/namespaces/playlistsong/" xmlns:program="http://www.publicbroadcasting.net/rss/namespaces/program/" xmlns:taxo="http://purl.org/rss/1.0/modules/taxonomy/" version="2.0">
	<channel>
		<title><?php bloginfo( 'title' ); ?></title>
		<link><?php bloginfo( 'url' ); ?></link>
		<description><?php bloginfo( 'description' ); ?></description>
		<language>en-us</language>
		<pubDate><?php rss_date( strtotime($ps[$lastpost]->post_date_gmt) ); ?></pubDate>
		<lastBuildDate><?php rss_date( strtotime($ps[$lastpost]->post_date_gmt) ); ?></lastBuildDate>
		<generator>Project Largo</generator>
		<ttl>30</ttl>

	<?php foreach ($posts as $post) { ?>

	  	<item>
	    	<title><?php the_title_rss(); ?></title>
			<link><?php the_permalink(); ?></link>
			<description><?php the_excerpt_rss(); ?></description>
			<fullText><?php echo '<![CDATA[' . wpautop($post->post_content) . ']]>'; ?></fullText>
			<pubDate><?php rss_date( strtotime($post->post_date_gmt) ); ?></pubDate>
			<guid><?php the_permalink(); ?></guid>
	<?php
		// Some custom image sizes
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
		$thumb_url = $thumb['0'];
		$full = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
		$full_url = $full['0'];
		if ($thumb_url) {
	?>
			<media:thumbnail url="<?php echo $thumb_url; ?>" />
	<?php
		}
		if ($full_url) {
	?>
			<media:title><?php echo get_the_title($post->ID); ?></media:title>
			<media:content url="<?php echo $full_url; ?>" />
	<?php
		}
	?>
		</item>
	<?php } // endforeach ?>
	</channel>
</rss>