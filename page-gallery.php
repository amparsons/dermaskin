<?php get_header(); ?>
        <div role="main">
            
            <section class="one">
            	<div class="wrapper">
                	<h1>Non Surgical Treatments Gallery</h1>	
                </div>
            </section>
            
            <section class="two">
            	<div class="wrapper">
                	<p><?php echo get_post_meta($post->ID, 'subtitle', TRUE); ?></p>	
                </div>	
            </section>
            
            <div class="wrapper">


                <?php 
				// Get list of slides for current case study
				$args = array(
					
					'post_type'		=> 'gallery',
					'numberposts'	=> -1,
					'orderby'		=> 'menu_order',
					'order'			=> 'asc'
				);
				$galleries = get_posts( $args );
				
				echo get_post_meta($post->ID, 'pagetitle', true);
				
				foreach( $galleries as $g )
				{
					$args = array(
					
					'post_type'		=> 'attachment',
					'numberposts'	=> -1,
					'orderby'		=> 'menu_order',
					'order'			=> 'asc',
					'post_parent'	=> $g->ID
				);
				$images = get_posts( $args );
				
				?>
                <ul class="galleries">
                	<?php
						$i = 1;
						foreach( $images as $i )
						{
							// Calls an array of details for each image
							$img = wp_get_attachment_image_src( $i->ID, 'gallery-image'  );
						
					?>
                    <li>
                    	<a href="<?php echo $img[0]; ?>" rel="prettyPhoto[<?php echo $g->ID ?>]">
                        	<img src="<?php bloginfo('template_directory'); ?>/img/gallery/thumb.jpg" alt="<?php echo $g->post_title; ?>">
                            <?php if ( $i == 1) { ?>
                            	<span><?php echo $g->post_title; ?></span>
                            	<p>View Gallery &gt;</p>
                            <?php } ?>
                    	</a>
                    </li>
                    <?php
							  $i++;
						  }
					 ?>
                </ul>
                <?php
				  }
				?>
                
                <?php include("inc/info-box.php"); ?>

            </div>
        </div>
	</div>
</div>
<?php get_footer(); ?>

