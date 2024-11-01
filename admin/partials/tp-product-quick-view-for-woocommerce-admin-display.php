<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.tplugins.com
 * @since      1.0.0
 *
 * @package    Tp_Product_Quick_View_For_Woocommerce
 * @subpackage Tp_Product_Quick_View_For_Woocommerce/admin/partials
 */

add_action('admin_menu', 'tppqw_plugin_create_menu');

function tppqw_plugin_create_menu() {

	//create new top-level menu
	add_menu_page(TPPQW_PLUGIN_NAME, TPPQW_PLUGIN_NAME, 'manage_options', 'tppqw_plugin_settings_page', 'tppqw_plugin_settings_page' , plugins_url('/images/tp.png', __FILE__) );
    //add_menu_page(TPWC_PLUGIN_NAME, TPWC_PLUGIN_NAME, 'manage_options', 'tpwc_plugin_settings_page', 'tpwc_plugin_settings_page' , plugins_url('/images/tp.png', __FILE__) );
	//call register settings function
	add_action( 'admin_init', 'register_tppqw_plugin_settings' );
}

function register_tppqw_plugin_settings() {
    //register our settings
    register_setting('tppqw-plugin-settings-group','tppqw_button_type');
    register_setting('tppqw-plugin-settings-group','tppqw_button_label');
    register_setting('tppqw-plugin-settings-group','tppqw_button_position');
    register_setting('tppqw-plugin-settings-group','tppqw_show_gallery');
    register_setting('tppqw-plugin-settings-group','tppqw_change_thumbnail_by');
    register_setting('tppqw-plugin-settings-group','tppqw_close_lightbox');
    register_setting('tppqw-plugin-settings-group','tppqw_title_position');
    register_setting('tppqw-plugin-settings-group','tppqw_title_background');
    register_setting('tppqw-plugin-settings-group','tppqw_title_color');
    register_setting('tppqw-plugin-settings-group','tppqw_product_fields_to_show');
    register_setting('tppqw-plugin-settings-group','tppqw_button_position_priority');
    register_setting('tppqw-plugin-settings-group','tppqw_qw_color');
    register_setting('tppqw-plugin-settings-group','tppqw_qw_background');
    register_setting('tppqw-plugin-settings-group','tppqw_qw_font_size');
    register_setting('tppqw-plugin-settings-group','tppqw_sale_color');
    register_setting('tppqw-plugin-settings-group','tppqw_sale_background');
    register_setting('tppqw-plugin-settings-group','tppqw_sale_font_size');
    register_setting('tppqw-plugin-settings-group','tppqw_more_details_label');
    register_setting('tppqw-plugin-settings-group','tppqw_more_details_color');
    register_setting('tppqw-plugin-settings-group','tppqw_show_on_mobile');
    register_setting('tppqw-plugin-settings-group','tppqw_more_details_background');
    register_setting('tppqw-plugin-settings-group','tppqw_addtocart_background');
    register_setting('tppqw-plugin-settings-group','tppqw_addtocart_color');
    //register_setting('tppqw-plugin-settings-group','xxx');
    //register_setting('tppqw-plugin-settings-group','xxx');
    //register_setting('tppqw-plugin-settings-group','xxx');
    //register_setting('tppqw-plugin-settings-group','xxx');
    //register_setting('tppqw-plugin-settings-group','xxx');
}

