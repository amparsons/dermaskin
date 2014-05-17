<?php get_header(); ?>
        <div role="main">
            
            <section class="one">
            	<div class="wrapper">
                	<h1>The Dermaskin Blog</h1>	
                </div>
            </section>
            
            <section class="two">
            	<div class="wrapper">
                	<?php echo wpautop(get_post_meta($post->ID, 'subtitle', TRUE)); ?>	
                </div>	
            </section>
            
            <div class="wrapper">
                
                <div class="faux">
                    <div class="sub-container">
                    
                        <?php
                        $args = array
                        (
                            'post_type'		=> 'post',
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
    
                        ?>
                        <section>
                            <div class="imgcontainer">
                                
                                <?php
                                    if( has_post_thumbnail() ) { 
                                        the_post_thumbnail('thumbnail');
                                    } else { 
                                ?>
                                <img src="<?php bloginfo('template_directory'); ?>/img/awaiting-photo.jpg" alt="<?php echo $title; ?>" />
                                <?php } ?>
    
                            </div>
                            <div class="desc">
                                <h2><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                                <p><?php echo truncate(get_the_content(), 600); ?> <a href="<?php the_permalink(); ?>">read more...</a></p>
                            </div>
                        </section>
                        <?php
                            }
                        }
                        ?>
                        
                    </div>
                
                    <aside>
                        
                        <h3>Categories</h3>
                        <ul class="sidelnks"> 
                            <?php wp_list_categories('title_li='); ?>
                        </ul>
                            
                    </aside>
                    
				</div>
                
                <?php 
					$quotes_true = get_post_meta(40, '_linkstype', true);
					
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
