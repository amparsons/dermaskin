<?php 
get_header(); ?>
        <div role="main">
            
            <div id="slides" class="mobile">
                <?php
					$args = array(
						'post_type'		 => 'feature',
						'posts_per_page'	=> -1,
						'orderby'		   => 'menu_order',
						'order'			 => 'ASC',
						'sort_column'       => 'menu_order'
					);
					$features = get_posts($args);
					
					if (count($features) > 0)
					{
						$i = 1;
						foreach($features as $f)
						{
							
							$link    = get_post_meta($f->ID, 'link', TRUE);
							$src 	 = wp_get_attachment_image_src( get_post_thumbnail_id($f->ID), 'feature' );
							
							//print_r($f);
					?>
                    <img src="<?php echo $src[0]; ?>"  />
                    <?php
						$i++;
					 } 
				}
				?>

            </div>
            
            <div id="image-container" class="hidefromipad">
                <div id="left-overlay">&nbsp;</div>
                <div id="right-overlay">&nbsp;</div>
                <div id="button-holder">
                    <a href="#" class="move-left">Move Left</a>
                    <a href="#" class="move-right">Move Right</a>
                </div>
                <div id="image-slider">
                    <?php
					$args = array(
						'post_type'		 => 'feature',
						'posts_per_page'	=> -1,
						'orderby'		   => 'menu_order',
						'order'			 => 'ASC',
						'sort_column'       => 'menu_order'
					);
					$features = get_posts($args);
					
					if (count($features) > 0)
					{
						$i = 1;
						foreach($features as $f)
						{
							
							$link    = get_post_meta($f->ID, 'link', TRUE);
							$src 	 = wp_get_attachment_image_src( get_post_thumbnail_id($f->ID), 'feature' );
							
							//print_r($f);
					?>
                    <img src="<?php echo $src[0]; ?>"  />
                    <?php
						$i++;
					 } 
				}
				?>
                </div>
            </div>

            <div class="wrapper">
                <?php 
                        if (have_posts()) : while (have_posts()) : the_post();
				?>
                <h1>
                	<?php echo $post->post_content; ?>
                </h1>
                <?php
					endwhile; endif; 
                ?>
            
                <?php
				$ID = 8; // ID of the treatments page needs to change when servers changed
				
				$treatments = array(
					'include' => get_post_meta( $ID, 'featuredtreatments', true ),
					'sort_column'  => 'menu_order'
				);
				$feat = get_pages( $treatments );
				
				foreach ($feat as $fp )
				{
					//print_r ($fp);
					
					$permalink  = get_permalink($fp->ID);
					$title      = $fp->post_title;
					$content    = $fp->post_content;
					$colour     = $fp->post_name;
					$src 	    = wp_get_attachment_image_src( get_post_thumbnail_id($fp->ID), 'treatments' );

				?>
                <a href="<?php echo $permalink; ?>" class="<?php echo $colour ?>">
                <div class="colone alpha">
                	<img src="<?php echo $src[0]; ?>" alt="<?php echo $title; ?>">
                 	<h2 class="ribbon one <?php echo $colour ?>"><?php echo $title; ?></h2>
                    <p><?php echo truncate($content, 200); ?></p>
                    <span>To find out more <span>click here</span></span>
                </div>
                </a>
                <?php
				}
				?>
                
                <div class="info">
                	<h3><a href="#">For information on other treatments click here:</a></h3>
                    <ul>
                    	<?php
							wp_nav_menu(
								array(
								'menu' => 'treatment-list',
								'container' => ''
							));
						?>
                    </ul>
                </div>
                
                <div class="treatmentlst">
					<?php
					$seoargs = array
					(
						'post_type'		=> 'seotreatment',
						'orderby'		  => 'menu_order',
						'order'			=> 'ASC',
						'posts_per_page'   => -1
					);
					$seoposts = get_posts($seoargs);

					if (count($seoposts) > 0)
					{
						foreach ($seoposts as $seopost)
						{
							setup_postdata($seopost);
							
							$colour			= $seopost->post_name;
							$title             = $seopost->post_title;
							$content 		   = apply_filters("the_content",$seopost->post_content);
							$permalink  		 = get_permalink($seopost->ID);
			
					?>
                    
                        <article class="<?php echo $colour ?>">
                            <h3><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h3>
                            <?php echo $content; ?>
                        </article>
                    
                    <?php
						}
					}
					?>
                </div>

            </div>
        </div>
	</div>
</div>
<?php get_footer(); ?>

