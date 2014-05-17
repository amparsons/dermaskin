<?php
// Define global path variables
define('MY_WORDPRESS_FOLDER',$_SERVER['DOCUMENT_ROOT']);
define('MY_THEME_FOLDER',str_replace("\\",'/',dirname(__FILE__)));
define('MY_THEME_PATH','/' . substr(MY_THEME_FOLDER,stripos(MY_THEME_FOLDER,'wp-content')));

// Kill the admin nag
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );

// Load scripts in front-end      
function load_my_scripts() {  
	if (!is_admin()) {  
		wp_deregister_script( 'jquery' );  
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');  
		wp_enqueue_script('jquery'); 
		
		wp_register_script( 'respond', get_template_directory_uri() . '/js/libs/respond.min.js', array('jquery'), '1.1.0', true );
		wp_enqueue_script( 'respond' );
		
		wp_register_script( 'klass', get_template_directory_uri() . '/js/libs/klass.min.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'klass' ); 
		
		wp_register_script( 'mobslideshow', get_template_directory_uri() . '/js/libs/code.photoswipe.jquery-3.0.5.min.js', array('jquery'), '3.0.5', true );
		wp_enqueue_script( 'mobslideshow' ); 
		
		wp_register_script( 'slideshow', get_template_directory_uri() . '/js/libs/jquery.prettyPhoto.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'slideshow' );
		
		wp_register_script( 'selectivizr', get_template_directory_uri() . '/js/libs/selectivizr-min.js', array('jquery'), '1.0.2', true );
		wp_enqueue_script( 'selectivizr' );
		
		wp_register_script( 'jslides', get_template_directory_uri() . '/js/libs/jquery.slides.min.js', array('jquery'), '3.0.4', true );
		wp_enqueue_script( 'jslides' );
		
		wp_register_script( 'myscript', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'myscript' );   
	}    
}  
add_action('init', 'load_my_scripts');  


// Load scripts for admin area
function my_meta_init()
{
	// Load styles/scripts
	wp_enqueue_style('my_meta_css', MY_THEME_PATH . '/custom/meta.css');
	wp_enqueue_script('tiny_mce');
}
add_action('admin_init', 'my_meta_init');

// truncate function
function truncate($string, $limit, $break=" ", $pad="...")
{
	// Remove any formatting first
	$string = strip_tags($string);
	// return with no change if string is shorter than $limit
	if(strlen($string) <= $limit) return $string;
	// is $break present between $limit and the end of the string?
	if(false !== ($breakpoint = strpos($string, $break, $limit)))
	{
		if($breakpoint < strlen($string) - 1)
		{
			$string = substr($string, 0, $breakpoint) . $pad;
		}
	}
	return $string;
}

// Remove width and height of images
function my_post_image_html( $html, $post_id, $post_image_id )
{
	$src = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post_id ));
	
	$html = '<img src="'.$src[0].'" alt="'.esc_attr( get_post_field( 'post_title', $post_id ) ).'">';
	
	return $html;
}
add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );

function my_tinymce_config( $init ) {
    $init['remove_linebreaks'] = false; 
    //$init['convert_newlines_to_brs'] = true; 
    //$init['remove_redundant_brs'] = false; 
	$init['force_p_newlines'] = true;
	//$init['apply_source_formatting'] = true;

    return $init;
}
add_filter('tiny_mce_before_init', 'my_tinymce_config');

// adds menus to the appearance tab in the admin area
register_nav_menu( 'primary', 'Primary Menu');

// add featured image support
add_theme_support( 'post-thumbnails' ); 
add_image_size( 'feature', 950, 300, TRUE );
add_image_size( 'treatments', 218, 130, TRUE );
add_image_size( 'treatments-sub', 254, 146, TRUE );
add_image_size( 'treatmentspage', 275, 155, TRUE );
add_image_size('gallery-thumb', 253, 168, FALSE);
add_image_size('gallery-image', 800, 600, FALSE);
add_image_size('map', 282, 146, TRUE);

