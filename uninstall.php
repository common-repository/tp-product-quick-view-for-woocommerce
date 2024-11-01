<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       www.tplugins.com
 * @since      1.0.0
 *
 * @package    Tp_Product_Quick_View_For_Woocommerce
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'tppqw_width' );
delete_option( 'tppqw_height' );
delete_option( 'tppqw_show_on_mobile' );
delete_option( 'tppqw_ajax_add_to_cart' );
delete_option( 'tppqw_button_type' );
delete_option( 'tppqw_button_label', 'Quick View' );
delete_option( 'tppqw_more_details_label' );
delete_option( 'tppqw_more_details_color' );
delete_option( 'tppqw_more_details_background' );
delete_option( 'tppqw_button_position' );
delete_option( 'tppqw_show_gallery' );
delete_option( 'tppqw_change_thumbnail_by' );
delete_option( 'tppqw_infinite_loop' );
delete_option( 'tppqw_close_lightbox' );
delete_option( 'tppqw_title_position' );
delete_option( 'tppqw_title_background' );
delete_option( 'tppqw_title_color' );
delete_option( 'tppqw_related_products' );
delete_option( 'tppqw_crousel_items_width' );
delete_option( 'tppqw_crousel_item_margin' );
delete_option( 'tppqw_crousel_animation_loop' );
delete_option( 'tppqw_show_share_buttons' );
delete_option( 'tppqw_share_buttons' );
delete_option( 'tppqw_related_products_titel' );
delete_option( 'tppqw_related_products_titel_text_align' );
delete_option( 'tppqw_product_fields_to_show' );
delete_option( 'tppqw_product_quantity_type' );
delete_option( 'tppqw_button_position_priority' );
delete_option( 'tppqw_qw_font_size' );
delete_option( 'tppqw_qw_color' );
delete_option( 'tppqw_qw_background' );
delete_option( 'tppqw_sale_font_size' );
delete_option( 'tppqw_sale_color' );
delete_option( 'tppqw_sale_background' );
delete_option( 'tppqw_custom_css' );
delete_option( 'tppqw_addtocart_background' );
delete_option( 'tppqw_addtocart_color' );
delete_option( 'tppqw_loading_color' );