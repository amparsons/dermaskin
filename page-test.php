<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"><!--<![endif]-->


<head>
  <meta charset='utf-8'> 

    <title>
		<?php
			$title = get_post_meta($post->ID, 'title', true);
			if ( $title ) {
			 echo $title;
			}
			else {
			
				/*
				 * Print the <title> tag based on what is being viewed.
				 */
				global $page, $paged;
			
				wp_title( '|', true, 'right' );
			
				// Add the blog name.
				bloginfo( 'name' );
			
				// Add the blog description for the home/front page.
				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description && ( is_home() || is_front_page() ) )
					echo " | $site_description";
			
				// Add a page number if necessary:
				if ( $paged >= 2 || $page >= 2 )
					echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
			
			}
		?>
    </title>
	<meta name="description" content="<?php echo get_post_meta($post->ID, 'description', TRUE); ?>">
    <meta name="keywords" content="<?php echo get_post_meta($post->ID, 'keywords', TRUE); ?>">

    <!-- Mobile viewport optimization h5bp.com/ad -->
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />

    
    <!-- Plugin Stylesheets -->
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/photoswipe.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/prettyPhoto.css" />
    
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
    
    <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
    <script src="<?php bloginfo('template_directory'); ?>/js/libs/modernizr-2.0.6.min.js"></script>
    
    <?php
    $page_slug = '';
	if (is_page())
	{
		$page_slug = 'page-'.basename(get_permalink());
		
		if ($post->post_parent)
		{
			$page_slug.= ' parent-'.basename(get_permalink($post->post_parent));
		}
	}
	?>
    
    <?php wp_head(); ?>   

 <!-- Google Analytics code -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-5616978-6', 'dermaskin.co.uk');
  ga('send', 'pageview');

</script>
  
</head>

<body>

  
    
<div>
        <?php
						wp_nav_menu(
							array(
							'menu' => 'main-menu',
							'container' => 'menu'
						));
					?>
</div>

<div class="wrapper">
    <footer>
    	<ul>
        	<li>&copy; Dermaskin Clinics - All Rights Reserved</li>
            <?php
				wp_nav_menu(
					array(
					'menu' => 'footer',
					'container' => ''
				));
			?>
        </ul>
        <p>Call us on <span><a href="tel:02920090809">02920 09 08 09</a></span> or email us at <a href='&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#105;&#110;&#102;&#111;&#64;&#100;&#101;&#114;&#109;&#97;&#115;&#107;&#105;&#110;&#46;&#99;&#111;&#46;&#117;&#107;'>&#105;&#110;&#102;&#111;&#64;&#100;&#101;&#114;&#109;&#97;&#115;&#107;&#105;&#110;&#46;&#99;&#111;&#46;&#117;&#107;</a></p>
    </footer>
</div>


<script src="<?php bloginfo('template_directory'); ?>/js/libs/slideshow.js"></script>


<!-- Debugger - remove for production -->
<!-- <script src="https://getfirebug.com/firebug-lite.js"></script> -->

<!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID.
     mathiasbynens.be/notes/async-analytics-snippet -->


<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>

