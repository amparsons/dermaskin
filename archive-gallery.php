<?php 
/**<br> 
 * Template Name: Archives Template 
 * Description: A Page Template that lets us created a dedicated Archives page
 *<br> 
 * @package WordPress<br> 
 * @subpackage Dermaskin
 * @since Dermaskin
*/
get_header(); ?>
        <div role="main">
            
            <section class="one">
            	<div class="wrapper">
                	<h1>Non Surgical Treatments Gallery</h1>	
                </div>
            </section>
            
            <section class="two">
            	<div class="wrapper">
                	<?php
							$ID = 30; // ID of the about page needs to change when servers changed
							echo get_post_meta($ID, 'subtitle', TRUE); 
						?>	
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
							$thumb = wp_get_attachment_image_src( $i->ID, 'gallery-thumb'  );
							$img = wp_get_attachment_image_src( $i->ID, 'gallery-image'  );
						
							?>
								<li>
									<a href="<?php echo $img[0]; ?>" rel="prettyPhoto[<?php echo $g->ID ?>]" title="">
									<?php if ( $i == 1) { ?>
									<img src="<?php echo $thumb[0]; ?>" alt="<?php echo $g->post_title; ?>">
									<span><?php echo $g->post_title; ?></span>
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
                
                <?php 
					$quotes_true = get_post_meta(30, '_linkstype', true);
					
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