// Removes ul class from wp_nav_menu
function remove_ul ( $menu ){
    return preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
}
add_filter( 'wp_nav_menu', 'remove_ul' );

// Breadcrumbs
function get_breadcrumbs(){
	global $post;

	$separator = '  &nbsp;&gt;&nbsp; '; // what to place between the pages

	if ( is_page() ){
		// bread crumb structure only logical on pages
		$trail = array($post); // initially $trail only contains the current page
		$parent = $post; // initially set to current post
		$show_on_front = get_option( 'show_on_front'); // does the front page display the latest posts or a static page
		$page_on_front = get_option( 'page_on_front' ); // if it shows a page, what page
		// while the current page isn't the home page and it has a parent
		while ( $parent->post_parent && !($parent->ID == $page_on_front && 'page') == $show_on_front ){
			$parent = get_post( $parent->post_parent ); // get the current page's parent
			array_unshift( $trail, $parent ); // add the parent object to beginning of array
		}
		if ( 'posts' == $show_on_front ) // if the front page shows latest posts, simply display a home link
			echo "<li class='breadcrumb-item' id='breadcrumb-0'><a href='" . get_bloginfo('home') . "'>Home</a></li>\n"; // home page link
		else{ // if the front page displays a static page, display a link to it
			$home_page = get_post( $page_on_front ); // get the front page object
			echo "<li class='breadcrumb-item' id='breadcrumb-{$home_page->ID}'><a href='" . get_bloginfo('home') . "'>$home_page->post_title</a></li>\n"; // home page link
			if($trail[0]->ID == $page_on_front) // if the home page is an ancestor of this page
				array_shift( $trail ); // remove the home page from the $trail because we've already printed it
		}
		foreach ( $trail as $page){
			// print the link to the current page in the foreach
			echo "<li class='breadcrumb-item' id='breadcrumb-{$page->ID}' >$separator<a href='" . get_page_link( $page->ID ) . "'>{$page->post_title}</a></li>\n";
		}
	}else{
		// if what we're looking at isn't a page, simply display a home link
		echo "<li class='breadcrumb-item' id='breadcrumb-0'><a href='" . get_bloginfo('home') . "'>Home</a></li>\n"; // home page link
	}
}

