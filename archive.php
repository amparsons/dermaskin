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
                	<p><?php echo get_post_meta($post->ID, 'subtitle', TRUE); ?></p>	
                </div>	
            </section>
            
            <div class="wrapper">
				
				<?php the_content(); ?>
                
            </div>
            <?php endwhile; endif; ?>
        </div>
	</div>
</div>
<?php get_footer(); ?>

