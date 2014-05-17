<?php get_header(); ?>
        <div role="main">
            
            <section class="one">
            	<div class="wrapper">
                	<h1>The Dermaskin Blog</h1>	
                </div>
            </section>
            
            <section class="two">
            	<div class="wrapper">
                	<p><?php printf( __( 'Category: %s', 'dermaskin' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></p>	
                </div>	
            </section>
            
            <div class="wrapper">
                
                <div class="faux blog">
                
                    <div class="sub-container">
                        
                         <?php
                            $category_description = category_description();
                            if ( ! empty( $category_description ) )
                                echo '<div class="archive-meta">' . $category_description . '</div>';
                
                        /* Run the loop for the category page to output the posts.
                         * If you want to overload this in a child theme then include a file
                         * called loop-category.php and that will be used instead.
                         */
                        get_template_part( 'loop', 'category' );
                        ?>
                        
                    </div>
                    
                    <aside>
                        
                        <h3>Categories</h3>
                        <ul class="sidelnks"> 
                            <?php wp_list_categories('title_li='); ?>
                        </ul>
                            
                    </aside>
                    
				</div>
                
                <?php include("inc/info-box.php"); ?>

            </div>
        </div>
	</div>
</div>
<?php get_footer(); ?>