// CUSTOM POST TYPES //
add_action('init', 'feature_init');
function feature_init() 
{
	//Default arguments
	$args = array
	(
		'public' 				=> true,
		'publicly_queryable'	=> true,
		'show_ui' 				=> true, 
		'query_var' 			=> true,
		'rewrite' 				=> true,
		'capability_type' 		=> 'post',
		'has_archive' 			=> true, 
		'hierarchical' 			=> false,
		'menu_position' 		=> NULL,
	);
	
	/* ----------------------------------------------------
	FEATURES
	---------------------------------------------------- */
	
	$labels = array
	(
		'name' 					=> 'Features',
		'singular_name' 		=> 'Feature',
		'add_new' 				=> _x('Add New', 'feature'),
		'add_new_item' 			=> 'Add New Feature',
		'edit_item' 			=> 'Edit Feature',
		'new_item' 				=> 'New Feature',
		'view_item' 			=> 'View Feature',
		'search_items' 			=> 'Search Features',
		'not_found' 			=> 'No Features found',
		'not_found_in_trash'	=> 'No Features found in Trash',
		'parent_item_colon' 	=> '',
		'menu_name' 			=> 'Features'
	);
	
	$args['labels'] 			= $labels;
	$args['supports'] 			= array('title','thumbnail');
	$args['rewrite']			= array('slug' => 'features');
	$args['menu_icon']			= get_bloginfo('template_directory').'/custom/img/features.png';
	$args['show_in_menu']		= true;
	
	register_post_type('feature', $args);
	
	/* ----------------------------------------------------
	THE TEAM
	---------------------------------------------------- */
	
	$labels = array
	(
		'name' 					=> 'doctors',
		'singular_name' 		   => 'Doctor',
		'add_new' 				 => _x('Add New', 'Doctor'),
		'add_new_item' 			=> 'Add New Doctor',
		'edit_item'				> 'Edit Doctor',
		'new_item' 				=> 'New Doctor',
		'view_item' 			   => 'View Doctors',
		'search_items' 			=> 'Search Doctors',
		'not_found' 			   => 'No Doctors found',
		'not_found_in_trash'	  => 'No Doctors found in Trash',
		'parent_item_colon' 	   => '',
		'menu_name' 			   => 'Doctors'
	);
	
	$args['labels'] 			= $labels;
	$args['supports'] 			= array('title','editor','thumbnail');
	$args['rewrite']			= array('slug' => 'Doctors');
	$args['menu_icon']			= get_bloginfo('template_directory').'/custom/img/members.png';
	$args['show_in_menu']		= true;
	
	register_post_type('doctors', $args);
	
	/*----------------------------------------------------
	GALLERY
	---------------------------------------------------- */
	
	$labels = array
	(
		'name' 					=> 'Gallery',
		'singular_name' 		=> 'Gallery',
		'add_new' 				=> 'Add New Gallery',
		'add_new_item' 			=> 'Add New Gallery',
		'edit_item' 			=> 'Edit Gallery',
		'new_item' 				=> 'New Gallery',
		'view_item' 			=> 'View Gallery',
		'search_items' 			=> 'Search Gallery',
		'not_found' 			=> 'No Gallery found',
		'not_found_in_trash'	=> 'No Gallery found in Trash',
		'parent_item_colon' 	=> '',
		'menu_name' 			=> 'Gallery',
	);
	
	$args['labels']				= $labels;
	$args['supports']			= array( 'title', 'editor','thumbnail' , 'page-attributes' );
	$args['rewrite']			= array('slug' => 'gallery');
	$args['show_in_menu']		= true;
	$args['menu_icon']			= get_bloginfo('template_directory').'/custom/img/features.png';
	
	register_post_type('gallery', $args);
	
	/* ----------------------------------------------------
	TESTIMONIALS
	---------------------------------------------------- */
	
	$labels = array
	(
		'name' 					=> 'testimonials',
		'singular_name' 		   => 'Testimonial',
		'add_new' 				 => _x('Add New', 'Testimonial'),
		'add_new_item' 			=> 'Add New Testimonial',
		'edit_item'				> 'Edit Testimonial',
		'new_item' 				=> 'New Testimonial',
		'view_item' 			   => 'View Testimonial',
		'search_items' 			=> 'Search Testimonials',
		'not_found' 			   => 'No Testimonials found',
		'not_found_in_trash'	  => 'No Testimonials found in Trash',
		'parent_item_colon' 	   => '',
		'menu_name' 			   => 'Testimonial'
	);
	
	$args['labels'] 			= $labels;
	$args['supports'] 			= array('title','editor','thumbnail');
	$args['rewrite']			= array('slug' => 'Testimonial');
	$args['menu_icon']			= get_bloginfo('template_directory').'/custom/img/members.png';
	$args['show_in_menu']		= true;
	
	register_post_type('Testimonials', $args);
	
	/* ----------------------------------------------------
	TREATMENT AREAS
	---------------------------------------------------- */
	
	$labels = array
	(
		'name' 					=> 'Areas',
		'singular_name' 		=> 'Areas',
		'add_new' 				=> _x('Add New', 'area'),
		'add_new_item' 			=> 'Add New Area',
		'edit_item' 			=> 'Edit Area',
		'new_item' 				=> 'New Area',
		'view_item' 			=> 'View Area',
		'search_items' 			=> 'Search Area',
		'not_found' 			=> 'No Areas found',
		'not_found_in_trash'	=> 'No Areas found in Trash',
		'parent_item_colon' 	=> '',
		'menu_name' 			=> 'Areas'
	);
	
	$args['labels'] 			= $labels;
	$args['supports'] 			= array('title','thumbnail');
	$args['rewrite']			= array('slug' => 'area');
	$args['menu_icon']			= get_bloginfo('template_directory').'/custom/img/features.png';
	$args['show_in_menu']		= true;
	
	register_post_type('Areas', $args);
	
	
	/* ----------------------------------------------------
	AtoZ
	---------------------------------------------------- */
	
	$labels = array
	(
		'name'															=> 'AtoZ',
		'singular_name'						=> 'AtoZ',
		'add_new' 											=> 'Add item to AtoZ',
		'add_new_item' 						=> 'Add New item AtoZ',
		'edit_item' 									=> 'Edit AtoZ',
		'new_item' 										=> 'New AtoZ',
		'view_item' 									=> 'View AtoZ',
		'search_items'							=> 'Search AtoZ',
		'not_found' 									=> 'No item found in the AtoZ',
		'not_found_in_trash'	=> 'No item found in Trash',
		//'parent_item_colon' 	=> '',
		'menu_name' 									=> 'AtoZ'
		
	);
	
	//'taxonomies' => array('category', 'post_tag') // this is IMPORTANT
	
	$args['labels']			= $labels;
	$args['supports']			= array('title','editor','thumbnail');
	$args['rewrite']			= array('slug' => 'atoz');
	$args['show_in_menu']		= true;
	$args['taxonomies']			= array('atoz', 'post_tag');
	$args['menu_icon']			= get_bloginfo('template_directory').'/custom/img/jobs.png';
	
	register_post_type('AtoZ', $args);
	
	/* ----------------------------------------------------
	PRICE LIST
	---------------------------------------------------- */
	
	$labels = array
	(
		'name' 					=> 'pricelist',
		'singular_name' 		=> 'Price List',
		'add_new' 				=> 'Add item to Price List',
		'add_new_item' 			=> 'Add New item Price List',
		'edit_item' 			=> 'Edit Price List',
		'new_item' 				=> 'New Price List',
		'view_item' 			=> 'View Price List',
		'search_items' 			=> 'Search Price List',
		'not_found' 			=> 'No item found in the Price List',
		'not_found_in_trash'	=> 'No item found in Trash',
		//'parent_item_colon' 	=> '',
		'menu_name' 			=> 'Price Lists'
		
	);
	
	//'taxonomies' => array('category', 'post_tag') // this is IMPORTANT
	
	$args['labels']			= $labels;
	$args['supports']			= array('title','thumbnail');
	$args['rewrite']			= array('slug' => 'pricelist');
	$args['show_in_menu']		= true;
	$args['taxonomies']			= array('pricelist', 'post_tag');
	$args['menu_icon']			= get_bloginfo('template_directory').'/custom/img/jobs.png';
	
	register_post_type('pricelist', $args);
	
	/* ----------------------------------------------------
	SPECIAL OFFERS
	---------------------------------------------------- */
	
	$labels = array
	(
		'name' 				  => 'Special Offers',
		'singular_name' 		 => 'Special Offers',
		'add_new' 			   => _x('Add New', 'Special Offer'),
		'add_new_item' 		  => 'Add New Special Offer',
		'edit_item' 			 => 'Edit Special Offer',
		'new_item' 			  => 'New Special Offer',
		'view_item' 			 => 'View Special Offer',
		'search_items' 		  => 'Search Special Offer',
		'not_found' 			 => 'No Special Offer found',
		'not_found_in_trash'	=> 'No Special Offer found in Trash',
		'parent_item_colon' 	 => '',
		'menu_name' 			 => 'Special Offer'
	);
	
	$args['labels'] 			  = $labels;
	$args['supports'] 			= array('title','editor','thumbnail');
	$args['rewrite']			 = array('slug' => 'specialoffers');
	$args['show_in_menu']		= true;
	$args['taxonomies']		  = array('specialoffers', 'post_tag');
	$args['menu_icon']		   = get_bloginfo('template_directory').'/custom/img/features.png';
	$args['show_in_menu']		= true;
	
	
	register_post_type('specialoffers', $args);
	
	/* ----------------------------------------------------
	FAQs
	---------------------------------------------------- */
	
	$labels = array
	(
		'name' 					=> 'faqs',
		'singular_name' 		=> 'FAQs',
		'add_new' 				=> _x('Add New', 'FAQ'),
		'add_new_item' 			=> 'Add New FAQ',
		'edit_item' 			=> 'Edit FAQ',
		'new_item' 				=> 'New FAQ',
		'view_item' 			=> 'View FAQ',
		'search_items' 			=> 'Search FAQs',
		'not_found' 			=> 'No FAQs found',
		'not_found_in_trash'	=> 'No FAQs found in Trash',
		'parent_item_colon' 	=> '',
		'menu_name' 			=> 'FAQs'
	);
	
	$args['labels'] 			= $labels;
	$args['supports'] 			= array('title','editor','thumbnail');
	$args['rewrite']			= array('slug' => 'faqs');
	$args['show_in_menu']		= true;
	$args['taxonomies']			= array('faqs', 'post_tag');
	$args['menu_icon']			= get_bloginfo('template_directory').'/custom/img/features.png';
	$args['show_in_menu']		= true;
	
	
	register_post_type('faqs', $args);
	
	/* ----------------------------------------------------
	ADDRESSES
	---------------------------------------------------- */
	
	$labels = array
	(
		'name' 					=> 'addresses',
		'singular_name' 		   => 'addresses',
		'add_new' 				 => _x('Add New', 'Address'),
		'add_new_item' 			=> 'Add New Address',
		'edit_item' 			   => 'Edit Address',
		'new_item' 				=> 'New Address',
		'view_item' 			   => 'View Address',
		'search_items' 			=> 'Search Address',
		'not_found' 			   => 'No Addresses found',
		'not_found_in_trash'	  => 'No Addresses found in Trash',
		'parent_item_colon' 	   => '',
		'menu_name' 			   => 'Addresses'
	);
	
	$args['labels'] 			= $labels;
	$args['supports'] 		  = array('title','editor','thumbnail');
	$args['rewrite']		   = array('slug' => 'addresses');
	$args['show_in_menu']	  = true;
	$args['taxonomies']		= array('addresses', 'post_tag');
	$args['menu_icon']		 = get_bloginfo('template_directory').'/custom/img/features.png';
	$args['show_in_menu']	  = true;
	
	
	register_post_type('addresses', $args);

/* ----------------------------------------------------
	SEO TREATMENT LIST
	---------------------------------------------------- */
	
	$labels = array
	(
			'name'					=> 'seotreatment',
			'singular_name' 		   => 'seotreatment',
			'add_new' 				 => _x('Add New', 'SEO Treatment'),
			'add_new_item' 			=> 'Add New SEO Treatment',
			'edit_item' 			   => 'Edit SEO Treatment',
			'new_item' 				=> 'New SEO Treatment',
			'view_item' 			   => 'View SEO Treatment',
			'search_items' 			=> 'Search SEO Treatments',
			'not_found' 			   => 'No SEO Treatments found',
			'not_found_in_trash'	  => 'No SEO Treatments found in Trash',
			'parent_item_colon'	   => '',
			'menu_name' 			   => 'SEO Treamtent'
	);
	
	$args['labels'] 			 = $labels;
	$args['supports'] 		   = array('title','editor','thumbnail');
	$args['rewrite']		   	= array('slug' => 'seotreatment');
	$args['show_in_menu']	   = true;
	$args['taxonomies']		 = array('addresses', 'post_tag');
	$args['menu_icon']		  = get_bloginfo('template_directory').'/custom/img/features.png';
	$args['show_in_menu']	   = true;
	
	register_post_type('seotreatment', $args);
	
}

