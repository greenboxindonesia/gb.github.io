<?php
/*
Plugin Name: Profile Client
Plugin URI: http://www.greenboxindonesia.com/
Description: Management Post Type Biodata & Profile Client
Version: 1.0
Author: Albert Sukmono
Author URI: http://www.albert.sukmono.web.id
License: GPLv2
*/
//load library for multi image metabox on post type
require_once( trailingslashit( get_template_directory() ) . 'includes/multi-image-metabox/multi-image-metabox.php'); 

add_action( 'init', 'create_client' );

function create_client() {
register_post_type( 'client',
array(
	'labels' => array(
	'name' => 'Client',
	'singular_name' => 'Client',
	'add_new' => 'Add New',
	'add_new_item' => 'Add Client',
	'edit' => 'Edit',
	'edit_item' => 'Edit Client',
	'new_item' => 'New Client',
	'view' => 'View',
	'view_item' => 'View Client',
	'search_items' => 'Search Client',
	'not_found' => 'No client found',
	'not_found_in_trash' =>
	'No client found in Trash',
	'parent' => 'Parent Client'
	),

	'public' => true,
	'publicly_queryable' => true,
	'rewrite' => array( 'slug' => 'intl/carrer/klien','with_front' => false, 'hierarchical' => true),
	'show_ui' => true,
	'query_var' => true,
	'capability_type' => 'post',
	'menu_position' => 7,
	'supports' => array( 'title', 'editor', 'comments',	'thumbnail' ),
	'taxonomies' => array( 'client_archive'),
	'register_meta_box_cb' => 'client_meta_box',
	'has_archive' => true	
)
);
flush_rewrite_rules();
}

/*
 * create metabox
 */
add_action( 'admin_init', 'client_admin' );

function client_admin() {
add_meta_box( 
	'client_meta_box',
	'Client Details',
	'display_client_meta_box',
	'client', 'normal', 'high' 
	);
}

function display_client_meta_box( $client ) {
// metabox list
$nama = esc_html( get_post_meta( $client->ID, 'nama', true ) );
$tahun_jabatan = esc_html( get_post_meta( $client->ID, 'tahun_jabatan', true ) );
$universitas = esc_html( get_post_meta( $client->ID, 'universitas', true ) );
$jurusan = esc_html( get_post_meta( $client->ID, 'jurusan', true ) );
$angkatan = esc_html( get_post_meta( $client->ID, 'angkatan', true ) );
$komisariat = esc_html( get_post_meta( $client->ID, 'komisariat', true ) );
$alamat_sekarang = esc_html( get_post_meta( $client->ID, 'alamat_sekarang', true ) );
$kontak = esc_html( get_post_meta( $client->ID, 'kontak', true ) );
$email = esc_html( get_post_meta( $client->ID, 'email', true ) );
$facebook = esc_html( get_post_meta( $client->ID, 'facebook', true ) );
$twitter = esc_html( get_post_meta( $client->ID, 'twitter', true ) );
$website = esc_html( get_post_meta( $client->ID, 'website', true ) );

$user_rating = intval( get_post_meta( $client->ID, 'user_rating', true ) );
?>
<table>
	<tr>
	<td style="width: 100%">Nama Ketua</td>
	<td><input type="text" size="80" name="client_nama" value="<?php echo $nama; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Tahun Jabatan/Periode</td>
	<td><input type="text" size="80" name="client_tahun_jabatan" value="<?php echo $tahun_jabatan; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Universitas</td>
	<td><input type="text" size="80" name="client_universitas" value="<?php echo $universitas; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Jurusan</td>
	<td><input type="text" size="80" name="client_jurusan" value="<?php echo $jurusan; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Angkatan Mahasiswa</td>
	<td><input type="text" size="80" name="client_angkatan" value="<?php echo $angkatan; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Asal Komisariat</td>
	<td><input type="text" size="80" name="client_komisariat" value="<?php echo $komisariat; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Alamat Kantor</td>
	<td><input type="text" size="80" name="client_alamat_sekarang" value="<?php echo $alamat_sekarang; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Kontak/ Telp/ HP</td>
	<td><input type="text" size="80" name="client_kontak" value="<?php echo $kontak; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Email</td>
	<td><input type="text" size="80" name="client_email" value="<?php echo $email; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Facebook</td>
	<td><input type="text" size="80" name="client_facebook" value="<?php echo $facebook; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Twitter</td>
	<td><input type="text" size="80" name="client_twitter" value="<?php echo $twitter; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Website</td>
	<td><input type="text" size="80" name="client_website" value="<?php echo $website; ?>" /></td>
	</tr>
	<tr>
		<td style="width: 150px">Rating</td>
		<td>
			<select style="width: 100px" name="client_rating">
				<?php
				// Generate all items of drop-down list
				for ( $rating = 5; $rating >= 1; $rating -- ) {
				?>
				<option value="<?php echo $rating; ?>"
				<?php echo selected( $rating,
				$user_rating ); ?>>
				<?php echo $rating; ?> stars
				<?php } ?>
			</select>
		</td>
	</tr>
</table>
<?php }

