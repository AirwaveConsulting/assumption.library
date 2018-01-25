<?php
// the INDEX.PHP file
// by lucaslower @ airwave consulting

get_header();
?>

<section class="pageheader">
<h1 class="pagetitle">DVD List</h1>
</section>

<section class="body">
    
    <div class="dvd-search">
        <input type="text" placeholder="Type here to search our DVD collection...">
    </div>
    
    <ul class="dvd-alphabet">
        <?php
            $dvdcats = array('#', 'a', 'b', 'c', 'd', 'e','f','g','h','i','j','k','l','m','n','o','p', 'q','r','s','t','u','v','w','x','y','z');
        
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
                    echo '<li><a class="current" href="/jobs/asspub/category/' . $current_cat_wp . '/">'  . $dvdcat . '</a></li>';
                }
                else{
                    echo '<li><a href="/jobs/asspub/category/' . $current_cat_wp . '/">'  . $dvdcat . '</a></li>';
                }                
            }
        ?>
    </ul>
    
<section class="dvd_list_container">
<ul>
<?php
    
// getting the cat slug for the page
$cat = get_category( get_query_var( 'cat' ) );
$cat_slug = $cat->slug;
    
// query args
$args = array('post_type' => 'dvd-list', 'category_name' => $cat_slug, 'posts_per_page' => -1);

// the actual query
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    
    <li><?php the_movie_poster(); ?></li>

<?php endwhile; else : ?>
	<p><?php esc_html_e( 'There are no movies in this category.' ); ?></p>
<?php endif; ?>
</ul>
</section> <!-- end dvd_list_container -->
    
</section> <!-- end section.body -->

<?php
get_footer();
?>