// Add custom taxonomy for AtoZ
function atoz_init() {
	// create a new taxonomy
	register_taxonomy(
		'azcategory',
		'atoz',
		array(
			'label' 		   => __( 'AtoZ Category' ),
			'sort' 			=> true,
			'args' 			=> array( 'orderby' => 'atoz_order' ),
			'query_var'	   => true,
			//'rewrite'		  => true,
			'rewrite'		 => array( 'slug' => 'azcategory' ),
			'hierarchical' 	=> true
		)
	);
}
add_action( 'init', 'atoz_init' );

// Add custom taxonomy for Price List
function pricelist_init() {
	// create a new taxonomy
	register_taxonomy(
		'pricelistcategory',
		'pricelist',
		array(
			'label' 		   => __( 'Price List Category' ),
			'sort' 			=> true,
			'args' 			=> array( 'orderby' => 'pricelist_order' ),
			'query_var'	   => true,
			//'rewrite'		  => true,
			'rewrite'		 => array( 'slug' => 'pricelistcategory' ),
			'hierarchical' 	=> true
		)
	);
}
add_action( 'init', 'pricelist_init' );

// Add custom taxonomy for Special Offers
function specialoffers_init() {
	// create a new taxonomy
	register_taxonomy(
		'specialofferscategory',
		'specialoffers',
		array(
			'label' 		   => __( 'Special Offers Category' ),
			'sort' 			=> true,
			'args' 			=> array( 'orderby' => 'specialoffers_order' ),
			'query_var'	   => true,
			'rewrite'		 => array( 'slug' => 'specialofferscategory' ),
			'hierarchical' 	=> true
		)
	);
}
add_action( 'init', 'specialoffers_init' );

