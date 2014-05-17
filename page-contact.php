<?php get_header(); ?>
        <div role="main">
            
            <section class="one">
            	<div class="wrapper">
                	<h1>Contact DermaSkin Clinics</h1>	
                </div>
            </section>
            
            <section class="two">
            	<div class="wrapper">
                	<div class="bubble-container">
                    	<?php echo wpautop(get_post_meta($post->ID, 'subtitle', TRUE)); ?>	
                		<div class="bubble"></div>
                    </div>
                </div>	
            </section>
            
            <div class="wrapper">
                
				<p class="contact">Please contact us by phone, email or text <a href='&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#105;&#110;&#102;&#111;&#64;&#100;&#101;&#114;&#109;&#97;&#115;&#107;&#105;&#110;&#46;&#99;&#111;&#46;&#117;&#107;'>&#105;&#110;&#102;&#111;&#64;&#100;&#101;&#114;&#109;&#97;&#115;&#107;&#105;&#110;&#46;&#99;&#111;&#46;&#117;&#107;</a></p>
                
               
               	<?php
					$args = array
					(
						'post_type'		=> 'addresses',
						'orderby'		  => 'menu_order',
						'order'			=> 'ASC',
						'posts_per_page'   => 3
					);
					$posts = get_posts($args);
					
					if (count($posts) > 0)
					{
						foreach ($posts as $post)
						{
							setup_postdata($post);
							
							$title      = $post->post_title;
							$content 	= apply_filters("the_content",$post->post_content);
							$tel        = get_post_meta($post->ID, 'tel', true);
							$src 	    = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'map' );
							$mapid      = get_post_meta($post->ID, 'mapid', true);

				?>
               	<div class="column">
                    <div class="lineup">
                        <h3><?php echo $title; ?></h3>
                        <address><?php echo $content; ?></address>
                        <?php
                            if($tel !== '') 
                            {
                        ?>
                        <p><strong>Tel:</strong> <a href="tel:<?php echo $tel; ?>" class="tel"><?php echo $tel; ?></a></p>
                        <?php
                            } 
                        ?>
                    </div>
                    <img src="<?php echo $src[0]; ?>" alt="Dermaskin <?php echo $title; ?>"> 
                    <p><a href="<?php echo $mapid; ?>" target="_blank">Click here</a> for <?php echo $title; ?> map</p>
                </div>
                <?php
					}
				}
				?>

               <!-- <div class="column">
                    <h3>Cardiff Bay</h3>
                    <address>Dermaskin Clinic<br />Ground Floor<br />York Court<br />Schooner Way<br />Cardiff Bay<br />CF10 4DY</address>
                    <p><strong>Tel:</strong> <a href="tel:029 20 09 08 09" class="tel">029 20 09 08 09</a></p>
                    <img src="<?php bloginfo('template_directory'); ?>/img/cardiff-bay.jpg" alt="Dermaskin Cardiff Bay"> 
                    <p><a href="https://maps.google.co.uk/maps?q=dermaskin,+CF10+4DY&hl=en&sll=53.481061,-2.244837&sspn=0.009947,0.033023&hq=dermaskin,&hnear=Cardiff+CF10+4DY,+United+Kingdom&t=m&z=16" target="_blank">Click here</a> for Cardiff Bay map</p>
                </div>
                
                <div class="column">
                	<h3>Bristol</h3>
                    <address>Dermaskin Clinic<br />Citibase Bristol Cabot Circus<br />St Pauls Street<br />Off New Bond Street<br />Bristol<br />BS2 9AG</address>
                    <p><strong>Tel:</strong> <a href="tel:029 20 09 08 09" class="tel">029 20 09 08 09</a></p>
                    <img src="<?php bloginfo('template_directory'); ?>/img/bristol-map.jpg" alt="Dermaskin Cardiff Bay">
                    <p><a href="https://maps.google.co.uk/maps?q=dermaskin,+BS2+9AG&hl=en&ll=51.46009,-2.584298&spn=0.010415,0.033023&sll=51.475323,-3.166297&sspn=0.010411,0.033023&hq=dermaskin,&hnear=Bristol+BS2+9AG,+United+Kingdom&t=m&z=16&iwloc=A" target="_blank">Click here</a> for Bristol map</p>
                </div>
                
                <div class="column last">
                	<h3>Manchester</h3>
                    <address>Dermaskin Clinic<br />49 King Street<br />Manchester<br />Lancashire<br />M2 7AY</address>
                    <p><strong>Tel:</strong> <a href="tel:0161 850 50 60" class="tel">0161 850 50 60</a></p>
                    <img src="<?php bloginfo('template_directory'); ?>/img/manchester-map.jpg" alt="Dermaskin Cardiff Bay">
                    <p><a href="https://maps.google.co.uk/maps?q=dermaskin,+M2+7AY&hl=en&ll=53.481061,-2.244837&spn=0.009947,0.033023&sll=53.48126,-2.245095&sspn=0.009947,0.033023&hq=dermaskin,&hnear=Manchester+M2+7AY,+United+Kingdom&t=m&z=16" target="_blank">Click here</a> for Manchester map</p>
                </div>-->
                
                <div class="infobox">
                    <p>For any help at all email us at <a href='&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#105;&#110;&#102;&#111;&#64;&#100;&#101;&#114;&#109;&#97;&#115;&#107;&#105;&#110;&#46;&#99;&#111;&#46;&#117;&#107;'>&#105;&#110;&#102;&#111;&#64;&#100;&#101;&#114;&#109;&#97;&#115;&#107;&#105;&#110;&#46;&#99;&#111;&#46;&#117;&#107;</a> or just pop in our office and have a chat.</p>
                </div>

            </div>
        </div>
	</div>
</div>
<?php get_footer(); ?>

