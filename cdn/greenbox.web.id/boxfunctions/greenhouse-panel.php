<?php
/**
 * Name: Panel Profile
 * GitHub URI: https://github.com/greenboxindonesia
 * Description: Panel Framework
 * Author: Albert Sukmono
 * Twitter: @greenbox_id
 * Author website: http://www.greenboxindonesia.com
 */

require_once( trailingslashit( get_template_directory() ) . 'boxfunctions/urlproject/urlproject.php'); // load post type urldemo site
require_once( trailingslashit( get_template_directory() ) . 'boxfunctions/projectbase/projectbase.php'); // load post type projectbase
require_once( trailingslashit( get_template_directory() ) . 'boxfunctions/client/client.php'); // load post type client management
require_once( trailingslashit( get_template_directory() ) . 'boxfunctions/gallery/gallery.php'); // load post type client management
require_once( trailingslashit( get_template_directory() ) . 'boxfunctions/widgets/widget-brochure-box.php'); // load post type client management

/*---------------------------------------------------
register settings
----------------------------------------------------*/
function theme_settings_init(){
register_setting( 'theme_settings', 'theme_settings' );
wp_enqueue_style("panel_style", get_template_directory_uri()."/boxfunctions/panel/css/panel.css", false, "1.0", "all");
wp_enqueue_script("panel_script", get_template_directory_uri()."/boxfunctions/panel/js/panel_script.js", false, "1.0");
}
 
/*---------------------------------------------------
add settings page to menu
----------------------------------------------------*/
function add_settings_page() {
add_menu_page( __( 'Green Panel' .' Beta' ), __( 'Green' .' Panel' ), 'manage_options', 'settings', 'theme_settings_page');
}
 
/*---------------------------------------------------
add actions
----------------------------------------------------*/
add_action( 'admin_init', 'theme_settings_init' );
add_action( 'admin_menu', 'add_settings_page' );

/* ----------------------------------------------------------
Declare vars
-----------------------------------------------------------*/
$themename = "Greenhouse Beta";
$shortname = "greenhouse";
 
$categories = get_categories('hide_empty=0&orderby=name');
$wp_getcat = array();
foreach ($categories as $category_item ) {
$wp_getcat[$category_item->cat_ID] = $category_item->cat_name;
}
array_unshift($wp_getcat, "Select a category");

/*----------------------------------------------------------
Declare vars for cat post type
-----------------------------------------------------------*/
$categories = get_categories('taxonomy=projectbase');
$getcat_projectbase = array();
foreach ($categories as $category_item ) {
$getcat_projectbase[$category_item->cat_ID] = $category_item->cat_name;
}
array_unshift($getcat_projectbase, "Select a category");

/* ---------------------------------------------------------
Declare options
----------------------------------------------------------- */
 
