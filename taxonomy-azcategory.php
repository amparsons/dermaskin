<?php 
get_header();

?>
        <div role="main">
            
            <section class="one">
            	<div class="wrapper">
                	<h1>FAQs</h1>	
                </div>
            </section>
            
            <section class="two">
            	<div class="wrapper">
                	<p><?php printf( __( 'Area: %s', 'dermaskin' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></p>	
                </div>	
            </section>
            
            <div class="wrapper">
            
            	<div class="faux">
				
                    <div class="sub-container">
                        
                         <div class="cat-container">
                            <!--<h2><?php printf( __( '%s', 'dermaskin' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h2>-->
                            <ul class="sitemap">
                            <?php
                                foreach($posts as $post) 
                                {
                                    setup_postdata($post); 
                            
                            ?>
                            <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
                            <?php
                                }
                            
                            ?>
                            </ul>
                        </div>
    
                    </div>
                    
                    <aside>
                        
                        <h3>Categories</h3>
                        <ul class="sidelnks"> 
                            
                            <?php 
                            $args = array(
                                'post_type'		=> 'atoz',
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

                
            </div>
            
        </div>
	</div>
</div>
<?php get_footer(); ?>