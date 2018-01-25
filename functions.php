<?php
// the FUNCTIONS.PHP file
// by lucaslower @ airwave consulting

if ( ! function_exists( 'main_setup' ) ) :

function main_setup() {

add_theme_support( 'title-tag' );

add_theme_support( 'post-thumbnails' );

register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'main' ),
        'footer' => esc_html__( 'Footer' ),
) );

add_theme_support( 'html5', array(
		'search-form',
		'gallery',
		'caption'
) );

}

endif;

add_action( 'after_setup_theme', 'main_setup' );

function main_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'main' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'main' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'main_widgets_init' );

// DVD LIST POST TYPE
function dvdlist_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'DVD List', 'Post Type General Name'),
		'singular_name'       => _x( 'DVD', 'Post Type Singular Name'),
		'menu_name'           => __( 'DVD List'),
		'parent_item_colon'   => __( 'Parent DVD'),
		'all_items'           => __( 'All DVDs'),
		'view_item'           => __( 'View DVD'),
		'add_new_item'        => __( 'Add New DVD'),
		'add_new'             => __( 'Add New'),
		'edit_item'           => __( 'Edit DVD'),
		'update_item'         => __( 'Update DVD'),
		'search_items'        => __( 'Search DVDs'),
		'not_found'           => __( 'Not Found'),
		'not_found_in_trash'  => __( 'Not found in Trash'),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'dvd-list'),
		'description'         => __( 'DVDs that the library has'),
		'menu_icon'	=> 'dashicons-video-alt3',
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'thumbnail', 'revisions'),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		'taxonomies'          => array( 'category' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type( 'dvd-list', $args );

}
add_action( 'init', 'dvdlist_post_type', 0 );
// END ORGANIZATION POST TYPE

// set the search function to search only dvd's
function dvd_search( $query ) {

    if ( is_search() && $query->is_main_query() && $query->get( 's' ) ){

        $query->set('post_type', array('dvd-list'));
    }

    return $query;
};
add_filter('pre_get_posts', 'dvd_search');

// curl JSON request from stackoverflow user Amal Murali (thanks man)
function curl_get_contents($url)
{
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
}

// TheMovieDB poster call (gets the actual poster path)
function get_movie_poster($post_id){

    // check to see if it's a DVD first, just in case
    if(get_post_type($post_id) == 'dvd-list'){

        // see if the poster has been queried but was enetered as NULL, search again. Mostly just to fix errors on first caching
        if(metadata_exists('post', $post_id, 'poster_path')){

            $meta_content = get_post_meta($post_id, 'poster_path', true);
						$meta_content_id = get_post_meta($post_id, 'movie_id', true);

            if($meta_content == NULL){
                // my api key
                $api_key = '415477c4d341bb0bdd4a02e7dca8a2c4';

                // encode movie title as query arg
                $search_query = urlencode(get_the_title($post_id));

                // call for JSON data, using a curl function from stackoverflow user Amal Murali (thanks man)
                $api_query = 'https://api.themoviedb.org/3/search/movie?api_key=' . $api_key . '&query=' . $search_query;
                $json = json_decode(curl_get_contents($api_query), true);

                $poster_path = $json['results'][0]['poster_path'];
								$movie_id = $json['results'][0]['id'];

                if($poster_path == NULL){
                     $poster_path = 'no';
										 $movie_id = 'no';
                }

                update_post_meta($post_id, 'poster_path', $poster_path, false);
								update_post_meta($post_id, 'movie_id', $movie_id, false);
            }

//            if($meta_content == 'no'){
//                $poster_path = 'no';
//            }

            else{
                $poster_path = $meta_content;
								$movie_id = $meta_content_id;
            }

        }

        // get the movie poster path because it isn't cached in meta
        else{
            // my api key
            $api_key = '415477c4d341bb0bdd4a02e7dca8a2c4';

            // encode movie title as query arg
            $search_query = urlencode(get_the_title($post_id));

            // call for JSON data, using a curl function from stackoverflow user Amal Murali (thanks man)
            $api_query = 'https://api.themoviedb.org/3/search/movie?api_key=' . $api_key . '&query=' . $search_query;
            $json = json_decode(curl_get_contents($api_query), true);

            $poster_path = $json['results'][0]['poster_path'];
						$movie_id = $json['results'][0]['id'];

            if($poster_path == NULL){
                $poster_path = 'no';
								$url = 'no';
            }

            add_post_meta($post_id, 'poster_path', $poster_path, false);
						add_post_meta($post_id, 'movie_id', $movie_id, false);
        }
				$result = array('poster_path' => $poster_path, 'movie_id' => $movie_id);
				return $result;
    }
}

// check for posters after a dvd is updated
add_action('save_post', 'get_movie_poster');

// TheMovieDB poster call (prints the element for the page) (template tag for use in loop)
function the_movie() {

        $post_id = get_the_ID();
        		// grab the poster path string from api call function
						$get = get_movie_poster($post_id);
            $poster_path = $get['poster_path'];
						$movie_id = $get['movie_id'];

            // print text-based poster if one wasn't found in api call
            if($poster_path == 'no'){
                $poster = '<div class="poster_text"><span>' . get_the_title($post_id) . ' ' . $post_id . '</span></div>';
            }

            // display image poster since it was found
            else{
                $poster = '<a target="_blank" href="https://www.themoviedb.org/movie/' . $movie_id . '"><img title="' . get_the_title($post_id) . '" class="poster" src="http://image.tmdb.org/t/p/w185' . $poster_path . '"></a>';
            }

		echo $poster;

}
