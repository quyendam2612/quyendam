<?php
/**
 * The default template part for displaying content.
 *
 * @package so-simple-75
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'js-item-as-link' ); ?>>

	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php if( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail('featured', array( 'class' => 'featured-thumb' )); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content content">
		<br />
		<?php the_content(); ?>
		<?php
		wp_link_pages( array(
			'before' => '<p class="page-links">' . __( 'Pages:', 'so-simple-75' ),
			'after'  => '</p>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php get_template_part( 'parts/entry', 'meta' ); ?>
	</footer><!-- .entry-footer -->

</article>
