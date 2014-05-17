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
					<?php
						$ID = 40; // ID of the blog page needs to change when servers changed
						echo wpautop(get_post_meta($ID, 'subtitle', TRUE)); 
					?>	
                </div>	
            </section>
            
            <div class="wrapper">
            
            <div class="faux blog">
                
                <div class="sub-container">
                	<section>
                		<p><?php the_content(); ?></p>
                    </section>
              	</div>
                
                <aside>
                    
                	<h3>Categories</h3>
                    <ul class="sidelnks"> 
                    	<?php wp_list_categories('title_li='); ?>
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
        
         <?php endwhile; endif; ?>
         
	</div>
</div>
<?php get_footer(); ?>

