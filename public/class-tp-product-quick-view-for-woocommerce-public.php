<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.tplugins.com
 * @since      1.0.0
 *
 * @package    Tp_Product_Quick_View_For_Woocommerce
 * @subpackage Tp_Product_Quick_View_For_Woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tp_Product_Quick_View_For_Woocommerce
 * @subpackage Tp_Product_Quick_View_For_Woocommerce/public
 * @author     TP Plugins <pluginstp@gmail.com>
 */
class Tp_Product_Quick_View_For_Woocommerce_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		
		wp_enqueue_style( 'venobox.min', plugin_dir_url( __FILE__ ) . 'css/venobox.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tp-product-quick-view-for-woocommerce-public.css', array(), $this->version, 'all' );
		
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		
		wp_enqueue_script( 'venobox.min', plugin_dir_url( __FILE__ ) . 'js/venobox.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tp-product-quick-view-for-woocommerce-public.js', array( 'jquery' ), $this->version, false );

		// Localize the script with new data
		$translation_array = array(
			//'display_url' => plugin_dir_url( __FILE__ ) . 'partials/tp-woocommerce-compare-public-display.php',
			'ajax_url'            => admin_url('admin-ajax.php'),
			'width'               => get_option('tppqw_width'),
			'height'              => get_option('tppqw_height'),
			'button_type'         => get_option('tppqw_button_type'),
			'button_label'        => get_option('tppqw_button_label'),
			'button_position'     => get_option('tppqw_button_position'),
			'show_gallery'        => get_option('tppqw_show_gallery'),
			'change_thumbnail_by' => get_option('tppqw_change_thumbnail_by'),
			'close_lightbox'      => get_option('tppqw_close_lightbox'),
			'title_position'      => get_option('tppqw_title_position'),
			'title_background'    => get_option('tppqw_title_background'),
			'title_color'         => get_option('tppqw_title_color'),
			'crousel_items_width' => get_option('tppqw_crousel_items_width'),
			'crousel_item_margin' => get_option('tppqw_crousel_item_margin'),
			'crousel_animation_loop' => get_option('tppqw_crousel_animation_loop'),
		);

		wp_localize_script( $this->plugin_name, 'tppqw', $translation_array );
		
	}

	/**
	 * Adds the rewrite rule for our iframe
	 * 
	 * @uses add_rewrite_rule
	 */
	public function iframe_add_rewrite() {
		add_rewrite_rule(
			'^tpqwiframe$',
			'index.php?tpqwiframe=true',
			'top'
		);
	}

	/**
	 * adds our iframe query variable so WP knows what it is and doesn't
	 * just strip it out
	 */
	public function iframe_filter_vars( $vars )	{
		$vars[] = 'tpqwiframe';
		$vars[] = 'pid';
		return $vars;
	}

	/**
	 * Catches our iframe query variable.  If it's there, we'll stop the 
	 * rest of WP from loading and do our thing.  If not, everything will
	 * continue on its merry way.
	 * 
	 * @uses get_query_var
	 * @uses get_posts
	 */
	public function catch_iframe() {
		//wp_dbug(get_query_var( 'pid' ));
		// no iframe? bail
		if( !get_query_var( 'tpqwiframe' ) || !get_query_var( 'pid' )) return;

		$product_id = get_query_var( 'pid' );

		require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/tp-product-quick-view-for-woocommerce-public-display.php';
		// finally, call exit(); and stop wp from finishing (eg. loading the
		// templates
		exit();
	}

	public function add_quick_view_link() {
		global $product;
		$product_id   = $product->get_id();
		$product_name = $product->get_name();
		$button_type  = get_option('tppqw_button_type');
		$button_label = get_option('tppqw_button_label');
		$button_position = get_option('tppqw_button_position');
		$button_position_class = str_replace(".","_",$button_position);
		
		if($button_type == 'icon'){
			$button_name = '<i class="demo-icon tppqwicon-eye"></i>';
		}
		elseif($button_type == 'text and icon'){
			$button_name = '<i class="demo-icon tppqwicon-eye"></i>'.' '.__($button_label,'tppqw');
		}
		else{
			$button_name = __($button_label,'tppqw');
		}

		echo '<a class="tpvenobox tppqw_'.$button_position_class.'" data-gall="iframe" data-vbtype="iframe" title="'.$product_name.'" href="' . esc_url( home_url('?tpqwiframe=true&pid='.$product_id.'') ) . '">'.$button_name.'</a>';
	}

	public function custom_css() {

		$custom_css = '';

		$qw_color      = get_option('tppqw_qw_color');
		$qw_background = (get_option('tppqw_qw_background')) ? get_option('tppqw_qw_background') : 'none';
		$qw_padding    = (get_option('tppqw_qw_background')) ? '10px' : '0';
		$qw_font_size  = get_option('tppqw_qw_font_size');

		$sale_color      = get_option('tppqw_sale_color');
		$sale_background = (get_option('tppqw_sale_background')) ? get_option('tppqw_sale_background') : 'none';
		//$qw_padding    = (get_option('tppqw_sale_background')) ? '0 10px' : '0';
		$sale_font_size  = get_option('tppqw_sale_font_size');
		$more_details_color = get_option('tppqw_more_details_color');
		$more_details_background = (get_option('tppqw_more_details_background')) ? get_option('tppqw_more_details_background') : 'none';
		$more_details_padding    = (get_option('tppqw_more_details_background')) ? '5px 10px' : '0';

		$addtocart_background = (get_option('tppqw_addtocart_background')) ? get_option('tppqw_addtocart_background') : 'none';
		$addtocart_color = get_option('tppqw_addtocart_color');

		$loading_color = get_option('tppqw_loading_color');

		$show_on_mobile = get_option('tppqw_show_on_mobile');

		echo '<style>';

			echo '.tpvenobox{
				color: '.$qw_color.' !important;
				background: '.$qw_background.';
				padding: '.$qw_padding.';
				font-size: '.$qw_font_size.'em;
				line-height: '.$qw_font_size.'em;
				margin: 10px 0 0;
				display: inherit;
				text-decoration: none;
			}';

			echo '.tpvenobox:hover{
				color: '.$qw_color.';
				background: '.$qw_background.';
				opacity: 0.8;
			}';

			echo '.tppqw-onsale{
				color: '.$sale_color.';
				background: '.$sale_background.';
				font-size: '.$sale_font_size.'em;
			}';

			echo '.tppqw-more-details a{
				color: '.$more_details_color.';
				background: '.$more_details_background.';
				padding: '.$more_details_padding.';
			}';

			echo '.tppqw-more-details a:hover, .tppqw-addtocart .single_add_to_cart_button:hover{
				opacity: 0.8;
			}';

			echo '.tppqw-addtocart .single_add_to_cart_button{
				color: '.$addtocart_color.';
				background: '.$addtocart_background.';
			}';

		echo '</style>';
	}

}
