<?php 
$sent = '';

if (($_POST['tfname'] != '') && ($_POST['username'] == ''))
{
	$msg = $_POST['tfeedback'];
	if ((strlen($msg) == strlen(strip_tags($msg))) && (strpos($msg,"http") === false) && (strpos($msg,"[url]") === false))
	{

		//Send the email
		$textEmail = file_get_contents("wp-content/themes/dermaskin/emails/testimonials.txt");
		
		$textEmail = str_replace("|FNAME|",$_POST['tfname'],$textEmail);
		$textEmail = str_replace("|TEL|",$_POST['ttel'],$textEmail);
		$textEmail = str_replace("|EMAIL|",$_POST['temail'],$textEmail);
		$textEmail = str_replace("|WHEREFROM|",$_POST['twherefrom'],$textEmail);
		$textEmail = str_replace("|FEEDBACK|",$_POST['tfeedback'],$textEmail);
		
		$to = "info@dermaskin.co.uk, annemarie@amparsons.co.uk";
	    $subject = "Dermaskin Testimonials";
	    $headers = "From: info@dermaskin.co.uk"."\r\n"."X-Mailer: PHP/".phpversion();
		
		mail($to,$subject,$textEmail,$headers);
		
		$sent = 'y';
	}
}

get_header(); ?>
        <div role="main">
            
            <section class="one">
            	<div class="wrapper">
                	<h1>The Dermaskin Promise</h1>	
                </div>
            </section>
            
            <section class="two">
            	<div class="wrapper">
                	<p>
                    <?php
                    	$ID = 32; // ID of the testimonials page needs to change when servers changed
						echo wpautop(get_post_meta($ID, 'subtitle', TRUE));
					?>
					</p>	
                </div>	
            </section>
            
            <div class="wrapper">
				
                <p class="tleft">We understand that it may be a difficult to decide where to turn for treatment.  The larger companies can be impersonal and we feel that this is not good enough, as our customers deserve a personalised service.</p>
                
                <p class="tright">You see when you are relaxed, we can better understand your needs and recommend certain treatments for you.  We are not hard sellers, in fact this is what makes us so very different.</p>
            
                <div class="t-container">
                    
                    <?php
					$args = array
					(
						'post_type'		=> 'testimonials',
						'orderby'		  => 'menu_order',
						'order'			=> 'ASC',
						'posts_per_page'   => -1
					);
					$posts = get_posts($args);
					
					if (count($posts) > 0)
					{
						foreach ($posts as $post)
						{
							setup_postdata($post);
							
							$title             = $post->post_title;
							$content = apply_filters("the_content",$post->post_content);

					?>
                    <article class="t1">
                        <?php echo $content; ?>
                    	<span><?php echo $title; ?></span>
                    </article>
					<?php
						}
					}
					?>
                </div>
                
                <aside>
                	<?php if ($sent == FALSE) { ?>			
                    <h3>Send us your testimonial</h3>
                    <p>Customer feedback is really important to us. If you'd like to let us know what you think of customer service, please fill in this form.</p>
                    <form id="testimonials" name="testimonials" action="" method="post">
                        <input name="tfname" type="text" class="required" placeholder="Your name">
                        <input name="ttel" type="text" placeholder="Your telephone number (optional)">
                        <input name="temail" type="text" class="required email" placeholder="Your email address">
                        <input name="twherefrom" type="text" placeholder="Where you're from (optional)">
                        <textarea name="tfeedback" class="required"  cols="" rows="" placeholder="Your feedback"></textarea>
                        <input name="username" type="hidden" value="" />
                        <a class="btn" id="submitform">Send feedback<span></span></a>
                    </form>
                    <?php
                    }
                    else
                    {
                    ?>
                        <h3>Thank you for your feedback</h3>
                        <p>
                            We will add these to our website.
                        </p>
                    <?php
                    }
                    ?>
                </aside>
                
                <?php 
					$quotes_true = get_post_meta(32, '_linkstype', true);
					
					if($quotes_true == 'gallery') {
						include("inc/gallery-box.php");
					}
					elseif($quotes_true == 'treatments') {
						include("inc/treatments-box.php");
					}
					
				?>

            </div>
        </div>
	</div>
</div>
<?php get_footer(); ?>