function tppqw_plugin_settings_page() {

    //Settings
    $tppqw_show_on_mobile      = get_option('tppqw_show_on_mobile');
    $tppqw_button_type         = get_option('tppqw_button_type');
    $tppqw_button_label        = get_option('tppqw_button_label');
    $tppqw_button_position     = get_option('tppqw_button_position');
    $tppqw_show_gallery        = get_option('tppqw_show_gallery');
    $tppqw_change_thumbnail_by = get_option('tppqw_change_thumbnail_by');
    $tppqw_close_lightbox      = get_option('tppqw_close_lightbox');
    $tppqw_title_position      = get_option('tppqw_title_position');
    $tppqw_button_position_priority = get_option('tppqw_button_position_priority');

    //Related Products
    $tppqw_crousel_items_width = get_option('tppqw_crousel_items_width');
    $tppqw_crousel_item_margin = get_option('tppqw_crousel_item_margin');
    $tppqw_crousel_animation_loop = get_option('tppqw_crousel_animation_loop');
    $tppqw_related_products_titel = get_option('tppqw_related_products_titel');
    $tppqw_related_products_titel_text_align = get_option('tppqw_related_products_titel_text_align');

    $tppqw_slider_speed            = get_option('tppqw_slider_speed');
    $tppqw_slider_rtl              = get_option('tppqw_slider_rtl');
    $tppqw_slider_prev_arrow       = get_option('tppqw_slider_prev_arrow');
    $tppqw_slider_hide_add_to_cart = get_option('tppqw_slider_hide_add_to_cart');
    $tppqw_slider_selector         = get_option('tppqw_slider_selector');
    $tppqw_slider_elements_text_align = get_option('tppqw_slider_elements_text_align');

    //Style
    $tppqw_title_background = get_option('tppqw_title_background');
    $tppqw_title_color      = get_option('tppqw_title_color');
    $tppqw_qw_color         = get_option('tppqw_qw_color');
    $tppqw_qw_background    = get_option('tppqw_qw_background');
    $tppqw_qw_font_size     = get_option('tppqw_qw_font_size');
    $tppqw_sale_color       = get_option('tppqw_sale_color');
    $tppqw_sale_background  = get_option('tppqw_sale_background');
    $tppqw_sale_font_size   = get_option('tppqw_sale_font_size');

    //Share Buttons
    $tppqw_share_buttons = get_option('tppqw_share_buttons');

    //Product
    $tppqw_product_fields_to_show = get_option('tppqw_product_fields_to_show');
    $tppqw_more_details_label = get_option('tppqw_more_details_label');
    $tppqw_more_details_color = get_option('tppqw_more_details_color');
    $tppqw_more_details_background = get_option('tppqw_more_details_background');
    $tppqw_addtocart_background = get_option('tppqw_addtocart_background');
    $tppqw_addtocart_color = get_option('tppqw_addtocart_color');

    $tppqw_show_on_mobile_check   = ($tppqw_show_on_mobile) ? 'checked="checked"' : '';
    $tppqw_show_gallery_check   = ($tppqw_show_gallery) ? 'checked="checked"' : '';
    $tppqw_close_lightbox_check = ($tppqw_close_lightbox) ? 'checked="checked"' : '';
    $tppqw_crousel_animation_loop_check = ($tppqw_crousel_animation_loop) ? 'checked="checked"' : '';

    $tppqw_slider_rtl_check              = ($tppqw_slider_rtl) ? 'checked="checked"' : '';
    $tppqw_slider_hide_add_to_cart_check = ($tppqw_slider_hide_add_to_cart) ? 'checked="checked"' : '';

    $tppqw_lkey = ($tppqw_lkey) ? $tppqw_lkey : '';
    $tppqw_lkey_state_butt = ($tppqw_lkey_state) ? 'Deactivate' : 'Activate';
    $tppqw_lkey_state_type = ($tppqw_lkey_state) ? 'deactivate' : 'activate';
    $tppqw_lkey_expiresAt_message = ($tppqw_lkey_expiresAt) ? '<span class="tppqw_lkey_expiresat">Your License Key expires at '.$tppqw_lkey_expiresAt.'</span>' : '';

    ?>
    
    <div class="wrap tppqw-wrap">

        <h1><?php echo TPPQW_PLUGIN_NAME; ?></h1>
        
        <form method="post" action="options.php">
            <?php settings_fields( 'tppqw-plugin-settings-group' ); ?>
            <?php do_settings_sections( 'tppqw-plugin-settings-group' ); ?>

            <div id="tppqw-tabs" class="tpglobal-tabs">
                <ul>
                    <li><a href="#tabs-1">Settings</a></li>
                    <li><a href="#tabs-2">Style</a></li>
                    <li><a href="#tabs-6">Product</a></li>
                    <li><a href="#tabs-5">Related Products</a></li>
                    <li><a href="#tabs-3">Custom css</a></li>
                    <li><a href="#tabs-4">Share Buttons</a></li>
                    <li><a href="#tabs-7">License</a></li>
                </ul>

                <div id="tabs-1" class="tpglobal-tabs-content">

                    <div class="tpglobal-tabs-row">
                        <div class="tpglobal-tabs-row-ins">
                            <label class="tpglobal-label">Modal Width</label>
                            <input type="number" name="tppqw_width" disabled>
                            <span class="tpglobal-desc">Set width of modal window (Leave blank for responsive).</span>
                        </div>

                        <div class="tpglobal-tabs-row-ins">
                            <label class="tpglobal-label">Modal Height</label>
                            <input type="number" name="tppqw_height" disabled>
                            <span class="tpglobal-desc">Set height of modal window (Leave blank for responsive).</span>
                        </div>
                        <div class="tpglobal_triangle_topright_box"><div class="tpglobal_triangle_topright"><span>PRO</span></div></div>
                    </div><!-- tpglobal-tabs-row -->

                    <div class="tpglobal-tabs-row">
                        <div class="tpglobal-tabs-row-ins">
                            <label class="tpglobal-label">Quick View Button Type</label>
                            <?php
                                $options_button_type = array('text','icon','text and icon');
                                echo tppqw_select_options('tppqw_button_type',$options_button_type,$tppqw_button_type);
                            ?>
                            <span class="tpglobal-desc">Label for the quick view button in the WooCommerce loop.</span>
                        </div>

                        <div class="tpglobal-tabs-row-ins">
                            <label class="tpglobal-label">Quick View Link Label</label>
                            <input type="text" name="tppqw_button_label" value="<?php echo $tppqw_button_label; ?>">
                            <span class="tpglobal-desc">Label for the quick view link in the WooCommerce loop.</span>
                        </div>

                        <div class="tpglobal-tabs-row-ins">
                            <label class="tpglobal-label">Quick View Button Position</label>
                            <?php
                                echo tppqw_select_button_position($tppqw_button_position);
                            ?>
                            <span class="tpglobal-desc">Position of the quick view button.</span>
                            <input type="hidden" name="tppqw_button_position_priority" id="tppqw_button_position_priority" value="<?php echo $tppqw_button_position_priority; ?>">
                        </div>
                    </div><!-- tpglobal-tabs-row -->

                    <div class="tpglobal-tabs-row">
                        <div class="tpglobal-tabs-row-ins">
                            <label class="tpglobal-container">Show Gallery if Available
                                <input type="checkbox" name="tppqw_show_gallery" <?php echo $tppqw_show_gallery_check; ?> value="1">
                                <span class="checkmark"></span>
                            </label>
                            <span class="tpglobal-desc">Show Gallery if Product Have Gallery.</span>
                        </div>

                        <div class="tpglobal-tabs-row-ins">
                            <label class="tpglobal-label">Change Big Image by Thumbnail onmouseover / click</label>
                            <?php
                                $options_change_thumbnail_by = array('onmouseover','onclick');
                                echo tppqw_select_options('tppqw_change_thumbnail_by',$options_change_thumbnail_by,$tppqw_change_thumbnail_by);
                            ?>
                            <span class="tpglobal-desc">Change Big Image by Thumbnail hover / click.</span>
                        </div>

                        <div class="tpglobal_triangle_topright_box"><div class="tpglobal_triangle_topright"><span>PRO</span></div></div>

                    </div><!-- tpglobal-tabs-row -->

                    <div class="tpglobal-tabs-row">
                        <label class="tpglobal-container">Products Infinite Loop
                            <input type="checkbox" name="tppqw_infinite_loop" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <span class="tpglobal-desc">Infinite loop sliding</span>
                        <div class="tpglobal_triangle_topright_box"><div class="tpglobal_triangle_topright"><span>PRO</span></div></div>
                    </div><!-- tpglobal-tabs-row -->

                    <div class="tpglobal-tabs-row">
                        <label class="tpglobal-container">Close the lightbox
                            <input type="checkbox" name="tppqw_close_lightbox" <?php echo $tppqw_close_lightbox_check; ?> value="1">
                            <span class="checkmark"></span>
                        </label>
                        <span class="tpglobal-desc">Close the lightbox by clicking the background overlay</span>
                    </div>

                    <div class="tpglobal-tabs-row">
                        <label class="tpglobal-label">Lightbox Title Position</label>
                        <?php
                            $options_title_position = array('top','bottom');
                            echo tppqw_select_options('tppqw_title_position',$options_title_position,$tppqw_title_position);
                        ?>
                        <span class="tpglobal-desc">'top' or 'bottom'</span>
                    </div><!-- tpglobal-tabs-row -->

                    <div class="tpglobal-tabs-row">
                        <label class="tpglobal-container">Slider RTL
                            <input type="checkbox" name="tppqw_slider_rtl" <?php echo $tppqw_slider_rtl_check; ?> value="1">
                            <span class="checkmark"></span>
                        </label>
                        <span class="tpglobal-desc">Change the slider's direction to become right-to-left</span>
                    </div><!-- tpglobal-tabs-row -->

                    <div class="tpglobal-tabs-row">
                        <label class="tpglobal-container">Show Quick View on Mobile
                            <input type="checkbox" name="tppqw_show_on_mobile" <?php echo $tppqw_show_on_mobile_check; ?> value="1">
                            <span class="checkmark"></span>
                        </label>
                        <!-- <span class="tpglobal-desc">Show Gallery if Product Have Gallery.</span> -->
                    </div>
                
                </div><!-- tpglobal-tabs-content -->

                <div id="tabs-2" class="tpglobal-tabs-content">

                    <div class="tpglobal-tabs-row">

                        <div class="tpglobal-tabs-row-ins">
                            <label>Title Background</label>
                            <input type="text" class="tp_colorpiker" name="tppqw_title_background" value="<?php echo $tppqw_title_background; ?>" >
                        </div>

                        <div class="tpglobal-tabs-row-ins">
                            <label>Title Color</label>
                            <input type="text" class="tp_colorpiker" name="tppqw_title_color" value="<?php echo $tppqw_title_color; ?>" >
                        </div>

                    </div><!-- tpglobal-tabs-row -->

                    <div class="tpglobal-tabs-row">

                        <div class="tpglobal-tabs-row-ins">
                            <label>"Quick View" Color</label>
                            <input type="text" class="tp_colorpiker" name="tppqw_qw_color" value="<?php echo $tppqw_qw_color; ?>" >
                        </div>

                        <div class="tpglobal-tabs-row-ins">
                            <label>"Quick View" Background</label>
                            <input type="text" class="tp_colorpiker" name="tppqw_qw_background" value="<?php echo $tppqw_qw_background; ?>" >
                        </div>

                        <div class="tpglobal-tabs-row-ins">
                            <label>"Quick View" Font Size (in em)</label>
                            <input type="number" name="tppqw_qw_font_size" value="<?php echo $tppqw_qw_font_size; ?>" min="0.4" step="0.1" >
                        </div>

                    </div><!-- tpglobal-tabs-row -->

                    <div class="tpglobal-tabs-row">

                        <div class="tpglobal-tabs-row-ins">
                            <label>"SALE" Color</label>
                            <input type="text" class="tp_colorpiker" name="tppqw_sale_color" value="<?php echo $tppqw_sale_color; ?>" >
                        </div>

                        <div class="tpglobal-tabs-row-ins">
                            <label>"SALE" Background</label>
                            <input type="text" class="tp_colorpiker" name="tppqw_sale_background" value="<?php echo $tppqw_sale_background; ?>" >
                        </div>

                        <div class="tpglobal-tabs-row-ins">
                            <label>"SALE" Font Size (in em)</label>
                            <input type="number" name="tppqw_sale_font_size" value="<?php echo $tppqw_sale_font_size; ?>" min="0.4" step="0.1" >
                        </div>

                    </div><!-- tpglobal-tabs-row -->

                </div>

                <div id="tabs-3" class="tpglobal-tabs-content">
                    <div class="tpglobal-tabs-row">
                        <p>This option is for developers only! If you do not know CSS it is not recommended to change it.</p>
                        <textarea id="tppqw_custom_css" class="tppqw_custom_css" disabled></textarea>
                        <div class="tpglobal_triangle_topright_box"><div class="tpglobal_triangle_topright"><span>PRO</span></div></div>
                    </div>
                </div>

                <div id="tabs-4" class="tpglobal-tabs-content">
                    <div class="tpglobal-tabs-row">
                        <label class="tpglobal-container">Show Share Buttons
                            <input type="checkbox" name="tppqw_show_share_buttons" disabled value="1">
                            <span class="checkmark"></span>
                        </label>
                        <!-- <span class="tpglobal-desc">Show Gallery if Product Have Gallery.</span> -->
                        <div class="tpglobal_triangle_topright_box"><div class="tpglobal_triangle_topright"><span>PRO</span></div></div>
                    </div>

                    <div class="tpglobal-tabs-row">
                        <h3>Fields to show</h3>
                        <?php echo tppqw_share_fields_to_show($tppqw_share_buttons); ?>
                        <div class="tpglobal_triangle_topright_box"><div class="tpglobal_triangle_topright"><span>PRO</span></div></div>
                    </div><!-- tpglobal-tabs-row -->

                </div>

                <div id="tabs-5" class="tpglobal-tabs-content">
                    <p>Activate Related Products to Show theme in Quick View Box.</p>

                    <div class="tpglobal-tabs-left">

                        <div class="tpglobal-tabs-row">
                            <label class="tpglobal-container">Show Related Products
                                <input type="checkbox" name="tppqw_related_products" disabled value="1">
                                <span class="checkmark"></span>
                            </label>
                            <span class="tpglobal-desc">Show Related Products if Product Have.</span>
                            <div class="tpglobal_triangle_topright_box"><div class="tpglobal_triangle_topright"><span>PRO</span></div></div>
                        </div>

                        <div class="tpglobal-tabs-row">
                            <div class="tpglobal-tabs-row-ins">
                                <label>Related Products Title</label>
                                <input type="text" name="tppqw_related_products_titel" value="<?php echo $tppqw_related_products_titel; ?>" >
                            </div><!-- tpglobal-tabs-row -->

                            <div class="tpglobal-tabs-row-ins">
                                <label>Related Products Title text align</label>
                                <?php
                                    $tppqw_related_products_text_align_options = array('left','right','center','inherit');
                                    echo tppqw_select_options('tppqw_related_products_titel_text_align',$tppqw_related_products_text_align_options,$tppqw_related_products_titel_text_align);
                                ?>
                            </div><!-- tpglobal-tabs-row -->
                            <div class="tpglobal_triangle_topright_box"><div class="tpglobal_triangle_topright"><span>PRO</span></div></div>
                        </div><!-- tpglobal-tabs-row -->

                        <!-- <div class="tpglobal-tabs-row">
                            <label>Product Title Color</label>
                            <input type="text" class="tp_colorpiker" name="tppqw_special_template_product_title_color" value="<?php //echo $tppqw_special_template_product_title_color; ?>" >
                        </div> --><!-- tpglobal-tabs-row -->

                        <div class="tpglobal-tabs-row">
                            <label>Carousel Items Width</label>
                            <input type="number" name="tppqw_crousel_items_width" value="<?php echo $tppqw_crousel_items_width; ?>" disabled>
                            <span class="tpglobal-desc">Box-model width of individual carousel items, including horizontal borders and padding.</span>
                            <div class="tpglobal_triangle_topright_box"><div class="tpglobal_triangle_topright"><span>PRO</span></div></div>
                        </div><!-- tpglobal-tabs-row -->

                        <div class="tpglobal-tabs-row">
                            <label>Carousel Item Margin</label>
                            <input type="number" name="tppqw_crousel_item_margin" value="<?php echo $tppqw_crousel_item_margin; ?>" disabled>
                            <span class="tpglobal-desc">Margin between carousel items.</span>
                            <div class="tpglobal_triangle_topright_box"><div class="tpglobal_triangle_topright"><span>PRO</span></div></div>
                        </div><!-- tpglobal-tabs-row -->

                        <div class="tpglobal-tabs-row">
                            <label class="tpglobal-container">Carousel Loop
                                <input type="checkbox" name="tppqw_crousel_animation_loop" disabled value="1">
                                <span class="checkmark"></span>
                            </label>
                            <span class="tpglobal-desc">If false, directionNav will received "disable" classes at either end.</span>
                            <div class="tpglobal_triangle_topright_box"><div class="tpglobal_triangle_topright"><span>PRO</span></div></div>
                        </div>

                    </div><!-- tpglobal-tabs-left -->

                    <div class="tpglobal-tabs-right">
                        <!-- <div class="tppqw-slides-template-preview">
                            <label class="tpglobal-label">Slides Template Preview</label>
                        </div> -->
                    </div><!-- tpglobal-tabs-right -->

                </div>

                <div id="tabs-6" class="tpglobal-tabs-content">
                    <div class="tpglobal-tabs-row tpglobal-small">
                        <h3>Select Fields to Show</h3>
                        <?php echo tppqw_product_fields_to_show($tppqw_product_fields_to_show); ?>
                    </div>

                    <div class="tpglobal-tabs-row">
                        <div class="tpglobal-tabs-row-ins">
                            <label class="tpglobal-label">More Details Link Label</label>
                            <input type="text" name="tppqw_more_details_label" value="<?php echo $tppqw_more_details_label; ?>">
                        </div>

                        <div class="tpglobal-tabs-row-ins">
                            <label>More Details Link Color</label>
                            <input type="text" class="tp_colorpiker" name="tppqw_more_details_color" value="<?php echo $tppqw_more_details_color; ?>" >
                        </div>

                        <div class="tpglobal-tabs-row-ins">
                            <label>More Details Link Background</label>
                            <input type="text" class="tp_colorpiker" name="tppqw_more_details_background" value="<?php echo $tppqw_more_details_background; ?>" >
                        </div>
                    </div>

                    <div class="tpglobal-tabs-row tpglobal-small">
                        <label>Select Quantity Type</label>
                        <?php
                            $tppqw_product_quantity_type_options = array('styling','default');
                            echo tppqw_select_options('tppqw_product_quantity_type',$tppqw_product_quantity_type_options);
                        ?>
                        <div class="tpglobal_triangle_topright_box"><div class="tpglobal_triangle_topright"><span>PRO</span></div></div>
                    </div>

                    <div class="tpglobal-tabs-row">

                        <div class="tpglobal-tabs-row-ins">
                            <label class="tpglobal-container">Ajax add to cart
                                <input type="checkbox" name="tppqw_ajax_add_to_cart" disabled value="1">
                                <span class="checkmark"></span>
                            </label>
                            <span class="tpglobal-desc">Activate ajax mode on add to cart button.</span>
                            <div class="tpglobal_triangle_topright_box"><div class="tpglobal_triangle_topright"><span>PRO</span></div></div>
                        </div>

                        <div class="tpglobal-tabs-row-ins">
                            <label>Add to cart Background</label>
                            <input type="text" class="tp_colorpiker" name="tppqw_addtocart_background" value="<?php echo $tppqw_addtocart_background; ?>" >
                        </div>

                        <div class="tpglobal-tabs-row-ins">
                            <label>Add to cart Color</label>
                            <input type="text" class="tp_colorpiker" name="tppqw_addtocart_color" value="<?php echo $tppqw_addtocart_color; ?>" >
                        </div>

                    </div>

                    <div class="tpglobal-tabs-row">
                        <label>Ajax Loading Color</label>
                        <input type="text" class="tp_colorpiker" name="tppqw_loading_color" disabled >
                        <div class="tpglobal_triangle_topright_box"><div class="tpglobal_triangle_topright"><span>PRO</span></div></div>
                    </div>

                </div>

                <div id="tabs-7" class="tpglobal-tabs-content">
                    <div class="tpwc_admin_settings_left">
                        <h2>Free Version</h2>
                        <a href="https://www.tplugins.com/product/tp-product-quick-view-for-woocommerce-pro/" target="_blank">Upgrade to PRO</a>
                    </div>
                </div>

            </div><!-- tpglobal-tabs -->

            <?php submit_button(); ?>
        </form>

    </div><!-- tppqw-wrap -->
    <?php

}


