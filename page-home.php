<?php
// the PAGE-HOME.PHP file
// by lucaslower @ airwave consulting

get_header();
?>

<section class="pageheader home">
    <div class="ihls"><img class="ihls" src="<?php echo get_template_directory_uri(); ?>/img/ihls2.gif"><span>The Assumption Public Library is a<br>member of the Illinois Heartland Library System</span></div>
    
    <a class="overdrive" href="https://rpls.overdrive.com/"></a>
    <a class="ihls" href="http://asmp.illshareit.com/"></a>
</section>

<section class="featuredquote" style="background:url('<?php the_post_thumbnail_url('full'); ?>') center center;background-size:cover;">
    <?php the_field('featured_image_text'); ?>
</section>

<section class="body">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>

<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
</section>

<?php
get_footer();
?>