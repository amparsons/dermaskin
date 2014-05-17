<?php 
/**<br> 
 * Template Name: FAQs
 * Description: A Page Template that lets us created a dedicated Archives page
 *<br> 
 * @package WordPress<br> 
 * @subpackage Dermaskin
 * @since Dermaskin
*/
get_header();

?>
        <div role="main">

            <section class="one">
            	<div class="wrapper">
                	<h1>DermaSkin FAQs</h1>	
                </div>
            </section>
            
            <section class="two">
            	<div class="wrapper">
                	<p>
                    	<?php
							$ID = 36; // ID of the about page needs to change when servers changed
							echo get_post_meta($ID, 'subtitle', TRUE); 
						?>
                    </p>	
                </div>	
            </section>
            
            <div class="wrapper">
            
            	<div class="faux">
				
                    <div class="sub-container">
                        <section>
                        <?php
                            $taxonomy = 'faqscategory';
                            $tax_terms = get_terms($taxonomy);
                        
                            foreach ($tax_terms as $tax_term) {
                        
                            $catID = $tax_term->term_id;
                            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            
                            $args = array(
                                'post_type' 		=> 'faqs',
                                'faqscategory'	  => $tax_term->slug,
                                'posts_per_page'   => -1
                            );
                        
                            $posts=get_posts($args);
                            
                            if ($posts) 
                            {
                    
                        ?>
                        
                            <h1><?php echo $tax_term->name; ?></h1>
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
                              }
                           ?>
                        
                        <?php	
                            }
                        ?>
                        </section>
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
                
                <?php 
                      $quotes_true = get_post_meta(36, '_linkstype', true);
                      
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

