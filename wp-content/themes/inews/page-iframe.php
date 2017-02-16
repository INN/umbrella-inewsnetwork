<?php
/**
 * Template Name: Iframe Container
 * a custom page template for embedding the inside energy iframe
 * hides the page title, mostly
 */
get_header();
?>

<div id="content" class="span8" role="main">
	<?php the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	<?php edit_post_link(__('Edit This Page', 'largo'), '<h5 class="byline"><span class="edit-link">', '</span></h5>'); ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>