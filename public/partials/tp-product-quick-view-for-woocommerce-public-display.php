<?php
wp_head();

//$product_id = $_GET['pid'];
$product      = wc_get_product($product_id);
$product_name = $product->get_name();
$product_link = get_permalink($product_id);
$product_type = $product->get_type();

$product_image_id          = $product->get_image_id();
$product_gallery_image_ids = $product->get_gallery_image_ids();
$get_image                 = $product->get_image();

$product_price_html = $product->get_price_html();

$product_short_description = $product->get_short_description();
$product_long_description  = $product->get_description();

$add_to_cart_text = $product->add_to_cart_text();

$product_sku        = $product->get_sku();
$product_categories = $product->get_categories();
$product_tags       = $product->get_tags();

$get_rating_counts  = $product->get_rating_counts();
$get_average_rating = $product->get_average_rating();
$get_review_count   = $product->get_review_count();
$get_rating_count   = $product->get_rating_count();
$get_rating_html    = $product->get_rating_html();
$product_gallery    = tppqw_create_product_gallery($product_image_id,$product_gallery_image_ids);
//wp_dbug($product_gallery_image_ids);

$product_fields_to_show = get_option('tppqw_product_fields_to_show');
$product_quantity_type = get_option('tppqw_product_quantity_type');

$more_details_label = get_option('tppqw_more_details_label');
$ajax_add_to_cart = get_option('tppqw_ajax_add_to_cart');
// $addtocart_background = get_option('tppqw_addtocart_background');
// $addtocart_color = get_option('tppqw_addtocart_color');

$loading_color = get_option('tppqw_loading_color');

if(is_rtl()){
    $body_class = 'rtl';
    $direction  = 'rtl';
    $text_align = 'right';
    $float      = 'right';
}
else{
    $body_class = 'ltr';
    $direction  = 'ltr';
    $text_align = 'left';
    $float      = 'left';
}

//-----------------------------------------------------------------------------------

echo '<base target="_parent">';
//wc_get_template_part( 'content', 'single-product' );
$args = array('post_type' => 'product', 'post_status' => 'publish','p' => $product_id);
$query = new WP_Query($args);
if($query->have_posts()){
    while ($query->have_posts()){
        $query->the_post();
        //woocommerce_template_single_add_to_cart();
        //wp_dbug($query);
        echo '<div class="tppqw-container tppqw-'.$product_type.' '.$body_class.'">';

        echo '<div class="tppqwlds-mask-big" id="tppqwlds-mask-big"><div class="tppqwlds-ripple"><div></div><div></div></div></div>';

            echo '<div class="tppqw-left">';
                //echo $get_image;
                if($product->is_on_sale()){
                    echo '<span class="tppqw-onsale">'.__('SALE').'</span>';
                }

                echo $product_gallery;

            echo '</div>'; //tppqw-left

            echo '<div class="tppqw-right">';
            
                do_action('tppqw_right_before_product_info',$product_id);

                echo '<h1>'.$product_name.'</h1>';

                if(in_array("price", $product_fields_to_show)){
                    echo '<div class="tppqw-price">'.$product_price_html.'</div>';
                }

                if(in_array("rating", $product_fields_to_show)){
                    echo '<div class="tppqw-rating">'.woocommerce_template_single_rating().'</div>';
                }

                if(in_array("short_description", $product_fields_to_show)){
                    echo '<div class="tppqw-description">'.$product_short_description.'</div>';
                }

                if(in_array("long_description", $product_fields_to_show)){
                    echo '<div class="tppqw-long-description">'.$product_long_description.'</div>';
                }

                if(in_array("add_to_cart", $product_fields_to_show)){
                    //echo '<div class="tppqw-addtocart">'.do_shortcode('[add_to_cart id="'.$product_id.'" style="" show_price="false" class="tppqw-addtocart-button"]').'</div>';
                    echo '<div class="tppqw-addtocart tppqw-addtocart-'.$product_quantity_type.'">';
                        woocommerce_template_single_add_to_cart();
                        //do_shortcode('[add_to_cart id="'.$product_id.'" style="" show_price="false" class="tppqw-addtocart-button"]');
                    echo '</div>';
                }

                if($product->has_attributes() && in_array("attributes", $product_fields_to_show)){
                    echo '<div class="tppqw-attributes">'.$product->list_attributes().'</div>';
                }

                if($product_sku && in_array("sku", $product_fields_to_show)){
                    echo '<div class="tppqw-sku">'.__('SKU','woocommerce').': '.$product_sku.'</div>';
                }

                if($product_categories && in_array("categories", $product_fields_to_show)){
                    echo '<div class="tppqw-categories">'.__('Categories','woocommerce').': '.$product_categories.'</div>';
                }

                if($product_categories && in_array("more_details", $product_fields_to_show)){
                    echo '<div class="tppqw-more-details"><span><a href="'.$product_link.'">'.__($more_details_label,'woocommerce').'</a></span></div>';
                }

                if($product_tags && in_array("tags", $product_fields_to_show)){
                    echo '<div class="tppqw-tags">'.__('Tags','woocommerce').': '.$product_tags.'</div>';
                }

                do_action('tppqw_right_after_product_info',$product_id);

                echo '<div id="tppqw_dbug"></div>';

            echo '</div>'; //tppqw-right

            do_action('tppqw_container_after_product_info',$product_id);
            
            echo '<input type="hidden" id="tppqw_pid" value="'.$product_id.'" >';

        echo '</div>'; //tppqw-container

    }
}
wp_reset_postdata();