$theme_options = array (
 
array( "name" => $themename." Options",
"type" => "title"),
 
/* ---------------------------------------------------------
General section
----------------------------------------------------------- */
array( "name" => "General",
"type" => "section"),
array( "type" => "open"),
 
array(	"name" => "Header Logo",
"desc" => "Use Custom Header Logo  Must <b>(32X32px)</b> On The Top Header?<br /><em>*Disable by default, Choose Yes to enable it.</em>",
"id" => $shortname."_header_logo_activate",
"type" => "select",
"std" => "No",
"options" => array("No", "Yes")),

array(	"name" => "Header Logo URL",
"desc" => "Insert The Full URL Location Of Your Header Logo Here <br /><em>*leave blank if not use</em>",
"id" => $shortname."_header_logo_url",
"type" => "text",
"std" => "https://e3377e01d4421b3c3f9b15592a72ecefdbd3680c.googledrive.com/host/0B3rJx3lThGYPflBFS1duSHdBRndtZDRwTDJBUXozX2dsWXI1NU1oMTR6MVp6VEN1WV9rYlE/greenbox.web.id/img/logo_small_header.png"
),

array( "name" => "Custom Favicon",
"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico or .png image that you want to use as the image",
"id" => $shortname."_favicon",
"type" => "text",
"std" => "https://e3377e01d4421b3c3f9b15592a72ecefdbd3680c.googledrive.com/host/0B3rJx3lThGYPflBFS1duSHdBRndtZDRwTDJBUXozX2dsWXI1NU1oMTR6MVp6VEN1WV9rYlE/greenbox.web.id/ico/favicon.png"
),
 
array( "type" => "close"),
 
/* ---------------------------------------------------------
Home section
----------------------------------------------------------- */
array( "name" => "Homepage",
"type" => "section"),
array( "type" => "open"),

// Just Title Recent Last Projectbase Post Type non select Category
array( "name" => "Title Recent Projectbase",
"desc" => "Setting for Title Recent Projectbase",
"id" => $shortname."_title_projectbase",
"type" => "text",
"std" => "Recent Projectbase",
),

// Recent Multiple Feed Rss From Community Site
array( "name" => "Title Multiple Feed Rss Community",
"desc" => "Setting for Title Multiple Feed Rss Community",
"id" => $shortname."_title_multiplefeedrss_community",
"type" => "text",
"std" => "Conected Community Update",
),
array( "name" => "URL Multiple Feed Rss Community",
"desc" => "Add URL Multiple Feed Rss, if more than one give comma for each url input",
"id" => $shortname."_url_multiplefeedrss_community",
"type" => "textarea",
"std" => "",
),
array( "name" => "How Much Post to Show on Multiple Feed Rss Community",
"desc" => "Setting how much post to show limited from each url Feed RSS Community",
"id" => $shortname."_show_multiplefeedrss_community",
"type" => "text",
"std" => "10",
),

// Recent Multiple Feed Rss From Client Site Area
array( "name" => "Title Multiple Feed Rss Clients",
"desc" => "Setting for Title Multiple Feed Rss Clients",
"id" => $shortname."_title_multiplefeedrss_client",
"type" => "text",
"std" => "Conected WIth Client Update",
),
array( "name" => "URL Multiple Feed Rss Clients",
"desc" => "Add URL Multiple Feed Rss, if more than one give comma for each url input",
"id" => $shortname."_url_multiplefeedrss_client",
"type" => "textarea",
"std" => "",
),
array( "name" => "How Much Post to Show on Multiple Feed Rss Clients",
"desc" => "Setting how much post to show limited from each url Feed RSS Clients",
"id" => $shortname."_show_multiplefeedrss_client",
"type" => "text",
"std" => "5",
),
array( "name" => "Limited Description Content on Multiple Feed Rss Clients",
"desc" => "Setting how much description content to show from each url Feed RSS Clients",
"id" => $shortname."_desc_multiplefeedrss_client",
"type" => "text",
"std" => "100",
),

// Recent Last Development Post
array( "name" => "Title Recent Development",
"desc" => "You can customize Title Header on top header area her.",
"id" => $shortname."_title_recent_development",
"type" => "text",
"std" => "Recent Development",
),
array( "name" => "Recent Development Category",
"desc" => "Choose a category for Recent Development Post",
"id" => $shortname."_recent_development",
"type" => "select",
"options" => $wp_getcat,
"std" => "Select a category",
),
array( "name" => "Show Recent Development Post",
"desc" => "Show how much to recent development post",
"id" => $shortname."_recent_development_post",
"type" => "text",
"std" => "15",
),

// GCal Event Plugin - Title and Shortcode
array( "name" => "Title Kalender Event",
"desc" => "Title Plugin Google Calendar Event",
"id" => $shortname."_title_gcalendar",
"type" => "text",
"std" => "",
),
array( "name" => "Shortcode Kalender Event",
"desc" => "Shortcode Plugin Google Calendar Event",
"id" => $shortname."_sc_gcalendar",
"type" => "text",
"std" => ""
),

// Easy Option Plugin - Left Title and Shortcode
array( "name" => "Title Easy Option Kiri",
"desc" => "Title Easy Option Plugin on the Left",
"id" => $shortname."_easyoptions_kiri",
"type" => "text",
"std" => "",
),
array( "name" => "Shortcode Easy Option Kiri",
"desc" => "Shortcode Easy Option Plugin on the Left",
"id" => $shortname."_sc_easyoptions_kiri",
"type" => "text",
"std" => ""
),

// Easy Option Plugin - Right Title and Shortcode
array( "name" => "Title Easy Option Kanan",
"desc" => "Title Easy Option Plugin on the Right",
"id" => $shortname."_easyoptions_kanan",
"type" => "text",
"std" => "",
),
array( "name" => "Shortcode Easy Option Kanan",
"desc" => "Shortcode Easy Option Plugin on the Right",
"id" => $shortname."_sc_easyoptions_kanan",
"type" => "text",
"std" => ""
),

array( "type" => "close"),
 
/* ---------------------------------------------------------
Footer section
----------------------------------------------------------- */
array( "name" => "Footer Feed RSS",
"type" => "section"),
array( "type" => "open"),

array( "name" => "Running Text Rss Footer", "desc" => "Running Text Ticker Rss Footer", "id" => $shortname."_ticker", "type" => "text", "std" => ""),

array( "name" => "Judul Footer Satu", "desc" => "Judul Footer Satu", "id" => $shortname."_judul_satu", "type" => "text", "std" => ""),
array( "name" => "Rss Footer Satu", "desc" => "Rss Footer Satu", "id" => $shortname."_feed_satu", "type" => "text", "std" => ""),

array( "name" => "Judul Footer Dua", "desc" => "Judul Footer Dua", "id" => $shortname."_judul_dua", "type" => "text", "std" => ""),
array( "name" => "Rss Footer Satu", "desc" => "Rss Footer Dua", "id" => $shortname."_feed_dua", "type" => "text", "std" => ""),

array( "name" => "Judul Footer Satu", "desc" => "Judul Footer Tiga", "id" => $shortname."_judul_tiga", "type" => "text", "std" => ""),
array( "name" => "Rss Footer Satu", "desc" => "Rss Footer Tiga", "id" => $shortname."_feed_tiga", "type" => "text", "std" => ""),

array( "name" => "Judul Footer Satu", "desc" => "Judul Footer Empat", "id" => $shortname."_judul_empat", "type" => "text", "std" => ""),
array( "name" => "Rss Footer Satu", "desc" => "Rss Footer Empat", "id" => $shortname."_feed_empat", "type" => "text", "std" => ""),

array( "type" => "close"),

/*---------------------------------------------------------
Social Media
---------------------------------------------------------*/
array( "name" => "Social Media",
"type" => "section"), 
array( "type" => "open"),
	
array( "name" => "Facebook Page",
"desc" => "Insert The Full URL Location Of Your Social Account <br /><em>*leave blank if not use</em>",
"id" => $shortname."_facebook", "type" => "text", "std" => "http://www.facebook.com/greenboxindonesia"),

array( "name" => "Google Plus",
"desc" => "Insert The Full URL Location Of Your Social Account <br /><em>*leave blank if not use</em>",
"id" => $shortname."_googleplus", "type" => "text", "std" => "https://plus.google.com/+GreenboxindonesiaMalang"),

array( "name" => "Twitter",
"desc" => "Insert The Full URL Location Of Your Social Account <br /><em>*leave blank if not use</em>",
"id" => $shortname."_twitter", "type" => "text", "std" => "http://www.twitter.com/greenbox_id"),
	 
array( "type" => "close"),

/*---------------------------------------------------------
Video Youtube
---------------------------------------------------------*/
array( "name" => "Video Youtube",
"type" => "section"), 
array( "type" => "open"),
	
array( "name" => "Title Video",
"desc" => "You can customize Title of Video.",
"id" => $shortname."_title_video_text",
"type" => "text",
"std" => "Dokumentasi",
),

array( "name" => "Embed Video Code",
"desc" => "This code will be show as map picture at homepage. To get the code visit <a href='https://maps.google.com/' target='_blank'>Google Maps</a>",
"id" => $shortname."_video",
"type" => "textarea",
"std" => "<iframe width='560' height='315' src='//www.youtube.com/embed/j8cKdDkkIYY' frameborder='0' allowfullscreen></iframe>"
),
	 
array( "type" => "close"),

/*---------------------------------------------------------
Google Maps
---------------------------------------------------------*/
array( "name" => "Google Maps",
"type" => "section"), 
array( "type" => "open"),
	
array( "name" => "Title Google Maps",
"desc" => "You can customize Title on Maps Picture at homepage.",
"id" => $shortname."_title_maps_text",
"type" => "text",
"std" => "Location",
),

array( "name" => "Google Maps Code",
"desc" => "This code will be show as map picture at homepage. To get the code visit <a href='https://maps.google.com/' target='_blank'>Google Maps</a>",
"id" => $shortname."_maps",
"type" => "textarea",
"std" => ""
),
	 
array( "type" => "close"),

/*---------------------------------------------------------
Google Analytics
---------------------------------------------------------*/
array( "name" => "Google Analytics",
"type" => "section"), 
array( "type" => "open"),
	
array( "name" => "Google Analytic Code",
"desc" => "This code will be added to the footer before the &lt;/body&gt; closing tag. To get the code visi <a href='https://www.google.com/analytics/' target='_blank'>Google Analytics</a>",
"id" => $shortname."_analytics",
"type" => "textarea",
"std" => "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45610612-5', 'greenbox.web.id');
  ga('send', 'pageview');

</script>"
),
	 
array( "type" => "close"),
/*---------------------------------------------------------
Overview Organizations
---------------------------------------------------------*/
array( "name" => "Overview Organizations",
"type" => "section"), 
array( "type" => "open"),
	
array( "name" => "Office Picture",
"desc" => "Insert The Full URL Location Of Your Office Picture Here size <b>width:370px height:auto</b><br /><em>*leave blank if not use</em>",
"id" => $shortname."_office_picture_url",
"type" => "text",
"std" => "https://e3377e01d4421b3c3f9b15592a72ecefdbd3680c.googledrive.com/host/0B3rJx3lThGYPflBFS1duSHdBRndtZDRwTDJBUXozX2dsWXI1NU1oMTR6MVp6VEN1WV9rYlE/greenbox.web.id/img/greenbox_sidebar.png"
),

array( "name" => "Short Description Organization",
"desc" => "This text will view on sidebar archive pengurus",
"id" => $shortname."_decription",
"type" => "textarea",
"std" => "Tincidunt diam, proin in ac dignissim a lundium dignissim ultricies lorem elit amet mauris, pellentesque augue urna nunc diam nec pellentesque nunc habitasse, nec nec lacus, dapibus lundium augue sed platea cras, sed, parturient pid natoque, natoque ultricies nec enim tortor tempor, pulvinar magna, dapibus adipiscing, adipiscing"
),
	 
array( "type" => "close"),

);

