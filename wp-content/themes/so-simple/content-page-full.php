<?php
/**
 * The template used for displaying page content
 *
 * @package so-simple-75
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="page-content">
		<?php the_content(); ?>
		<?php
		wp_link_pages( array(
			'before' => '<p class="page-links">' . __( 'Pages:', 'so-simple-75' ),
			'after'  => '</p>',
		) );
		?>
	</div><!-- .entry-content -->

</article>