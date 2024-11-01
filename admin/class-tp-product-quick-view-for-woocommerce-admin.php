<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.tplugins.com
 * @since      1.0.0
 *
 * @package    Tp_Product_Quick_View_For_Woocommerce
 * @subpackage Tp_Product_Quick_View_For_Woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tp_Product_Quick_View_For_Woocommerce
 * @subpackage Tp_Product_Quick_View_For_Woocommerce/admin
 * @author     TP Plugins <pluginstp@gmail.com>
 */
class Tp_Product_Quick_View_For_Woocommerce_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'minicolors', plugin_dir_url( __FILE__ ) . 'css/jquery.minicolors.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tp-product-quick-view-for-woocommerce-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'minicolors', plugin_dir_url( __FILE__ ) . 'js/jquery.minicolors.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tp-product-quick-view-for-woocommerce-admin.js', array( 'jquery','jquery-ui-core','jquery-ui-tabs' ), $this->version, false );
	}

	public function settings_link( $links ) {
		$settings_link = '<a href="admin.php?page=tppqw_plugin_settings_page">Settings</a>';
		$pro_link = '<a href="'.TPPQW_PLUGIN_HOME.'product/'.TPPQW_PLUGIN_SLUG.'" class="tpc_get_pro" target="_blank">Go Premium!</a>';
		array_push( $links, $settings_link, $pro_link );
		return $links;
	} //function settings_link( $links )

	public function get_pro_link( $links, $file ) {

		if ( TPPQW_PLUGIN_BASENAME == $file ) {
	
			$row_meta = array(
				'docs' => '<a href="' . esc_url( 'https://www.tplugins.com/demos/shop/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Live Demo', 'wtppcs' ) . '" class="tpc_live_demo">&#128073; ' . esc_html__( 'Live Demo', 'wtppcs' ) . '</a>'
			);
	
			return array_merge( $links, $row_meta );
		}
		
		return (array) $links;
	} //function get_pro_link( $links, $file )

}
