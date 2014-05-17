<?php get_header(); ?>
        <div role="main">
            
            <section class="one">
            	<div class="wrapper">
                	<h1>The Dermaskin Team</h1>	
                </div>
            </section>
            
            <section class="two">
            	<div class="wrapper">
                	<?php echo wpautop(get_post_meta($post->ID, 'subtitle', TRUE)); ?>
                </div>	
            </section>
            
            <div class="wrapper">
                
                <div class="sub-container">
                
                	<?php
					$args = array
					(
						'post_type'		=> 'doctors',
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
							
							$title             = $post->post_title;
							$qualifications 	= get_post_meta($post->ID, 'qualification', TRUE);
							//$content           = $post->post_content;
							
							$content = apply_filters("the_content",$post->post_content);
							
							//echo $user_description;

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
                        	<h2><?php echo $title; ?> <span><?php echo $qualifications; ?></span></h2>
                        	<p><?php echo the_content(); ?></p>
                    	</div>
                    </section>
                    <?php
						}
					}
					?>
                    
              	</div>
                
                <aside>
                    
                    <?php
					$ID = 8;
					
					$treatments = array(
						'include' => get_post_meta( $ID, 'featuredtreatments', true )
					);
					$feat = get_pages( $treatments );
					
					foreach ($feat as $fp )
					{
						//print_r ($fp);
						
						$permalink  = get_permalink($fp->ID);
						$title      = $fp->post_title;
						$content    = $fp->post_content;
						$colour     = $fp->post_name;
						$src 	    = wp_get_attachment_image_src( get_post_thumbnail_id($fp->ID), 'treatments-sub' );
	
					?>
                    <a class="colone" href="<?php echo $permalink; ?>">
                        <img src="<?php echo $src[0]; ?>" alt="<?php echo $title; ?>">
                        <h2 class="ribbon <?php echo $colour ?>"><?php echo $title; ?></h2>
                    </a>
                    <?php
					}
					?>
                    	
                </aside>
                
                <?php 
					$quotes_true = get_post_meta(6, '_linkstype', true);
					
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

