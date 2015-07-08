<?php
/**
 * Template Name: CGV Vietnam - Room Filter
 * The template for displaying all pages.
 *
 * @package so-simple-75
 */

get_header(); ?>

<main id="main" class="site-main cgv-page" role="main">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="page-content">
		<?php
		$cinemas = getCinemas();
		$dates = getDates();
		echo $cinemas."&nbsp;";
		echo $dates;
		?>
		<button id="submit">Xem</button>
		<button id="refresh">Tải lại</button>
		<div id="result"></div>
	</div><!-- .entry-content -->

</article>

<?php
$upload_dir = wp_upload_dir();
$loadingImg = $upload_dir['baseurl'].'/cgv/loading.gif';
?>
</main><!-- #main -->
<script type="text/javascript">
	function getCgvData()
	{
		jQuery("#result").html("<img src=\"<?php echo $loadingImg; ?>\" />");
		console.log('show overlay');
		var c = jQuery("#cinema").val(),
			d = jQuery("#date").val();

		if (c==0||d==0) {
			alert('Hãy chọn rạp và ngày.');
			return;
		}

		var data = {
			cinema: c,
			date: d
		};

		var ajaxurl = '<?php echo admin_url('cgv.php'); ?>';
		jQuery.post(ajaxurl, data, function(response) {
			console.log('done');
			jQuery("#result").html(response);
		});
	}
	jQuery( "#submit" ).on('click', function() { getCgvData() });
	jQuery("#refresh").on('click', function(){
		location.reload();
	});
</script>

<?php if(!checkAndroidDevice()) { get_footer(); } ?>