// Add custom taxonomy for FAQs
function faqs_init() {
	// create a new taxonomy
	register_taxonomy(
		'faqscategory',
		'faqs',
		array(
			'label' 		   => __( 'FAQs Category' ),
			'sort' 			=> true,
			'args' 			=> array( 'orderby' => 'faqs_order' ),
			'query_var'	   => true,
			'rewrite'		 => array( 'slug' => 'faqscategory' ),
			'hierarchical' 	=> true
		)
	);
}
add_action( 'init', 'faqs_init' );


add_action('add_meta_boxes', 'add_dermaskin_meta');
function add_dermaskin_meta()
{
	add_meta_box('feature-details', 'Feature Details', 'add_feature_meta', 'feature', 'normal', 'default');
	add_meta_box("gallery", "Add slideshow", "add_gallery_meta", "gallery", "normal", "default");
	add_meta_box("doctors", "Add Qualification", "add_about_meta", "doctors", "normal", "default");
	add_meta_box('areas', 'Areas', 'add_area_meta', 'areas', 'normal', 'default');
	add_meta_box('heading', 'Subheading', 'add_header_meta', 'page', 'normal', 'high');
	add_meta_box('pricelist', 'Price Lists', 'add_pricelist_meta', 'pricelist', 'normal', 'high');
	add_meta_box("bluebox", "Select which blue links box you want for this page:", "get_blue_list", "page", "normal", "default");
		add_meta_box("bluebox", "Select which blue links box you want for this page:", "get_blue_list", "atoz", "normal", "default");
		add_meta_box("bluebox", "Select which blue links box you want for this page:", "get_blue_list", "post", "normal", "default");
	add_meta_box("addresses", "Additional information", "add_address_meta", "addresses", "normal", "default");
	
	// Adds featured treatments section to the home page only
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;

	if ($post_id == '8') //ID of treatments page
    {
		add_meta_box("pages-list", "Home page featured treatment selection (Maximum of four selections)", "get_pages_list", "page", "normal", "default");
	}
	
	// Adds meta boxes to the treatments pages only with the template treatment.php
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
	if ($template_file == 'treatment.php')
	{
		add_meta_box('details', 'Treatment details', 'add_treatmentoptions_meta', 'page', 'normal', 'high');
	}
	
	$post_types = get_post_types();
    foreach ( $post_types as $post_type ) {
        add_meta_box('metabox', 'Meta Data', 'add_page_meta', $post_type, 'normal', 'default');
	}

}

