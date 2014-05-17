<?php 

/*
Template Name: Treatment page
*/

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
   
                        <ul class="breadcrumbs">
							<?php get_breadcrumbs(); ?>
                        </ul>
                        
                        <p><?php the_content(); ?></p>
                    
                    </div>
                    
                    <div class="tside">
                        
                        <h3>Sub treatments</h3>
                        <ul class="sidelnks">
							<?php
							  global $id;
							  wp_list_pages("title_li=&child_of=$id&sort_column=menu_order"); 
							?>
                        </ul>
                        <br />
                        <h3>All treatments</h3>
                        <ul class="sidelnks">
                        	<?php
								wp_nav_menu(
									array(
									'menu' => 'treatment-list',
									'container' => ''
								));
							?>
                        </ul>
                            
                    </div>
                
                </div>
                
                <div class="infobox">
                	<p>Not looking for this service? Go back to our <a href="<?php bloginfo('url'); ?>/treatments/">treatments</a> page and find the one you are.</p>
                </div>
				<?php endwhile; endif; ?>
            </div>
        </div>
	</div>
</div>
<?php get_footer(); ?>

