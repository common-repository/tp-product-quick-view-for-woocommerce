<?php

/**
 * Fired during plugin activation
 *
 * @link       www.tplugins.com
 * @since      1.0.0
 *
 * @package    Tp_Product_Quick_View_For_Woocommerce
 * @subpackage Tp_Product_Quick_View_For_Woocommerce/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Tp_Product_Quick_View_For_Woocommerce
 * @subpackage Tp_Product_Quick_View_For_Woocommerce/includes
 * @author     TP Plugins <pluginstp@gmail.com>
 */
class Tp_Product_Quick_View_For_Woocommerce_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_option( 'tppqw_width', '' );
		add_option( 'tppqw_height', '' );
		add_option( 'tppqw_show_on_mobile', 1 );
		add_option( 'tppqw_ajax_add_to_cart', 1 );
		add_option( 'tppqw_button_type', 'text' );
		add_option( 'tppqw_button_label', 'Quick View' );
		add_option( 'tppqw_more_details_label', 'More Details' );
		add_option( 'tppqw_more_details_color', '#000' );
		add_option( 'tppqw_more_details_background', '' );
		add_option( 'tppqw_button_position', 'woocommerce_after_shop_loop_item.10' );
		add_option( 'tppqw_show_gallery', 1 );
		add_option( 'tppqw_change_thumbnail_by', 'onmouseover' );
		add_option( 'tppqw_infinite_loop', 0 );
		add_option( 'tppqw_close_lightbox', 1 );
		add_option( 'tppqw_title_position', 'top' );
		add_option( 'tppqw_title_background', '#161617' );
		add_option( 'tppqw_title_color', '#d2d2d2' );
		add_option( 'tppqw_related_products', 0 );
		add_option( 'tppqw_crousel_items_width', 215 );
		add_option( 'tppqw_crousel_item_margin', 10 );
		add_option( 'tppqw_crousel_animation_loop', 1 );
		add_option( 'tppqw_show_share_buttons', 0 );
		add_option( 'tppqw_share_buttons', 0 );
		add_option( 'tppqw_related_products_titel', 'Related Products' );
		add_option( 'tppqw_related_products_titel_text_align', 'center' );
		add_option( 'tppqw_product_fields_to_show', array('rating','price','short_description','add_to_cart','categories') );
		add_option( 'tppqw_product_quantity_type', 'styling' );
		add_option( 'tppqw_button_position_priority', 10 );
		add_option( 'tppqw_qw_font_size', 1 );
		add_option( 'tppqw_qw_color', '#111' );
		add_option( 'tppqw_qw_background', '' );
		add_option( 'tppqw_sale_font_size', 0.8 );
		add_option( 'tppqw_sale_color', '#fff' );
		add_option( 'tppqw_sale_background', '#e54b4b' );
		add_option( 'tppqw_custom_css', '' );
		add_option( 'tppqw_addtocart_background', '#23282d' );
		add_option( 'tppqw_addtocart_color', '#fff' );
		add_option( 'tppqw_loading_color', '#23282d' );
	}

}
