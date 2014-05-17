<?php get_header(); ?>
        <div role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <section class="one">
            	<div class="wrapper">
                	<h1>Non Surgical Treatments Offered at DermaSkin</h1>	
                </div>
            </section>
            
            <section class="two">
            	<div class="wrapper"> 
                	<?php echo wpautop(get_post_meta($post->ID, 'subtitle', TRUE)); ?>	
                </div>	
            </section>
            
            <div class="wrapper">
				
                <?php 
					
					//$children = get_pages('child_of='.$post->ID.'&orderby=menu_order&order=ASC');
					//echo $post->post_parent;
					$children = get_pages('child_of='.$post->ID.'&orderby=menu_order&sort_order=ASC&parent='.$post->ID);
					
					foreach($children as $page)
					{
						$count = 0;
						$permalink 	= get_page_link($page->ID);
						$title 		= $page->post_title;
						$detail 	   = get_post_meta($page->ID, 'detail', TRUE);
						$price 	    = get_post_meta($page->ID, 'price', TRUE);
						$content      = $page->post_content;
						$src 	      = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'treatmentspage' );
				?>
				<article class="<?php echo $count; ?>">
                	<a href="<?php echo $permalink; ?>">
                    <h2><?php echo $title; ?></h2>
                    <img src="<?php echo $src[0]; ?>" alt="<?php echo $title; ?>">
                    <span class="subinfo"><?php echo $detail; ?></span>
                    <p><span><?php echo $price; ?></span> <?php echo truncate($content, 200); ?> <span class="more">Read More...</span></p>
                    </a>
                </article>
				<?php
					
					}
					$count++;
				?>

                <?php 
					$quotes_true = get_post_meta($post->ID, '_linkstype', true);
					
					if($quotes_true == 'gallery') {
						include("inc/gallery-box.php");
					}
					elseif($quotes_true == 'treatments') {
						include("inc/treatments-box.php");
					}
					
				?>

            </div>
            <?php endwhile; endif; ?>
        </div>
	</div>
</div>
<?php get_footer(); ?>