function tppqw_select_options($name,$options,$selected = false) {
    $select = '';
    $select .= '<select name="'.$name.'">';
    foreach ($options as $option) {
        if($selected && $selected == $option){
            $select .= '<option value="'.$option.'" selected>'.$option.'</option>';
        }
        else{
            $select .= '<option value="'.$option.'">'.$option.'</option>';
        }
    }
    $select .= '</select>';
    return $select;
}

function tppqw_share_fields_to_show($tppqw_share_buttons) {
    $html = '';
    $all_fields = array(
        'email'     => 'Email',
        'facebook'  => 'Facebook',
        //'linkedin'  => 'Linked In',
        //'pinterest' => 'Pinterest',
        //'print'     => 'Print',
        'twitter'   => 'Twitter',
        'whatsapp'  => 'Whatsapp'
    );

    foreach ($all_fields as $key => $value) {
        $checked = '';
        if($tppqw_share_buttons && in_array($key, $tppqw_share_buttons)){
            $checked = 'checked';
        }
        $html .= '<div class="tpglobal-tabs-row">';
            $html .= '<label class="tpglobal-container">'.$value.'';
                $html .= '<input type="checkbox" name="tppqw_share_buttons[]" value="'.$key.'" '.$checked.'>';
                $html .= '<span class="checkmark"></span>';
            $html .= '</label>';
        $html .= '</div>';
    }

    return $html;
}

