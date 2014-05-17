<?php 

/**
 * @package WordPress
 * @subpackage Dermaskin
 * @since 1.0
 */

include("mobile-detect/Mobile_Detect.php");
include("classes/class.phpmailer.php");

$refersend = FALSE;
if (($_POST['fname'] != ''))
{
	$mail = new PHPMailer();
	
	$body = file_get_contents("wp-content/themes/dermaskin/emails/refer.html");
	
	$body = str_replace("|FNAME|", $_POST['fname'], $body);
	$body = str_replace("|EMAIL|", $_POST['email'], $body);
	$body = str_replace("|YFNAME|", $_POST['yfname'], $body);
	$body = str_replace("|YEMAIL|", $_POST['yemail'], $body);
	
	$mail->AddAddress('info@dermaskin.co.uk', 'Dermaskin');
	$mail->AddAddress($_POST['yemail']);
	$mail->SetFrom($_POST['email']);
	
	$mail->Subject = "A friend has recommended a website you maybe interested in!";
	$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
	$mail->MsgHTML($body);
	
	if(!$mail->Send())
	{
		echo "Mailer Error: " . $mail->ErrorInfo;
	}
	else
	{
		$refersend = TRUE;
	}
}

?>
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

<body <?php body_class($page_slug); ?>>

<header>
    <div class="wrapper">
        <div class="topbar">
            <p>Call us on <span><a href="tel:02920090809">029 20 09 08 09</a></span> or email us at <a href="mailto:info@dermaskin.co.uk">info@dermaskin.co.uk</a></p>
        </div>
        <a class="logo" href="<?php bloginfo('url'); ?>"></a>
        <div class="strapline">Advanced Facial Aesthetics<br />by Professional Doctors</div>
        <ul class="topbarlinks">
        	<li class="select-container">
                <select class="select" title="select" onchange="if(this.options[this.selectedIndex].value != ''){window.top.location.href=this.options[this.selectedIndex].value}">
                    <option>Choose your location...</option>
                    <?php
					$areaargs = array
					(
						'post_type'		=> 'areas',
						'orderby'		  => 'menu_order',
						'order'			=> 'ASC',
						'posts_per_page'   => -1
					);
					$areas = get_posts($areaargs);
					
					//print_r($areas);
					
					if (count($areas) > 0)
					{
						foreach ($areas as $area)
						{
							setup_postdata($area);
							
							$title   = $area->post_title;
							$link 	= get_post_meta($area->ID, 'link', TRUE);

					?>
                    <option  value="<?php echo $link; ?>"><?php echo $title; ?></option>
                    <?php
						}
					}
					?>
                </select>
            </li>
            <!--<li><a class="refer" href="#"></a></li>-->
            <li>
            	<a class="refer" href="#"></a>
            	<div class="login-content">
                    <h2>Refer a friend</h2>
                    <p>Fill out this form to send your friend an email about this website.</p>
                    <span>We don't like spam either and will not keep or pass your details to nasty spammers.</span>
                    <div id="contactSuccess" class="success"<?php if ($refersend == FALSE) { ?> style="display:none;"<?php } ?>>
							
					</div>
                    <form name="refer" action="<?php echo get_permalink(); ?>" method="post"> 
                   		<input name="fname" type="text" placeholder="Your Name...">
                    	<input name="email" type="email" placeholder="Your Email..." />
                        
                        <input name="yfname" type="text" placeholder="Your Friend's Name..." />
                    	<input name="yemail" type="email" placeholder="Your Friend's Email..." />
                        
                        
                        <input type="submit" value="Refer a friend" />
                    </form>
                    <span id="messageSent">Your message has been sent successfully!</span>
				</div>
            </li>
            <li><a class="twitter" href="https://twitter.com/dermaskin" target="_blank"></a></li>
            <li><a class="facebook" href="http://www.facebook.com/pages/DermaSkin-Clinic/279329855227?ref=ts" target="_blank"></a></li>
			<li><a class="google" href="https://plus.google.com/106044434620330060223" target="_blank"></a></li>
            <li class="referfriend"></li>
            <li class="findabranch"></li>
        </ul>
    </div>
</header>
    
<div id="main" role="main">
	<div class="container">
        <div class="wrapper">
     
            <div class="mobile-container">
                <a href="#" class="toggle">Main Menu (open)</a>
                <nav class="mobile">
                    <a href="#" class="toggle">Main Menu (close)</a>
                    <ul class="holder">
                        <?php
							wp_nav_menu(
								array(
								'menu' => 'main-menu',
								'container' => ''
							));
						?>
                    </ul>
                </nav>
            </div> 
          
            <nav class="desktop">
                <ul>
                    <?php
						wp_nav_menu(
							array(
							'menu' => 'main-menu',
							'container' => 'menu'
						));
					?>
                </ul>
            </nav>
       
        </div>
        