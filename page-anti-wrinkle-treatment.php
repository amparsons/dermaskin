<?php 
get_header();

?>
        <div role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <section class="one">
            	<div class="wrapper">
                	<h1><?php the_title(); ?></h1>	
                </div>
            </section>
            
            <section class="two">
            	<div class="wrapper">
                	<?php echo wpautop(get_post_meta($post->ID, 'subtitle', TRUE)); ?>	
                </div>	
            </section>
            
            <div class="wrapper">
				
                <div class="faux">
                
                    <div class="page-container">
   
                        <!--<img src="<?php bloginfo('template_directory'); ?>/img/teeth.jpg" alt="Teeth whitening">-->
                        
                        <p><?php the_content(); ?></p>
                    
                    </div>
                    
                    <div class="tside">
                        
                        <h3>Other treatments</h3>
                        <ul class="sidelnks">
                        	<?php
								wp_nav_menu(
									array(
									'menu' => 'anti-wrinkle-treatment',
									'container' => ''
								));
							?>
                        </ul>
                            
                    </div>
                
                </div>
                
                <?php 
					$quotes_true = get_post_meta($post->ID, '_linkstype', true);
					
					if($quotes_true == 'gallery') {
						include("inc/gallery-box.php");
					}
					elseif($quotes_true == 'treatments') {
						include("inc/treatments-box.php");
					}
					
				?>
                
				<?php endwhile; endif; ?>
            </div>
        </div>
	</div>
</div>
<?php get_footer(); ?>