function add_header_meta($post, $metabox)
{
	global $post;
	
	$subtitle		= '';
	
  	$custom = get_post_custom($post->ID);
	
	if (array_key_exists('subtitle', $custom))
	{
		$subtitle	= $custom["subtitle"][0];
	}
	
	include(MY_THEME_FOLDER . '/custom/subtitle.php');

}

function add_feature_meta($post, $metabox)
{
	global $post;
	
	$link		= '';
	
  	$custom = get_post_custom($post->ID);
	
	if (array_key_exists('link', $custom))
	{
		$link	= $custom["link"][0];
	}
	
	include(MY_THEME_FOLDER . '/custom/feature.php');

}

function add_about_meta($post, $metabox)
{
	global $post;
	
	$qualification	= '';
	
  	$custom = get_post_custom($post->ID);
	
	if (array_key_exists('qualification', $custom))
	{
		$qualification	= $custom["qualification"][0];
	}
	
	include(MY_THEME_FOLDER . '/custom/about.php');

}

function add_area_meta($post, $metabox)
{
	global $post;
	
	$link		= '';
	
  	$custom = get_post_custom($post->ID);
	
	if (array_key_exists('link', $custom))
	{
		$link	= $custom["link"][0];
	}
	
	include(MY_THEME_FOLDER . '/custom/areas.php');

}

