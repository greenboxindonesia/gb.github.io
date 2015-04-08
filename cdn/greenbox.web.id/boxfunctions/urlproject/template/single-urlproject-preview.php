<?php
/**
 * Default Page Header
 *
 * @package Bootstrap
 * @subpackage Bootstrap
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta name="keywords" content="<?php bloginfo('name'); ?>,greenhouse project development, komunitas greenboxindonesia, greenbox komunitas, green community, Our community base">
	<meta name="description" content="">
	<meta name="author" content="<?php bloginfo('name'); ?>">
	<meta name="copyright" content="<?php bloginfo('name'); ?>">
	<meta name="robots" content="index, follow">
	<meta http-equiv="content-type" content="text/html;UTF-8">
	<meta http-equiv="cache-control" content="cache">
	<meta http-equiv="content-language" content="id">
	<meta property="og:description" 
  	content="Greenboxindonesia Gallery Project Base" />

   	<title><?php wp_title('|', true, 'right'); ?></title>
   	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
   	<link rel="shortcut icon" href="<?php echo get_option('greenhouse_favicon'); ?>">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<!--load file css and JS on folder plugin -->

	<link href="<?php echo get_template_directory_uri();?>/assets/asset/styles-demo.css" rel="stylesheet" media="all">   
	<script src="<?php echo get_template_directory_uri();?>/assets/asset/jquery.min.js"></script>  

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>  data-spy="scroll" data-target=".bs-docs-sidebar" data-offset="10">
<!-- SDK Facebook -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/all.js#xfbml=1&appId=182576108483009";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- End off -->
	<div id="switcher">
		<div class="inner-switcher">
			<div id="theme_list">
				<a href="<?php echo home_url('/'); ?>">
				<img class="switcher-logo" src="<?php echo get_template_directory_uri();?>/assets/asset/gb.png" alt="logo">
				</a>
				<div class="clear"></div>
			</div>	
			<div id="command_button">
				<div class="purchase">
					<a href="<?php echo esc_html( get_post_meta( get_the_ID(), 'urlpost', true ) ); ?>">Purchase</a>
				</div>		
				<div class="remove_frame">
					<a href="<?php echo esc_html( get_post_meta( get_the_ID(), 'urlwebsite', true ) ); ?>">Remove Frame</a>
				</div>	
				<div class="clear"></div>				
			</div>
			<div class="clear"></div>
		</div>
	</div>
    <iframe id="iframe" src="<?php echo esc_html( get_post_meta( get_the_ID(), 'urlwebsite', true ) ); ?>" frameborder="0" width="100%" height="635px"></iframe>
<?php wp_reset_query(); ?>
