<?php
// the HEADER.PHP file
// by lucaslower @ airwave consulting
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <title><?php wp_title(); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php wp_head(); ?>
        
        <!-- STYLE.CSS and FAVICON -->
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css">
    </head>
    
<body>

<section id="page">
    
<header id="pageheader">
    <div id="logo"><img src="<?php echo get_template_directory_uri(); ?>/img/booklogo.png">Assumption<br>Public Library</div>
    <div class="contact">205 North Oak Street, Assumption, IL &mdash; Phone/Fax 217.226.3915<br>Hours: Mon Closed, Tues 9-5, Wed 9-6, Thurs 9-5, Fri 9-5, Sat 9-3, Sun Closed</div>
</header>
    
<section id="content">
    
<nav class="primary">
    <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
</nav>
    