function add_pricelist_meta($post, $metabox)
{
	global $post;
	
	$item		= '';
	$price       = '';
	
  	$custom = get_post_custom($post->ID);
	
	if (array_key_exists('item', $custom))
	{
		$item	= $custom["item"][0];
		$price   = $custom["price"][0];
	}
	
	include(MY_THEME_FOLDER . '/custom/pricelist.php');

}

function add_page_meta($post, $metabox)
{
	global $post;
	
	$title	      = '';
 	$keywords 	   = '';
	$description    = '';
	
  	$custom = get_post_custom($post->ID);
	
	if (array_key_exists('keywords', $custom))
	{
		$title 			= $custom['title'][0];
		$keywords 		 = $custom['keywords'][0];
		$description 	  = $custom['description'][0];
	}

	include(MY_THEME_FOLDER . '/custom/metadata.php');

}

// List pages in section (test stage)
function get_pages_list($page, $metabox)
{
	$ids = get_post_meta( $_GET['post'], 'featuredtreatments', true );
	$arr = explode( ',', $ids );
	
	$args = array(
		'child_of'    => $_GET["post"],
		//'post_date', 'sort_order',
		'orderby'     => 'menu_order',
		'order'	   => 'ASC',
		'sort_column'  => 'menu_order'
	);
	$pagelist = get_pages( $args );

	foreach( $pagelist as $page ) {		
	 	
		$pagename = $page->post_title;
		
		$checked = '';
		if ( in_array( $page->ID, $arr ) )
		{
			$checked = ' checked';
		}
		
		$string.= '<input name="featuredtreatments[]" type="checkbox" value="'.$page->ID.'"'.$checked.' /> <label>'.$pagename.'</label><br />';
	}
	echo $string;
	
}

function add_treatmentoptions_meta($post, $metabox)
{
	global $post;
	
	$price		= '';
	$detail       = '';
	
	$custom = get_post_custom($post->ID);
	
	if (array_key_exists('price', $custom))
	{
		$price	= $custom["price"][0];
		$detail   = $custom["detail"][0];
	}
	
	include(MY_THEME_FOLDER . '/custom/treatments.php');
}