function tppqw_product_fields_to_show($tppqw_product_fields_to_show) {
    $html = '';
    $all_fields = array(
        'rating'            => 'Show Product Rating',
        'price'             => 'Show Product Price',
        'short_description' => 'Show Product Short Description',
        'long_description'  => 'Show Product Long Description',
        'add_to_cart'       => 'Show Product Add to Cart',
        'sku'               => 'Show Product SKU',
        'categories'        => 'Show Product Categories',
        'tags'              => 'Show Product Tags',
        'attributes'        => 'Show Product Attributes',
        'more_details'      => 'Show Product More Details Button'
    );

    foreach ($all_fields as $key => $value) {
        $checked = '';
        if($tppqw_product_fields_to_show && in_array($key, $tppqw_product_fields_to_show)){
            $checked = 'checked';
        }
        $html .= '<div class="tpglobal-tabs-row-tiz">';
            $html .= '<label class="tpglobal-container">'.$value.'';
                $html .= '<input type="checkbox" name="tppqw_product_fields_to_show[]" value="'.$key.'" '.$checked.'>';
                $html .= '<span class="checkmark"></span>';
            $html .= '</label>';
        $html .= '</div>';
    }

    return $html;
}

function tppqw_select_button_position($tppqw_button_position) {
    $select = '';
    $i = 0;
    $all_fields = array(
        'woocommerce_shop_loop_item_title.15'        => 'After product title',   //15
        'woocommerce_shop_loop_item_title.10'        => 'Before product title',  //10
        'woocommerce_shop_loop_item_title.5'         => 'Inside product image',  //5
        'woocommerce_after_shop_loop_item.10'        => 'After product price',   //10
    );

    $priority = array(15,10,5,10);

    $select .= '<select name="tppqw_button_position" id="tppqw_button_position">';
    foreach ($all_fields as $key => $value) {
        $selected = '';
        if($tppqw_button_position == $key){
            $selected = 'selected';
        }
        
        $select .= '<option value="'.$key.'" data-priority="'.$priority[$i].'" '.$selected.'>'.$value.'</option>';

        $i++;
    }

    $select .= '</select>';

    return $select;
}