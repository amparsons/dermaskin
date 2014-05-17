<?php 

/*
Template Name: Sub Treatment (3rd Level)
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
							  if($post->post_parent)
							  $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
							  else
							  $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
							  if ($children) { ?>
							
							  <?php echo $children; ?>
							  
							  <?php } ?>
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
                        <br />
                        <h3>Go Back</h3>
                        <?php
                        	$permalink = get_permalink($post->post_parent);
							$parent_title = get_the_title($post->post_parent);
						?>
                        <ul class="sidelnks">
                        	<li><a href="<?php echo $permalink; ?>"><?php echo $parent_title; ?></a></li>
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