//wp_dbug($products);
//------------------------------------------------------------------------------------

do_action('tppqw_enqueue_scripts_and_style_box');

function tppqw_create_product_gallery($image_id = false,$gallery_image_ids = false){
    $change_thumbnail_by = get_option('tppqw_change_thumbnail_by');
    $show_gallery = get_option('tppqw_show_gallery');

    $gallery_html = '';
    if($image_id && $gallery_image_ids){
        array_unshift($gallery_image_ids,$image_id);
        $gallery_ids = $gallery_image_ids;
    }
    elseif($image_id && !$gallery_image_ids){
        $gallery_ids = array($image_id);
    }
    elseif(!$image_id && $gallery_image_ids){
        $gallery_ids = $gallery_image_ids;
    }
    else{
        $gallery_ids = false;
    }

    if($gallery_ids){
        $num = count($gallery_ids);
        $gallery_big_loop = '';
        $gallery_thumbnail_loop = '';
        $gallery_slider_thumbnail_loop = '';
        $i = 1;
        
        $gallery_slider_thumbnail_loop .= '<ul class="slides">';
        if($num > 1){
            $thumbnail_one_arr = wp_get_attachment_image_src($gallery_ids[0],'woocommerce_gallery_thumbnail');
            $big_one_arr = wp_get_attachment_image_src($gallery_ids[0],'woocommerce_single');
            $thumbnail_one_src = $thumbnail_one_arr[0];
            $big_one_src = $big_one_arr[0];
            //wp_dbug($thumbnail_one_src);
            //wp_dbug($big_one_src);
            $gallery_thumbnail_loop .= '<img src="'.$thumbnail_one_src.'" data-bigsrc="'.$big_one_src.'" '.$change_thumbnail_by.'="tppqw_change_image(this);">';

            $gallery_slider_thumbnail_loop .= '<li><img src="'.$thumbnail_one_src.'" data-bigsrc="'.$big_one_src.'" '.$change_thumbnail_by.'="tppqw_change_image(this);"></li>';
        }

        foreach ($gallery_ids as $gallery_id) {
            $thumbnail_arr = wp_get_attachment_image_src($gallery_id,'woocommerce_gallery_thumbnail');
            $big_arr = wp_get_attachment_image_src($gallery_id,'woocommerce_single');

            $thumbnail_src = $thumbnail_arr[0];
            $big_src = $big_arr[0];

            if($i == 1){
                $gallery_big_loop .= '<div class="tppqw-gallery-main-image" id="tppqw-gallery-main-image">';
                    $gallery_big_loop .= '<img src="'.$big_src.'" id="tppqw-gallery-main-image-src">';
                $gallery_big_loop .= '</div>';
            }
            else{
                $gallery_thumbnail_loop .= '<img src="'.$thumbnail_src.'" data-bigsrc="'.$big_src.'" '.$change_thumbnail_by.'="tppqw_change_image(this);">';

                $gallery_slider_thumbnail_loop .= '<li><img src="'.$thumbnail_src.'" data-bigsrc="'.$big_src.'" '.$change_thumbnail_by.'="tppqw_change_image(this);"></li>';
            }
            $i++;
        }

        $gallery_slider_thumbnail_loop .= '</ul>';

        if(!$show_gallery){
            $gallery_thumbnail_loop = '';
        }

        $gallery_load = '<div class="tppqwlds-mask" id="tppqwlds-mask"><div class="tppqwlds-ripple"><div></div><div></div></div></div>';

        $gallery_html .= '<div class="tppqw-gallery">'.$gallery_load.' '.$gallery_big_loop.'<div class="tppqw-gallery-thumbnail-images">'.$gallery_thumbnail_loop.'</div></div>';

        //$gallery_html .= '<div class="tppqw-gallery">'.$gallery_big_loop.'<div class="tppqw-gallery-thumbnail-images carousel">'.$gallery_slider_thumbnail_loop.'</div></div>';
    }
    return $gallery_html;
}

