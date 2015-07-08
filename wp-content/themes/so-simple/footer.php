<?php
/**
 * The template for displaying the footer.
 *
 * @package so-simple-75
 */
?>

		</div><!-- .site-content -->
	</div><!-- .site --> 
</div><!-- end .page-wrap -->

<footer class="site-footer">
	<div class="social-icons">
		<?php
			$social_icons = array('facebook', 'twitter', 'linkedin', 'instagram', 'pinterest');

			foreach($social_icons as $icon) {
				if($url = get_sosimpleoption($icon)) :
					echo '<a href="' . esc_url($url) . '"><svg class="icon icon-' . $icon . '" viewBox="0 0 32 32"><use xlink:href="#icon-' . $icon .'"></use></svg></a>';
				endif;
			}	
		?>
	</div> <!-- end .social-icons -->

	<nav class="footer-navigation">
		<?php 
			wp_nav_menu(
				array( 
					'theme_location' => 'footer_menu',
					'depth' => 1
				)
			); 
		?>
	</nav>

	<?php if(get_sosimpleoption('copyright') ) : ?>
		<div class="copyright">
			<p>
				<?php printf( __( 'Copyright %s by', 'quyendam.2612' ), date('Y') ); ?>
				<a href="<?php echo esc_url('http://www.quyendam.com/', 'quyendam.2612'); ?>" title="<?php esc_attr_e( 'A Personal Blog', 'quyendam.2612' ); ?>" rel="generator" target="_blank">
					<?php _e('Quyen Dam', 'quyendam.2612'); ?>
				</a>
			</p>
		</div>
	<?php endif; ?>

</footer>

<?php wp_footer(); ?>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63158305-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>