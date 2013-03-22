<?php

class Front_To_Back extends WP_Widget {

/* 
	Plugin Name: Front To Back
	Plugin URI: http://www.brwebdesign.net
	Description: Front to Back, how to build a wordpress widget.
	Version: 1.0
	Author: Michael Soileau
	Author URI: http://www.brwebdesign.net
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

	function __construct(){
		
		/*	add_action( 'init', array( $this, 'widget_textdomain') ); Add in when using internationalization*/



		parent::__construct('front-to-back',

			__( 'Front To Back', 'front-to-back'),
			'Front To Back',
			array(
				'classname' => 'front-to-back',
				'description' => 'Front to Back does some stuff', 'front-to-back'
			)
		); 
		// Register the Stylesheets
		add_action('admin_print_styles', array( $this, 'register_admin_styles') );
		add_action( 'wp_enqueue_scripts', array($this, 'register_widget_styles') );
		// Register the Javascript
		add_action('admin_enqueue_scripts', array( $this, 'register_admin_scripts') );
		add_action( 'wp_enqueue_scripts', array($this, 'register_widget_scripts') );
	}	

	function form ($instance){

		$instance = wp_parse_args(
			(array)$instance,
			array(
				'name' => ''
			)
		);


		// Create views for what the widget displays when loaded in.
		include( plugin_dir_path( __FILE__ ) . '/views/admin.php');
	}

	
	function widget ( $args, $instance){
		// Args from the theme.
		// Instance of the class.
		extract($args, EXTR_SKIP );
		$title = ( $instance['title']) ? $instance['title'] : "Front to Back";
		$body = ( $instance['body']) ? $instance['body'] : "A test widget";
		echo $before_widget;
		echo $before_title . $title . $after_title;
		echo $body;
	}
	function update( $new_instance, $old_instance){
		// Working with Serialization
		$old_instance['name'] = $new_instance['name'];
		$old_instance['title'] = $new_instance['title'];
		$old_instance['body'] = $new_instance['body'];
		return $old_instance;

	}

/*	function widget_textdomain(){
		load_plugin_textdomain( 'front-to-back', false, $plugin_dir_path(__FILE__) . '/lang/' );
	}
Po Edit for internationalization */
	function register_admin_styles(){
		wp_enqueue_style( 'front-to-back-admin', plugins_url( 'front-to-back/css/admin.css' ));

	}
	function register_widget_styles(){
		wp_enqueue_style( 'front-to-back-widget', plugins_url( 'front-to-back/css/widget.css') );
	}
	function register_admin_scripts(){
		wp_enqueue_style( 'front-to-back-admin', plugins_url( 'front-to-back/js/admin.js' ));

	}
	function register_widget_scripts(){
		wp_enqueue_style( 'front-to-back-widget', plugins_url( 'front-to-back/js/widget.js') );
	}


}
// Register the widget outside the new Class.
add_action( 'widgets_init', create_function('', 'register_widget( "Front_To_Back" );') );
