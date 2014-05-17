<?php 
/**<br> 
 * Template Name: Archives Template AtoZ
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
                	<h1>DermaSkin A to Z</h1>	
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
				
				<?php
				$taxonomy = 'azcategory';
				$tax_terms = get_terms($taxonomy);
			
				foreach ($tax_terms as $tax_term) {
			
				$catID = $tax_term->term_id;
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

				$args = array(
					'post_type' 		=> 'atoz',
					'azcategory'	  => $tax_term->slug,
					'posts_per_page'   => -1
				);
			
				$posts=get_posts($args);
				
				if ($posts) 
				{
			
				?>
                <div class="cat-container">
                	<h2><?php echo $tax_term->name; ?></h2>
                	<ul class="sitemap">
                    <?php
						foreach($posts as $post) 
						{
							setup_postdata($post); 
                    
                    ?>
                    <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
                    <?php
                		}
                	}
					?>
                    </ul>
                </div>
                <?php	
                }
                ?>
                
                <?php 
                      $quotes_true = get_post_meta(38, '_linkstype', true);
                      
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