?>
<script>
jQuery( document ).ready(function() {

});

function tppqw_change_image(el) {
    var src = jQuery(el).data("bigsrc");
    jQuery("#tppqw-gallery-main-image-src").attr("src",src);
}

</script>
<style>
* {
  scrollbar-width: thin;
  scrollbar-color: #999 #f5f5f5;
  box-sizing:border-box;
}

/* Works on Chrome, Edge, and Safari */
*::-webkit-scrollbar {
  width: 12px;
}

*::-webkit-scrollbar-track {
  background: #f5f5f5;
  padding:3px 0;
}

*::-webkit-scrollbar-thumb {
  background-color: #999;
  border-radius: 8px;
  border: 3px solid #f5f5f5;
}
html,body{
    padding: 0 !important;
    margin: 0 !important;
    overflow-x: hidden;
    background: #fff;
    direction: <?php echo $direction; ?>;
    text-align: <?php echo $text_align; ?>;
}

#wpadminbar,
#tp-compare-link{
    display: none;
}
.tppqw-container{
    width: 100%;
    float: right;
    padding: 15px;
    font-size: 15px;
    position: relative;
}
button, input, select, optgroup, textarea{
    font-size: 1em;
}
button, [type="button"], [type="reset"], [type="submit"]{
    padding: 15px;
}
input[type="text"],
input[type="email"],
input[type="url"],
input[type="password"],
input[type="search"],
input[type="number"],
input[type="tel"],
input[type="range"],
input[type="date"],
input[type="month"],
input[type="week"],
input[type="time"],
input[type="datetime"],
input[type="datetime-local"],
input[type="color"],
textarea,
select{
    padding: 10px;
    font-size: 1em;
}
.tppqw-container a.added_to_cart{
    margin: 0 20px;
}
.tppqw-left{
    position: relative;
    width: 100%;
    float: left;
    margin: 0 0 20px;
}
.rtl .tppqw-left{
    float: right;
}
.tppqw-onsale{
    position: absolute;
    width: 45px;
    height: 45px;
    line-height: 45px;
    font-weight: 400;
    background: #e54b4b;
    font-size: .6666em;
    border-radius: 100%;
    text-transform: uppercase;
    color: #fff;
    text-align: center;
    letter-spacing: 1px;
    left: 15px;
    top: 15px;
    z-index: 3;
}
.tppqw-right{
    width: 100%;
    float: right;
}
.rtl .tppqw-right{
    float: left;
}
.tppqw-container h1{
    margin: 0 0 10 0;
    font-size: 1.5em;
}
.tppqw-attributes{
    margin: 0 0 10px 0;
}
.tppqw-attributes table tr th{
    border: none;
    background: none;
}
.tppqw-price{
    margin: 0 0 10px 0;
}
.tppqw-description{
    margin: 0 0 10px 0;
}
.tppqw-categories{
    margin: 0 0 10px 0;
}
.tppqw-tags{
    margin: 0 0 10px 0;
}
.tppqw-gallery{
    position: relative;
}
.tppqw-gallery-thumbnail-images{

}
.tppqw-more-details{

}
.tppqw-more-details span{
    
}
.tppqw-gallery-thumbnail-images img{
    width: 60px;
    height: 60px;
    margin: 3px 3px 3px 0px;
    display: inline-block;
}

/* .tppqw-rating {
    margin: 0 0 20px;
} */

