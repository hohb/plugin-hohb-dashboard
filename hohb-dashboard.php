<?php

/*
Plugin Name: HoHB Dashboard
Plugin URI: http://www.homeofhappybrands.nl
Description: Home of Happy Brands Dashboard Theme
Author: Home of Happy Brands
Version: 1.0
Author URI: http://www.homeofhappybrands.nl
*/

function hohb_admin_theme_style() {
    wp_enqueue_style('hohb-admin-theme', plugins_url('wp-admin.css', __FILE__), array('dashicons'));
}
add_action('admin_enqueue_scripts', 'hohb_admin_theme_style');

function hohb_enqueue() {
	wp_register_script('dashjs', plugins_url( '/js/dashboard.js', __FILE__ ), array( 'jquery'));
	wp_enqueue_script( 'dashjs');
}
add_action( 'admin_enqueue_scripts', 'hohb_enqueue' );

// Change the Avatar size in admin bar
function hohb_update_avatar_size( $wp_admin_bar ) {

    $user_id      = get_current_user_id();
    $current_user = wp_get_current_user();

    if ( ! $user_id )
        return;
	
	// I'm India so my timezone is Asia/Calcutta
	date_default_timezone_get();
	
	// 24-hour format of an hour without leading zeros
	$hour = date('G');
	$msg = "";
	
	if ( $hour >= 5 && $hour <= 11 ) {
	    $msg = "Goedemorgen";
	} else if ( $hour >= 12 && $hour <= 18 ) {
	    $msg = "Goedemiddag";
	} else if ( $hour >= 19 || $hours <= 4 ) {
	    $msg = "Goedenavond";
	}

    $avatar = get_avatar( $user_id, 45 );
    $howdy  = sprintf( __('<span id="gday">'. $msg .',</span> %1$s'), $current_user->display_name );

    $account_node = $wp_admin_bar->get_node( 'my-account' );

    $title = '<div id="hohb-hello">' . $howdy . '</div><div id="hohb-av">' . $avatar . '</div>' ;
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $title
    ) );

}
add_action( 'admin_bar_menu', 'hohb_update_avatar_size', 999 );


function hohb_tweaked_admin_bar() {
	global $wp_admin_bar;

	//Remove standars items
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('site-name');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('avia');
	
}
add_action( 'wp_before_admin_bar_render', 'hohb_tweaked_admin_bar' );

function hohb_adminbar_node($wp_admin_bar){
    $dash_args = array(
        'id' => 'dashboard-link',
        'title' => 'Dashboard',
        'href' => admin_url(),
        'meta' => array(
            'class' => 'dashboard-link'
        )
    );

    $wp_admin_bar->add_node($dash_args);	
}

add_action('admin_bar_menu', 'hohb_adminbar_node', 10);


function hohb_adminbar_link($wp_admin_bar) {
	$hohb_args = array(
	    'id' => 'hohb-link',
	    'title' => get_bloginfo('name'),
	    'href' => get_bloginfo('url'),
	    'meta' => array(
	        'class' => 'our-link'
	    )
	);
	$wp_admin_bar->add_node($hohb_args);
}
add_action('admin_bar_menu', 'hohb_adminbar_link', 20);


// CHANGE LOGO LINK AND TITLE TO SITE TITLE AND HOME URL
function custom_login_url($url) {
	return get_bloginfo('url');
}
add_filter('login_headerurl', 'custom_login_url');

function custom_login_title() {
	return get_option('blogname');
}
add_filter('login_headertitle', 'custom_login_title');

// LOAD STYLESHEETS FOR CUSTOM LOGIN
function hohb_custom_login() {
	
	$files = '<link rel="stylesheet" href="'.plugins_url( 'login.css' , __FILE__ ).'" />';
	$files .= '<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>';
	$files .= '<script src="'.plugins_url( 'js/login.js' , __FILE__ ).'"></script>';
	
	echo $files;
}
add_action('login_head', 'hohb_custom_login');

function hohb_footer_admin () {
	
	echo '<span id="footer-thankyou">Leuk dat je er bent!  <a href="http://www.homeofhappybrands.nl">Home of Happy Brands</a></span>';
	
}
add_filter('admin_footer_text', 'hohb_footer_admin');

?>