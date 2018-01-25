<?php
// the PAGE.PHP file
// by lucaslower @ airwave consulting

get_header();
?>

<section class="pageheader">
<h1 class="pagetitle"><?php the_title(); ?></h1>
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