.tppqw-addtocart{
    width: 100%;
    float: left;
    padding: 0 0 0 0;
    margin: 0 0 10px 0;
}
.tppqw-addtocart .quantity{
    width: 100%;
    /* float: left; */
    margin: 15px 0;
    text-align: center;
}
.quantity .input-text{
    width: 90%;
    padding: 7px;
}
.woocommerce-variation-price{
    margin: 15px 0;
}
.rtl .tppqw-addtocart .quantity{
    /* float: right;
    margin: 0 0 0 15px; */
}
.tppqw-right table tr td{
    color: #343434;
    padding: 5px 10px;
}

.tppqw-right table{
    
    margin: 0px;
}

.tppqw-related-products .flex-pauseplay{
    display: none;
}
.flex-direction-nav a:before{
    content: '\CC400' !important;
    font-family: "fontello" !important;
    font-size: 20px !important;
}
.flex-direction-nav a.flex-next:before{
    content: '\CC401' !important;
}
.tppqw-slider-item-price,
.tppqw-slider-item-stock{
    text-align: center;
}
.tppqw-addtocart .out-of-stock,
.tppqw-slider-item-stock{
    color: #f92c2c;
}

/* <div class="tppqwlds-ripple"><div></div><div></div></div> */
.tppqwlds-mask,
.tppqwlds-mask-big{
    display: none;
    position: absolute;
    width: 100%;
    height: 100%;
    text-align: center;
    z-index: 3;
    background: rgb(255 255 255 / 80%);
    top: 0;
    right: 0;
}
.tppqwlds-ripple {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
    margin: 30% 0;
}
.tppqwlds-mask-big .tppqwlds-ripple{
    margin: 20% 0;
}
.tppqwlds-ripple div {
    position: absolute;
    border: 4px solid <?php echo $loading_color; ?>;
    opacity: 1;
    border-radius: 50%;
    animation: tppqwlds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.tppqwlds-ripple div:nth-child(2) {
    animation-delay: -0.5s;
}

.single_add_to_cart_button{
    width: 100%;
    padding: 10px;
    font-size: 1em;
}
#tppqw-gallery-main-image-src{
    width: 100%;
}
.tp-number-style input[type='number'] {
    background: none;
    border: 2px solid;
    border-radius: 5px;
    box-shadow: none;
    height: 40px;
}
table.variations{
    background:none;
    border:none;
    width:100%;
}
table.variations tr,
table.variations td{
    background:none;
    border:none;
}
table.variations td {
    background: none;
    padding: 5px 0;
}
table.variations td select {
    background: none;
    width: 100%;
    height: auto !important;
    max-height: inherit !important;
    padding: 10px !important;
}
table.variations td.label {
    height: auto !important;
    max-height: inherit !important;
    padding: 10px !important;
}
table tbody>tr:nth-child(odd)>td, table tbody>tr:nth-child(odd)>th{
    background: none;
}
.tppqw-grouped .single_add_to_cart_button{
    margin: 15px 0 0 0;
}

.tppqw-grouped .quantity .tp-number-style span{
    width: 20px;
    height: 20px;
    margin: 0 5px;
}
.tppqw-grouped .quantity{
    width: 100% !important;
    margin: 10px 0;
}

@media (min-width: 768px){
    .tppqw-left{
        width: 40%;
        margin: 0;
    }
    .tppqw-right {
        width: 58%;
    }
    .tppqw-addtocart .quantity {
        width: 35%;
        margin: 0 15px 0 0;
        text-align: initial;
        float: left;
    }
    .single_add_to_cart_button{
        width: auto;
        /* float:right; */
        margin: 0 0 0 0;
        min-width: 165px;
        padding: 10px;
        font-size: 1em;
    }

    .tppqw-grouped .quantity .tp-number-style span{
        width: 30px;
        height: 30px;
        margin: 0 10px;
    }
    .tppqw-grouped .quantity{
        width: 80%;
    }
    
}

@keyframes tppqwlds-ripple {
    0% {
        top: 36px;
        left: 36px;
        width: 0;
        height: 0;
        opacity: 1;
    }
    100% {
        top: 0px;
        left: 0px;
        width: 72px;
        height: 72px;
        opacity: 0;
    }
}
</style>

<?php wp_footer(); ?>

<!-- <script>

</script> -->