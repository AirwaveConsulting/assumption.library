<?php
// the SEARCH.PHP file
// by lucaslower @ airwave consulting

get_header();

if ( have_posts() ) : ?>


<section class="pageheader">
<h1 class="pagetitle">DVD List &mdash; Results for '<?php echo get_search_query(); ?>'</h1>
</section>

<section class="body">

    <div class="dvd-search">
    <form id="thesearch" role="search" method="get" action="<?php echo get_site_url(); ?>">
        <input type="search" placeholder="Type here to search our DVD collection..." name="s" value>
        <input class="searchsubmit" type="image" src="<?php echo get_site_url(null, '/wp-content/themes/asspub/img/search.svg'); ?>">
    </form>
    </div>

    <ul class="dvd-alphabet">
        <?php
            $dvdcats = array('#', 'a', 'b', 'c', 'd', 'e','f','g','h','i','j','k','l','m','n','o','p', 'q','r','s','t','u','v','w','x','y','z');
            $cat_base_url = get_site_url(null, '/category/', 'https');

            foreach ($dvdcats as $dvdcat){
                $cat = get_category( get_query_var( 'cat' ) );
                $cat_slug = $cat->slug;

                if($dvdcat == '#'){
                    $current_cat_wp = 'numbers-dvd';
                }
                else{
                    $current_cat_wp = $dvdcat . '-dvd';
                }

                if($current_cat_wp == $cat_slug){
                    echo '<li><a class="current" href="' . $cat_base_url . $current_cat_wp . '/">'  . $dvdcat . '</a></li>';
                }
                else{
                    echo '<li><a href="' . $cat_base_url . $current_cat_wp . '/">'  . $dvdcat . '</a></li>';
                }
            }
        ?>
    </ul>

<section class="dvd_list_container">
<ul>
<?php


// the actual query
while ( have_posts() ) : the_post(); ?>

    <li><?php the_movie(); ?></li>

<?php endwhile; else : ?>
	<p><?php esc_html_e( 'There are no movies that match your search.' ); ?></p>
<?php endif; ?>
</ul>
</section> <!-- end dvd_list_container -->

</section> <!-- end section.body -->

<?php
get_footer();
?>
