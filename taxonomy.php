<?php
get_header(); ?>

<div role="main" class="main">

    <div class="headerimg">
        <img src="<?php bloginfo('template_directory'); ?>/img/projects-header.jpg" alt="" />
    </div>
    
    <div class="content">
    
    	<h1><?php printf( __( 'Category: %s', 'dermaskin' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
        <?php
			$category_description = category_description();
			if ( ! empty( $category_description ) )
				echo '<div class="archive-meta">' . $category_description . '</div>';

				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );            

				query_posts( array($term->taxonomy => $term->name) );
				
				if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	
					$pdfs = get_children( array(
						'post_type' => 'attachment',
						'post_parent' => get_the_ID(),
						'post_mime_type' => 'application/pdf'
					));
					foreach( (array) $pdfs as $pdf ) {
						
					$attachmenturl=wp_get_attachment_url($pdf->ID);
					$file_title = $pdf->post_title;
					$src = wp_get_attachment_image_src( get_post_thumbnail_id($postimg->ID), 'news' );
					
					$categories = get_terms( 'category', 'orderby=count&hide_empty=0' );
					
					$mylinks_categories = get_terms('link_category', 'orderby=count&hide_empty=0');
				
		 ?>
         <article class="projects">
         	<?php if (empty($src)) { } else { ?>
                <img src="<?php echo $src[0]; ?>" alt="project">
            <?php }?>
         	<h2><a href="<?php echo $attachmenturl; ?>" target="_blank"><?php the_title(); ?></a></h2>
            <p><?php echo truncate(get_the_content(), 120); ?> <a href="<?php echo $attachmenturl; ?>" target="_blank">Read more...</a>
            <span class="cat-links"></span>
         </article>

        <?php } ?>
        
        <?php endwhile; else: ?>
        
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        
        <?php endif; ?>

    </div>
    
    <aside class="projects">
        	
            <div>
                <h2>Project Categories</h2>
                <ul>
					<?php 
						$args = array(
							'post_type'		=> 'projects',
							'type'          => 'post',
							'orderby'       => 'name',
							'order'         => 'ASC',
							'taxonomy'      => 'projectcategory'
						);
					
						$categories = get_categories( $args );
						
						foreach ($categories as $category) {
						?>
                        	<li><a href="<?php echo get_term_link( $category ); ?>"><?php echo $category->cat_name; ?></a></li>
                        
						<?php
						}
						?>
                </ul>
            </div>

        </aside>

</div>
<?php get_footer(); ?>