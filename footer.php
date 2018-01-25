<?php
// the FOOTER.PHP file
// by lucaslower @ airwave consulting
?>

<footer id="bottom">
    
<nav class="primary footer">
    <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
</nav>
    
<section class="pageheader home">
    <div class="ihls"><img class="ihls" src="<?php echo get_template_directory_uri(); ?>/img/ihls2.gif"><span>The Assumption Public Library is a<br>member of the Illinois Heartland Library System</span></div>
    
    <a class="overdrive" href="https://rpls.overdrive.com/"></a>
    <a class="ihls" href="http://asmp.illshareit.com/"></a>
</section>
    
<section class="copyright">
Copyright &copy; <?php echo date('Y'); ?> Assumption Public Library. All rights reserved. The "IHLS" and "SHARE" logos are the property of the Illinois Heartland Library System. The OverDrive "O" logo is the property of OverDrive, Inc. Movie posters for the DVD List are taken from themoviedb.org.
</section>
    
</footer>

<!-- END OF SECTION#CONTENT -->
</section>

<!-- END OF SECTION#PAGE -->
</section>

</body>

</html>