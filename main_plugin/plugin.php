<?php 
/* 
Plugin Name: Comment to e-mail
Plugin URI: http://www.brwebdesign.net
Description: This plugin will e-mail comments.
Author: Michael Soileau
Version: 1.0
Author URI: http://www.brwebdesign.net/

*/
global $wp_version;

if ( !version_compare($wp_version, "3.0", ">=")){
	die("You need at least version 3.0");}


function my_plugin_activation(){
	// Code to run on activation.
}

function my_plugin_deactivation(){
	// On deactivation
}

function brweb_cc_comment(){
	global $_REQUEST;
	$to = "webart.video@gmail.com";
	$subject = "New comment posted @ yourblog " . $_REQUEST['subject'];
	$message = "Message from: " . $_REQUEST['name'] . " at email " . $_REQUEST['email'] . ": \n " . $_REQUEST['comments'];
	wp_mail($to,$subject,$message);
}

function brweb_add_content_watermark ( $content ){
	// This is a filter.
	if ( is_feed() ){
		return $content . 'Created by Michael Soileau' . date('Y') . 'all rights reserved.';
	}
	else{
		return $content;
	}
}

function brweb_option_page(){
	

	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2>CC Comments Options</h2>
		<p>Welcome to the CC Comments plugin.  Here you can edit the email to your comments.</p>
	
	<form action="options.php" method="post" id="brweb-comments-email-options-form">
	<?php settings_fields('brweb_options'); ?>
		<h3><label for="brweb_cc_email">Email to send CC to:</label>
	<input type="text" id="brweb_cc_email" name="brweb_cc_email" 
	value="<?php echo esc_attr(get_option('brweb_cc_email')); ?>"	/>
	</h3>
	<input type="submit" name="submit" value="Submit form" />	

	</form>
	</div>

	<?php
}

function brweb_plugin_menu(){
	add_options_page( "CC Comments Settings", "CC Comments", 'manage_options', 'brweb-comments-plugin', 'brweb_option_page' );
// add_dashboard, add_media, add_post, add_themes, add_links, add_users, add_plugins, add_dashboard_page

}

function brweb_init(){
	register_setting('brweb_options', 'brweb_cc_comment');
// Add in a sanitation check here.
}
add_action('admin_init', 'brweb_init');



add_action('admin_menu', 'brweb_plugin_menu');

register_activation_hook(__FILE__, "my_plugin_activation");

register_deactivation_hook(__FILE__, "my_plugin_deactivation");

add_action('comment_post', 'email_comment');


add_filter('the_content', 'brweb_add_content_watermark');

//remove_filter('the_content', 'brweb_add_content_watermark');