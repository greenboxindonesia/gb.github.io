<?php
/*
Plugin Name: Gallery Demo Site
Plugin URI: http://www.greenboxindonesia.com/
Description: Management Gallery & Portfolio
Version: 1.0
Author: Albert Sukmono
Author URI: http://www.albert.sukmono.web.id
License: GPLv2
*/
//load library for multi image metabox on post type
require_once( trailingslashit( get_template_directory() ) . 'includes/multi-image-metabox/multi-image-metabox.php'); 

add_action( 'init', 'create_gallery' );

function create_gallery() {
register_post_type( 'gallery',
array(
	'labels' => array(
	'name' => 'Gallery',
	'singular_name' => 'Gallery',
	'add_new' => 'Add New',
	'add_new_item' => 'Add Gallery',
	'edit' => 'Edit',
	'edit_item' => 'Edit Gallery',
	'new_item' => 'New Gallery',
	'view' => 'View',
	'view_item' => 'View Gallery',
	'search_items' => 'Search Gallery',
	'not_found' => 'No gallery found',
	'not_found_in_trash' =>
	'No gallery found in Trash',
	'parent' => 'Parent Gallery'
	),

	'public' => true,
	'publicly_queryable' => true,
	'rewrite' => array( 'slug' => 'intl/orat-oret/gallery/item','with_front' => false, 'hierarchical' => true),
	'show_ui' => true,
	'query_var' => true,
	'capability_type' => 'post',
	'menu_position' => 5,
	'supports' => array( 'title', 'editor', 'comments',	'thumbnail' ),
	'taxonomies' => array( 'gallery_archive'),
	'register_meta_box_cb' => 'gallery_meta_box',
	'has_archive' => true	
)
);
flush_rewrite_rules();
}

/*
 * create taxonomy
 */
// hook into the init action and call create_staff_taxonomies when it fires
add_action( 'init', 'gallery_taxonomies', 0 );
// create for the post type "gallery"
function gallery_taxonomies() {
    $labels = array(
        'name'              => _x( 'Gallery Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Gallery Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Categories' ),
    );

    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite' 			=> array( 'slug' => 'intl/orat-oret/gallery/arsip', 'with_front' => true ),
		'has_archive' 		=> true
    );

    register_taxonomy( 'gallery_categories', array( 'gallery' ), $args );
}

/*
 * create metabox
 */
add_action( 'admin_init', 'gallery_admin' );

function gallery_admin() {
add_meta_box( 
	'gallery_meta_box',
	'Gallery Details',
	'display_gallery_meta_box',
	'gallery', 'normal', 'high' 
	);
}

function display_gallery_meta_box( $gallery ) {
// metabox list
$customer = esc_html( get_post_meta( $gallery->ID, 'customer', true ) );
$webclass = esc_html( get_post_meta( $gallery->ID, 'webclass', true ) );
$website = esc_html( get_post_meta( $gallery->ID, 'website', true ) );
?>
<table>
	<tr>
		<td style="width: 100%">Customer</td>
		<td><input type="text" size="80" name="gallery_customer" value="<?php echo $customer; ?>" /></td>
	</tr>
	<tr>
		<td style="width: 100%">Webclass</td>
		<td><input type="text" size="80" name="gallery_webclass" value="<?php echo $webclass; ?>" /></td>
	</tr>
	<tr>
		<td style="width: 100%">URL Demo</td>
		<td><input type="text" size="80" name="gallery_website" value="<?php echo $website; ?>" /></td>
	</tr>
</table>
<?php }

add_action( 'save_post',
'add_gallery_fields', 10, 2 );

function add_gallery_fields( $gallery_id,
$gallery ) {
// Check post type for User Profile
if ( $gallery->post_type == 'gallery' ) {
// Store data in post meta table if present in post data

if ( isset( $_POST['gallery_customer'] ) &&
$_POST['gallery_customer'] != '' ) {
update_post_meta( $gallery_id, 'customer',
$_POST['gallery_customer'] );
}// Field Customer

if ( isset( $_POST['gallery_webclass'] ) &&
$_POST['gallery_webclass'] != '' ) {
update_post_meta( $gallery_id, 'webclass',
$_POST['gallery_webclass'] );
}// Field Webclass

if ( isset( $_POST['gallery_website'] ) &&
$_POST['gallery_website'] != '' ) {
update_post_meta( $gallery_id, 'website',
$_POST['gallery_website'] );
}// Field Website
}
}

add_filter( 'template_include',
'gallery_template_function', 1 );

// Load Template from themes
function gallery_template_function( $template_path ) {
if ( get_post_type() == 'gallery' ) {
	if ( is_single() ) { $template_path = plugin_dir_path( __FILE__ ) .'/template/single-gallery.php';}
	if ( is_archive() ) { $template_path = plugin_dir_path( __FILE__ ) .'/template/archive-gallery.php';}
}
return $template_path;
}

// load activated for post type multi image metabox library
/*
add_filter('images_cpt','my_image_cpt');
function my_image_cpt(){
$cpts = array('page','gallery');
return $cpts;
}

add_filter('list_images','my_list_images',10,2);
function my_list_images($list_images, $cpt){
    global $typenow;
    if($typenow == "gallery" || $cpt == "gallery")
        $picts = array(
            'image1' => '_image1',
            'image2' => '_image2',
            'image3' => '_image3',
            'image4' => '_image4',
            'image5' => '_image5',
            'image6' => '_image6',
        );
    else
        $picts = array(
            'image1' => '_image1',
            'image2' => '_image2',
            'image3' => '_image3',
            'image4' => '_image4',
            'image5' => '_image5',
            'image6' => '_image6',
            'image7' => '_image7',
            'image8' => '_image8',
        );
    return $picts;
}
//end load library multi image metabox
*/
?>
