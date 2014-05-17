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
				
                <p class="tleft">If any 'top up' treatment is required in order to achieve the best possible results this is provided <strong>free of charge</strong>.We have an <strong>'up front' pricing policy</strong> for all to see.  You may have noticed other companies making it very difficult to find their price lists or refusing to discuss their prices until the consultation.</p>
                
                <p class="tright">This puts the customer under pressure and we think it is wrong. Also, we know for a fact we are one of the most competitively priced clinics around, so rest assured you are receiving professional treatment at a great price.  <strong>So if you get a written quotation for less anywhere else, we will be happy to match it.</strong></p>
            
                <div class="infocontainer">
                
                	<p class="infotxt">Please note all prices are valid for cash and card payments:</p>
                	<div class="scroll-for-prices"></div>
                	
					<?php
					$taxonomy = 'pricelistcategory';
					$tax_terms = get_terms($taxonomy);
				
					foreach ($tax_terms as $tax_term) {
				
					$catID = $tax_term->term_id;
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					$description = $tax_term->description;
					
					//print_r($tax_term);description
	
					$args = array(
						'post_type' 		=> 'pricelist',
						'pricelistcategory'	  => $tax_term->slug,
						'posts_per_page'   => -1
					);
				
					$posts=get_posts($args);
					
					if ($posts) 
					{
						
						// Add some extra text here maybe?
					?>
                    <h2><?php echo $tax_term->name; ?></h2>
                        <div class="table-container">

                            <table width="100%" border="0">
                            	<?php
                            		foreach($posts as $post) 
                            		{
                            			setup_postdata($post);
										
										//print_r($post);
										
										$title	 = $post->post_title;
										$item    = get_post_meta($post->ID, 'item', TRUE);
										$price    = get_post_meta($post->ID, 'price', TRUE);
                            
                            	?>
                            	<tr>
                            		<td class="one"><?php echo $title; ?></td>
                            		<td class="two"><?php echo $price; ?></td>
                            		<td class="three"><?php echo $item; ?></td>   
                            	</tr>
                            	<?php
                            		}
                            	?>
                            </table>
                        </div>
                        <?php if ($description != '') 
							{ 
					    ?>
                        <p class="catdesc"><?php echo $description; ?></p>
                        <?php
							}
						?>
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

