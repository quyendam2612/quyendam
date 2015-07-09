<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Blogger WPExplorer Theme
 * @since Blogger 1.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <div id="primary" class="content-area clr">
        <div id="content" class="site-content left-content clr" role="main">
            <article class="single-post-article boxed clr">
                <?php
                if ( !post_password_required() ) {
                    get_template_part( 'content', get_post_format() );
                } ?>
                <header class="page-header clr">
                    <h1 class="page-header-title"><?php the_title(); ?></h1>
                    <?php
                    // Display post meta
                    // See functions/commons.php
                    wpex_post_meta(); ?>
                </header><!-- .page-header -->
                <div class="entry clr">
                    <?php
                    $cinemas = getCinemas();
                    $dates = getDates();
                    echo $cinemas."&nbsp;";
                    echo $dates;
                    ?>
                    <button id="submit">Xem</button>
                    <button id="refresh">Tải lại</button>
                    <div id="result"></div>
                </div><!-- .entry -->
                <footer class="entry-footer">
                    <?php edit_post_link( __( 'Edit Post', 'wpex' ), '<span class="edit-link clr">', '</span>' ); ?>
                </footer><!-- .entry-footer -->
            </article>
            <?php
            // Display author bio
            // See functions/commons.php
            wpex_post_author(); ?>
            <?php comments_template(); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links clr">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
        </div><!-- #content -->
        <?php get_sidebar(); ?>
    </div><!-- #primary -->
    <?php wpex_next_prev(); ?>
<?php endwhile; ?>
<?php get_footer(); ?>
<?php
$upload_dir = wp_upload_dir();
$loadingImg = $upload_dir['baseurl'].'/cgv/loading.gif';
?>
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