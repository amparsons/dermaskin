<?php get_header(); ?>
        <div role="main">
            
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
            <section class="one">
            	<div class="wrapper">
                	<h1><?php the_title(); ?></h1>	
                </div>
            </section>
            
            <section class="two">
            	<div class="wrapper">
                	<p>
					<?php
						$ID = 38; // ID of the about page needs to change when servers changed
						echo get_post_meta($ID, 'subtitle', TRUE); 
					?>
                    </p>	
                </div>	
            </section>
            
            <div class="wrapper">
				<div class="faux"> 
                    <div class="sub-container">
                    
                        <section>
                    
                            <?php the_content(); ?>
                        
                        </section>
                        
                    </div>
                
                    <aside>
                        
                        <h3>A to Z</h3>
                        <ul class="sidelnks"> 
                            <?php 
                            $args = array(
                                'post_type'	 => 'atoz',
                                'type'          => 'post',
                                'orderby'       => 'name',
                                'order'         => 'ASC',
                                'taxonomy'      => 'azcategory'
                            );
                        
                            $categories = get_categories( $args );
                            
                            foreach ($categories as $category) {
                            ?>
                                <li><a href="<?php echo get_term_link( $category ); ?>"><?php echo $category->cat_name; ?></a></li>
                            
                            <?php
                            }
                            ?>
                        </ul>
                            
                    </aside>
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

            </div>
        </div>
        
         <?php endwhile; endif; ?>
         
	</div>
</div>
<?php get_footer(); ?>

