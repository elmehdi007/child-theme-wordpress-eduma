<?php

function thim_child_enqueue_styles() {
	if ( is_multisite() ) {
		wp_enqueue_style( 'thim-child-style', get_stylesheet_uri() );
	} else {
		wp_enqueue_style( 'thim-parent-style', get_template_directory_uri() . '/style.css' );
	}
}


add_action( 'wp_enqueue_scripts', 'thim_child_enqueue_styles', 100 );
// this function to add new currency to LearnPress settings


/**add_filter( 'learn_press_get_payment_currencies', 'add_new_currency' );
function add_new_currency( $currencies ) {
    $currencies['MAD'] = 'MAD';
    return $currencies;
}**/

 function thim_add_learnpress_currency( $currencies ) {
    $currencies['MAD'] = 'Morocco DH';
    return $currencies;
}

add_filter( 'learn_press_get_payment_currencies', 'thim_add_learnpress_currency' );

function thim_new_learnpress_currency_symbol( $currency_symbol, $currency ) {
if ( $currency == 'MAD' ) {
    $currency_symbol = 'MAD';
}
    return $currency_symbol;
}

add_filter( 'learn_press_currency_symbol', 'thim_new_learnpress_currency_symbol', 10, 2 );

//


add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'MAD': $currency_symbol = 'MAD'; break;
     }
     return $currency_symbol;
}

// This theme uses wp_nav_menu() in one location.
add_action( 'after_setup_theme', 'reg_mobile_menu' );
function reg_mobile_menu(){
		register_nav_menus( array(
			'primary-menu-mobile' => esc_html__( 'Menu Mobile', 'eduma' ),
		) );
}

// Hook in
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );
// Our hooked in function - $address_fields is passed via the filter!
function custom_override_default_address_fields( $address_fields ) {
     $address_fields['postcode']['required'] = false;

     return $address_fields;
}
	
	
//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');
