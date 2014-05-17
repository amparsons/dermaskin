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
                	<p><?php printf( __( 'Category: %s', 'dermaskin' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></p>	
                </div>	
            </section>
            
            <div class="wrapper">
            
            	<div class="faux">
				
                    <div class="sub-container">
                        <?php
                            $category_description = category_description();
                            if ( ! empty( $category_description ) )
                                echo '<div class="archive-meta">' . $category_description . '</div>';
                
                                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );            
                
                                query_posts( array($term->taxonomy => $term->name) );
                                
                                if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                    
                                    $categories = get_terms( 'category', 'orderby=count&hide_empty=0' );
                                    
                                    $mylinks_categories = get_terms('link_category', 'orderby=count&hide_empty=0');
                                
                         ?>
                         
                         <section>
                            <h2><?php echo $tax_term->name; ?></h2>
                            <?php
                                    foreach($posts as $post) 
                                    {
                                        setup_postdata($post); 
                                    
                                ?>
                                <div class="desc">
                                    <h2><?php echo the_title(); ?></h2>
                                    <p><?php echo the_content(); ?></p>
                                </div>
                                <?php
                                    }
                               ?>
                         </section>
                
                        <?php endwhile; else: ?>
                        
                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                        
                        <?php endif; ?>
                        
                    </div>
                    
                    <aside>
                        
                        <h3>Categories</h3>
                        <ul class="sidelnks"> 
                            
                            <?php 
                            $args = array(
                                'post_type'		=> 'faqs',
                                'type'          => 'post',
                                'orderby'       => 'name',
                                'order'         => 'ASC',
                                'taxonomy'      => 'faqscategory'
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