add_action( 'save_post',
'add_client_fields', 10, 2 );

function add_client_fields( $client_id,
$client ) {
// Check post type for User Profile
if ( $client->post_type == 'client' ) {
// Store data in post meta table if present in post data

if ( isset( $_POST['client_nama'] ) &&
$_POST['client_nama'] != '' ) {
update_post_meta( $client_id, 'nama',
$_POST['client_nama'] );
}// Field nama lengkap
if ( isset( $_POST['client_tahun_jabatan'] ) &&
$_POST['client_tahun_jabatan'] != '' ) {
update_post_meta( $client_id, 'tahun_jabatan',
$_POST['client_tahun_jabatan'] );
}// Field tahun jabatan/ periode jabatan
if ( isset( $_POST['client_universitas'] ) &&
$_POST['client_universitas'] != '' ) {
update_post_meta( $client_id, 'universitas',
$_POST['client_universitas'] );
}// Field universitas
if ( isset( $_POST['client_jurusan'] ) &&
$_POST['client_jurusan'] != '' ) {
update_post_meta( $client_id, 'jurusan',
$_POST['client_jurusan'] );
}// Field jurusan
if ( isset( $_POST['client_angkatan'] ) &&
$_POST['client_angkatan'] != '' ) {
update_post_meta( $client_id, 'angkatan',
$_POST['client_angkatan'] );
}// Field angkatan
if ( isset( $_POST['client_komisariat'] ) &&
$_POST['client_komisariat'] != '' ) {
update_post_meta( $client_id, 'komisariat',
$_POST['client_komisariat'] );
}// Field komisariat
if ( isset( $_POST['client_alamat_sekarang'] ) &&
$_POST['client_alamat_sekarang'] != '' ) {
update_post_meta( $client_id, 'alamat_sekarang',
$_POST['client_alamat_sekarang'] );
}// Field alamat sekarang
if ( isset( $_POST['client_kontak'] ) &&
$_POST['client_kontak'] != '' ) {
update_post_meta( $client_id, 'kontak',
$_POST['client_kontak'] );
}// Field kontak
if ( isset( $_POST['client_email'] ) &&
$_POST['client_email'] != '' ) {
update_post_meta( $client_id, 'email',
$_POST['client_email'] );
}// Field email
if ( isset( $_POST['client_facebook'] ) &&
$_POST['client_facebook'] != '' ) {
update_post_meta( $client_id, 'facebook',
$_POST['client_facebook'] );
}// Field email
if ( isset( $_POST['client_twitter'] ) &&
$_POST['client_twitter'] != '' ) {
update_post_meta( $client_id, 'twitter',
$_POST['client_email'] );
}// Field email
if ( isset( $_POST['client_website'] ) &&
$_POST['client_website'] != '' ) {
update_post_meta( $client_id, 'website',
$_POST['client_website'] );
}// Field website

if ( isset( $_POST['client_rating'] ) &&
$_POST['client_rating'] != '' ) {
update_post_meta( $client_id, 'user_rating',
$_POST['client_rating'] );
}
}
}

add_filter( 'template_include',
'clientspage_template_function', 1 );

// Load Template from themes
function clientspage_template_function( $template_path ) {
if ( get_post_type() == 'client' ) {
	if ( is_single() ) { $template_path = plugin_dir_path( __FILE__ ) .'/template/single-client.php';}
	if ( is_archive() ) { $template_path = plugin_dir_path( __FILE__ ) .'/template/archive-client.php';}
}
return $template_path;
}

?>