/*-------------------------------------------------------
Added custom link social network for author in backend
---------------------------------------------------------*/
function my_new_contactmethods( $contactmethods ) {
// Add Twitter
$contactmethods['twitter'] = 'Twitter';
//add Facebook
$contactmethods['facebook'] = 'Facebook';
//Add Google Plus
$contactmethods['googleplus'] = 'Google Plus';

return $contactmethods;
}
add_filter('user_contactmethods','my_new_contactmethods',10,1);
// end off top scripth

/* ------------------------------------------------------------------------------------
Load activated for post type multi image metabox library
------------------------------------------------------------------------------------ */
add_filter('images_cpt','my_image_cpt');
function my_image_cpt(){
$cpts = array('post','page','gallery','projectbase','client');
return $cpts;
}

add_filter('list_images','my_list_images',10,2);
function my_list_images($list_images, $cpt){
    global $typenow;
    if($typenow == "gallery" || $cpt == "gallery" || $cpt == "projectbase" || $cpt == "client" )
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
        );
    return $picts;
}
//end load library multi image metabox

/*---------------------------------------------------
Theme Panel Output
----------------------------------------------------*/
function theme_settings_page() {
    global $themename,$theme_options;
    $i=0;
    $message=''; 
    if ( 'save' == $_REQUEST['action'] ) {
      
        foreach ($theme_options as $value) {
            update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
      
        foreach ($theme_options as $value) {
            if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
        $message='saved';
    }
    else if( 'reset' == $_REQUEST['action'] ) {
          
        foreach ($theme_options as $value) {
            delete_option( $value['id'] ); }
        $message='reset';        
    }
  
    ?>
    <div class="wrap options_wrap">
        <div id="icon-options-general"></div>
        <h2><?php _e( ' Framework Panel Greenhouse ' ) //your admin panel title ?></h2>
        <?php
        if ( $message=='saved' ) echo '<div class="updated settings-error" id="setting-error-settings_updated"> 
        <p>'.$themename.' settings saved.</strong></p></div>';
        if ( $message=='reset' ) echo '<div class="updated settings-error" id="setting-error-settings_updated"> 
        <p>'.$themename.' settings reset.</strong></p></div>';
        ?>
        <ul>
            <li>View Documentation |</li>
            <li>Visit Support |</li>
            <li>Theme version 1.0 </li>
        </ul>
        <div class="content_options">
            <form method="post">
  
            <?php foreach ($theme_options as $value) {
          
                switch ( $value['type'] ) {
              
                    case "open": ?>
                    <?php break;
                  
                    case "close": ?>
                    </div>
                    </div><br />
                    <?php break;
                  
                    case "title": ?>
                    <div class="message">
                        <p>To easily use the <?php echo $themename;?> theme options, you can use the options below.</p>
                    </div>
                    <?php break;
                  
                    case 'text': ?>
                    <div class="option_input option_text">
                    <label for="<?php echo $value['id']; ?>">
                    <?php echo $value['name']; ?></label>
                    <input id="" type="<?php echo $value['type']; ?>" name="<?php echo $value['id']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
                    <small><?php echo $value['desc']; ?></small>
                    <div class="clearfix"></div>
                    </div>
                    <?php break;
                  
                    case 'textarea': ?>
                    <div class="option_input option_textarea">
                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                    <textarea name="<?php echo $value['id']; ?>" rows="" cols=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
                    <small><?php echo $value['desc']; ?></small>
                    <div class="clearfix"></div>
                    </div>
                    <?php break;
                  
                    case 'select': ?>
                    <div class="option_input option_select">
                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                    <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                    <?php foreach ($value['options'] as $option) { ?>
                            <option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option>
                    <?php } ?>
                    </select>
                    <small><?php echo $value['desc']; ?></small>
                    <div class="clearfix"></div>
                    </div>
                    <?php break;
                  
                    case "checkbox": ?>
                    <div class="option_input option_checkbox">
                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                    <?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
                    <input id="<?php echo $value['id']; ?>" type="checkbox" name="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> /> 
                    <small><?php echo $value['desc']; ?></small>
                    <div class="clearfix"></div>
                    </div>
                    <?php break;
                  
                    case "section": 
                    $i++; ?>
                    <div class="input_section">
                    <div class="input_title">
                         
                        <h3><img src="https://e3377e01d4421b3c3f9b15592a72ecefdbd3680c.googledrive.com/host/0B3rJx3lThGYPflBFS1duSHdBRndtZDRwTDJBUXozX2dsWXI1NU1oMTR6MVp6VEN1WV9rYlE/greenbox.web.id/img/setting.png" alt="">&nbsp;<?php echo $value['name']; ?></h3>
                        <span class="submit"><input name="save<?php echo $i; ?>" type="submit" class="button-primary" value="Save changes" /></span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="all_options">
                    <?php break;
                     
                }
            }?>
          <input type="hidden" name="action" value="save" />
          </form>
          <form method="post">
              <p class="submit">
              <input name="reset" type="submit" value="Reset" />
              <input type="hidden" name="action" value="reset" />
              </p>
          </form>
        </div>
        <div class="footer-credit">
            <p>© Create by <a title="Greenhouse Project" href="http://www.greenboxindonesia.com" target="_blank" >Greenboxindonesia</a> |  News & Update Development on <a title="Greenhouse Project" href="http://news.greenbox.web.id" target="_blank" >Our Blog</a></p>
        </div>
    </div>
    <?php
}
?>
