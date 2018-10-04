<?php

	/*  Redirect To Theme Options Page on Activation  */
	if (is_admin() && isset($_GET['activated'])) {
	    wp_redirect(admin_url('themes.php'));
	}

	/*  Load custom admin scripts & styles  */
	function autozone_load_custom_wp_admin_style()	{
		wp_enqueue_media();

		wp_register_script( 'autozone_custom_wp_admin_script', get_template_directory_uri() . '/js/custom-admin.js', array( 'jquery' ) );
	    wp_localize_script( 'autozone_custom_wp_admin_script', 'meta_image',
	        array(
	            'title' => esc_html__( 'Choose or Upload an Image', 'autozone' ),
	            'button' => esc_html__( 'Use this image', 'autozone' ),
	        )
	    );
	    wp_enqueue_script( 'autozone_custom_wp_admin_script' );
	    wp_enqueue_style('autozone-custom', get_template_directory_uri() . '/css/custom-admin.css');

	    // Add the color picker css file
	    wp_enqueue_style( 'wp-color-picker' );
	    // Include our custom jQuery file with WordPress Color Picker dependency
	    wp_enqueue_script( 'autozone-color', get_template_directory_uri() . '/js/custom-script.js', array( 'wp-color-picker' ), false, true );
	}

	function autozone_add_editor_styles() {
		add_editor_style( 'autozone-editor-style.css' );
	}

	add_filter('login_headerurl', create_function('', "return get_home_url('/');"));
	add_filter('login_headertitle', create_function('', 'return false;'));
	add_action('admin_enqueue_scripts', 'autozone_load_custom_wp_admin_style');
	add_action('admin_init', 'autozone_add_editor_styles' );


	/* Admin Panel */
	require_once(get_template_directory() . '/library/core/admin/admin-panel.php');
	require_once(get_template_directory() . '/library/core/admin/class-tgm-plugin-activation.php');
	require_once(get_template_directory() . '/library/core/admin/post-fields.php');
	require_once(get_template_directory() . '/library/core/admin/functions.php');

	// @package Authorship Permalink - These hooks target authorship and changes the permalink
	// This Changes the Author URL
	add_filter( 'request', 'changeAuthURL' );
	function changeAuthURL( $query_vars )
	{
	    if ( array_key_exists( 'author_name', $query_vars ) ) {
	        global $wpdb;
	        $author_id = $wpdb->get_var( $wpdb->prepare( "SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key='nickname' AND meta_value = %s", $query_vars['author_name'] ) );
	        if ( $author_id ) {
	            $query_vars['author'] = $author_id;
	            unset( $query_vars['author_name'] );
	        }
	    }
	    return $query_vars;
	}
	// This filters the author link and replacing the standard author part
	add_filter( 'author_link', 'filterLink', 10, 3 );
function filterLink( $link, $author_id, $author_nicename )
{
    $author_nickname = get_user_meta( $author_id, 'nickname', true );
    if ( $author_nickname ) {
        $link = str_replace( $author_nicename, $author_nickname, $link );
    }
    return $link;
}
// Changes the data that forms the Author URL
add_action( 'user_profile_update_errors', 'authorNiceName', 10, 3 );
function authorNiceName( &$errors, $update, &$user )
{
    if ( ! empty( $user->nickname ) ) {
        $user->user_nicename = sanitize_title( $user->nickname, $user->display_name );
    }
}


?>