function add_gallery_meta($post, $metabox)
{
	global $post;
    $post_ID = $post->ID; // global used by get_upload_iframe_src
	printf( "<iframe frameborder='0' src=' %s ' style='width: 100%%; height: 400px;'> </iframe>", get_upload_iframe_src('media') );
}

// Blue box
function get_blue_list($post, $metabox)
{
	$linkstype = get_post_meta($post->ID, '_linkstype', TRUE);

	include(MY_THEME_FOLDER . '/custom/blue-box.php');

}

// Addresses meta box
function add_address_meta($post, $metabox)
{
	global $post;
	
	$tel		= '';
	$mapid      = '';
	
  	$custom = get_post_custom($post->ID);
	
	if (array_key_exists('tel', $custom))
	{
		$tel	 = $custom["tel"][0];
		$mapid	= $custom["mapid"][0];
	}
	
	include(MY_THEME_FOLDER . '/custom/address.php');

}

// Save data
add_action('save_post', 'save_custom', 10, 1);
function save_custom($post_id)
{
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
	{
    	return;
	}
	
	// Page sub heading
	if( isset( $_POST['subtitle'] ) )
	{
		$data = wpautop($_POST['subtitle']);
		update_post_meta($post_id, "subtitle", $data);
		//update_post_meta($post_id, "subtitle", $_POST["subtitle"]);
	}
	
	// Custom post types
	if ( isset( $_POST['post_type'] ) )
	{
		// Features
		if ( $_POST['post_type'] == 'feature' )
		{
			if (isset($_POST['link']))
			{ 
				update_post_meta($post_id, "link", $_POST["link"]);
			}
		}

	}
	
	if ( isset( $_POST['post_type'] ) )
	{
		// Area list
		if ( $_POST['post_type'] == 'areas' )
		{
			if (isset($_POST['link']))
			{ 
				update_post_meta($post_id, "link", $_POST["link"]);
			}
		}

	}
	
	if ( isset( $_POST['post_type'] ) )
	{
		// About us qualifications
		if ( $_POST['post_type'] == 'doctors' )
		{
			if (isset($_POST['qualification']))
			{ 
				update_post_meta($post_id, "qualification", $_POST["qualification"]);
				
			}
		}

	}
	
	//Treatments extra meta save
	if (isset ($_POST['price']))
	{
		update_post_meta($post_id, "price", $_POST["price"]);
		update_post_meta($post_id, "detail", $_POST["detail"]);
	}
	
	// Home page featured treatments selection save
	if ( isset( $_POST['featuredtreatments'] ) )
	{
		$str = implode( ',', $_POST['featuredtreatments'] );
		update_post_meta($post_id, "featuredtreatments", $str);
		
	}
	
	//Price list meta data
	if (isset ($_POST['item']))
	{
		update_post_meta($post_id, "item", $_POST["item"]);
		update_post_meta($post_id, "price", $_POST["price"]);
	}
	
	// Saves meta data
	if( isset( $_POST['title'] ) )
	{
        update_post_meta( $post_id, 'title', wp_kses( $_POST['title'], $allowed ) );
	}
	if( isset( $_POST['keywords'] ) )
	{
        update_post_meta( $post_id, 'keywords', wp_kses( $_POST['keywords'], $allowed ) );
	}
	if( isset( $_POST['description'] ) )
	{
        update_post_meta( $post_id, 'description', wp_kses( $_POST['description'], $allowed ) );
	}
	
	//Add contact page addresses
	if (isset ($_POST['tel']))
	{
		update_post_meta($post_id, "tel", $_POST["tel"]);
		update_post_meta($post_id, "mapid", $_POST["mapid"]);
	}
	
	// Blue box links selection
	update_post_meta($post_id, '_linkstype', esc_attr($_POST['linkstype']) );

}



?>