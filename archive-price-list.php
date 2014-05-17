<?php get_header(); ?>
        <div role="main">
            
            <section class="one">
            	<div class="wrapper">
                	<h1>The Dermaskin Promise</h1>	
                </div>
            </section>
            
            <section class="two">
            	<div class="wrapper">
                	<p>
                    	<?php echo get_post_meta($post->ID, 'subtitle', TRUE); ?>
					</p>	
                </div>	
            </section>
            
            <div class="wrapper">
				
                <p class="tleft">If any 'top up' treatment is required in order to achieve the best possible results this is provided free of charge.We have an 'up front' pricing policy for all to see.  You may have noticed other companies making it very difficult to find their price lists or refusing to discuss their prices until the consultation.</p>
                
                <p class="tright">This puts the customer under pressure and we think it is wrong. Also, we know for a fact we are one of the most competitively priced clinics around, so rest assured you are receiving professional treatment at a great price.  So if you get a written quotation for less anywhere else, we will be happy to match it.</p>
            
                <div class="infocontainer">
                
                	<p class="infotxt">Please note all prices are valid for cash and card payments:</p>
                	<div class="scroll-for-prices"></div>
                	
					<?php
					$taxonomy = 'pricelistcategory';
					$tax_terms = get_terms($taxonomy);
				
					foreach ($tax_terms as $tax_term) {
				
					$catID = $tax_term->term_id;
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	
					$args = array(
						'post_type' 		=> 'pricelist',
						'azcategory'	  => $tax_term->slug,
						'posts_per_page'   => -1
					);
				
					$posts=get_posts($args);
					
					if ($posts) 
					{
					?>
                    <h2><?php echo $tax_term->name; ?></h2>
                        <div class="table-container">

                            <table width="100%" border="0">
                            	<?php
                            		foreach($posts as $post) 
                            		{
                            			setup_postdata($post); 
                            
                            	?>
                            	<tr>
                            		<td class="one">Forehead</td>
                            		<td class="two">Forehead</td>
                            		<td class="three">Forehea  dsffsdf f sd fds fdsd</td>   
                            	</tr>
                            	<?php
                            		}
                            	?>
                            </table>
                    
                        </div>
					<?php	
                       }
					   }
                     ?>
                </div>
                
                
                
                
                
                <?php include("inc/info-box.php"); ?>

            </div>
        </div>
	</div>
</div>
<?php get_footer(); ?>

