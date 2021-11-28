<?php

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Cheating, huh? Direct access to this file is not allowed !!!!' );
class WPCS_Shortcode {
    /**
     * WPCS_Shortcode constructor.
     */
    public function __construct()
    {
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )  {
            add_shortcode("wpcs", array($this, 'shortcode_output'));
        }


    }

    /**
     * It outputs the shortcode content
     * @param array $atts The shortcode attributes provided as key-value paired in an array
     * @param mixed $content
     * @return string
     */
    public 	function shortcode_output($atts, $content = null ) {

        ob_start();

        $atts = shortcode_atts(
            array(
                'id' => "",

            ), $atts);

        wp_enqueue_script( 'wpcs-owl-carousel-js' );
        wp_enqueue_script( 'wpcs-custom-js' );
        wp_enqueue_style( 'wpcs-owl-carousel-style' );
        wp_enqueue_style( 'wpcs-owl-theme-style' );
        wp_enqueue_style( 'wpcs-font-awesome' );
        wp_enqueue_style( 'wpcs-custom-style' );


        $post_id = $atts['id'];

        // get the array of data from the post meta
        $enc_data = get_post_meta( $post_id, 'wpcs', true ); // we can also extract the full var to get easy access and then before using the value of the variable, a check should be done using the empty().
        $data_array = WooCommerce_Product_Carousel_Slider::unserialize_and_decode24($enc_data);
        $data_array = is_array($data_array) ? $data_array : array();
        extract($data_array); // lets extract the array as we know all the vars names and check all the vars before using in the input field. it helps to reduce codes without losing tight security.

        $rand_ID = rand();


        // sanitize the var which needs to be used more than once. This way we can save some codes.

        $products_type = !empty($products_type) ? $products_type : 'latest';
        $img_crop = !empty($img_crop) ? $img_crop : 'yes';
        $crop_image_width = !empty($crop_image_width) ? intval($crop_image_width) : 300;
        $crop_image_height = !empty($crop_image_height) ? intval($crop_image_height) : 300;

        $common_args = array(
            'post_type'      => 'product',
            'posts_per_page' => !empty($total_products) ? intval($total_products) : 12,
            'post_status'    => 'publish',
            'meta_query'     => array(
                array(
                    'key' => '_stock_status',
                    'value' => 'outofstock',
                    'compare' => 'NOT IN'
                )
            )
        );

        if ($products_type == "latest") {
            $args = $common_args;
        }

        elseif ($products_type == "older") {
            $older_args = array(
                'orderby'     => 'date',
                'order'       => 'ASC'
            );
            $args = array_merge($common_args, $older_args);
        }

        elseif ($products_type == "featured") {
            $meta_query  = WC()->query->get_meta_query();
            $tax_query   = WC()->query->get_tax_query();

            $tax_query[] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN',
            );



            $featured_args = array(
                'meta_query' => $meta_query,
                'tax_query' => $tax_query,
            );
            $args = array_merge($common_args, $featured_args);
        }

        else {
            $args = $common_args;
        }
        ?>
        <div class="wpcs_product_carousel_slider">
        <?php 
        $loop = new WP_Query( $args );
        if ( $loop->have_posts() ): ?>
        
            <style type="text/css">

                .wpcs_product_carousel_slider .another_carousel_header i.prev-<?php echo $rand_ID; ?>,
                .wpcs_product_carousel_slider .another_carousel_header i.next-<?php echo $rand_ID; ?> {
                <?php echo !empty($nav_arrow_bg_color) ? 'background-color:'.esc_html($nav_arrow_bg_color) : ''; ?>;
                <?php echo !empty($nav_arrow_color) ? 'color:'.esc_html($nav_arrow_color) : ''; ?>;
                }
                .wpcs_product_carousel_slider .another_carousel_header i.fa-angle-left.prev-<?php echo $rand_ID; ?>:hover,
                .wpcs_product_carousel_slider .another_carousel_header i.fa-angle-right.next-<?php echo $rand_ID; ?>:hover {
                <?php echo !empty($nav_arrow_bg_hover_color) ? 'background-color:'.esc_html($nav_arrow_bg_hover_color) : ''; ?>;
                <?php echo !empty($nav_arrow_hover_color) ? 'color:'.esc_html($nav_arrow_hover_color) : ''; ?>;
                }

                #woo-product-carousel-wrapper-<?php echo $rand_ID; ?> .owl-item .item h4.product_name {
                <?php echo !empty($title_font_size) ? 'font-size:'.esc_html($title_font_size) : ''; ?>;
                }
                #woo-product-carousel-wrapper-<?php echo $rand_ID; ?> .owl-item .item h4.product_name a {
                <?php echo !empty($title_font_color) ? 'color:'.esc_html($title_font_color) : ''; ?>;

                }
                #woo-product-carousel-wrapper-<?php echo $rand_ID; ?> .owl-item .item h4.product_name a:hover {
                <?php echo !empty($title_hover_font_color) ? 'color:'.esc_html($title_hover_font_color) : ''; ?>;

                }
                #woo-product-carousel-wrapper-<?php echo $rand_ID; ?> .owl-item .item .price {
                <?php echo !empty($price_font_size) ? 'font-size:'.esc_html($price_font_size) : ''; ?>;

                }
                #woo-product-carousel-wrapper-<?php echo $rand_ID; ?> .price,
                #woo-product-carousel-wrapper-<?php echo $rand_ID; ?> .price ins {
                <?php echo !empty($price_font_color) ? 'color:'.esc_html($price_font_color) : ''; ?>;

                }

                #woo-product-carousel-wrapper-<?php echo $rand_ID; ?> .wpcs_rating .woocommerce-product-rating {
                <?php echo !empty($ratings_color) ? 'color:'.esc_html($ratings_color) : ''; ?>;

                }
                #woo-product-carousel-wrapper-<?php echo $rand_ID; ?> .woocommerce .star-rating {
                <?php echo !empty($ratings_size) ? 'font-size:'.esc_html($ratings_size) : ''; ?>;

                }
                #woo-product-carousel-wrapper-<?php echo $rand_ID; ?> .owl-item .item .cart .add_to_cart_button,
                #woo-product-carousel-wrapper-<?php echo $rand_ID; ?> .owl-item .item .cart a.added_to_cart.wc-forward {
                <?php echo !empty($cart_font_color) ? 'color:'.esc_html($cart_font_color) : ''; ?>;

                <?php echo !empty($cart_bg_color) ? 'background-color:'.esc_html($cart_bg_color) : ''; ?>;

                <?php echo !empty($cart_bg_color) ? 'border-color:'.esc_html($cart_bg_color) : ''; ?>;

                <?php echo !empty($cart_font_size) ? 'font-size:'.esc_html($cart_font_size) : ''; ?>;

                }
                #woo-product-carousel-wrapper-<?php echo $rand_ID; ?> .owl-item .item .cart .add_to_cart_button:hover,
                #woo-product-carousel-wrapper-<?php echo $rand_ID; ?> .owl-item .item .cart a.added_to_cart.wc-forward:hover {
                <?php echo !empty($cart_button_hover_color) ? 'background-color:'.esc_html($cart_button_hover_color) : ''; ?>;
                <?php echo !empty($cart_button_hover_color) ? 'border-color:'.esc_html($cart_button_hover_color) : ''; ?>;
                <?php echo !empty($cart_button_hover_font_color) ? 'color:'.esc_html($cart_button_hover_font_color) : ''; ?>;

                }

                .wpcs_product_carousel_slider .owl-item .item h4.product_name a {
                    font-weight: 600;
                    text-decoration: none;
                    border: 0;
                    box-shadow: none;
                    white-space: <?php if( empty($display_full_title) || 'yes' == $display_full_title) { echo "normal";} else { echo "nowrap";}?>;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    display: block;
                    color: #444444;
                    webkit-transition: all 0.4s linear;
                    -moz-transition: all 0.4s linear;
                    -ms-transition: all 0.4s linear;
                    -o-transition: all 0.4s linear;
                    transition: all 0.4s linear;
                }

            </style>

            <?php
            if(!empty($display_header) && $display_header == "yes") { ?>
                <div class="another_carousel_header">
                    <div class="title"
                         style="
                         <?php echo !empty($header_title_font_size) ? 'font-size:'.esc_html($header_title_font_size) : ''; ?>;
                         <?php echo !empty($header_title_font_color) ? 'color:'.esc_html($header_title_font_color) : ''; ?>;
                                 "
                    >
                        <?php echo !empty($title) ? esc_html($title): ''; ?>
                    </div>
                    <?php if (!empty($display_navigation_arrows) && $display_navigation_arrows == 'yes') { ?>
                        <i class="fa fa-angle-left prev-<?php echo $rand_ID; ?>"></i>
                        <i class="fa fa-angle-right next-<?php echo $rand_ID; ?>"></i>
                    <?php } ?>
                </div>
                <?php
            } else { ?>
                <div class="another_carousel_header">
                    <?php if (!empty($display_navigation_arrows) && $display_navigation_arrows == 'yes') { ?>
                        <i class="fa fa-angle-left prev-<?php echo $rand_ID; ?>"></i>
                        <i class="fa fa-angle-right next-<?php echo $rand_ID; ?>"></i>
                    <?php } ?>
                </div>
            <?php } ?>

            <div id="woo-product-carousel-wrapper-<?php echo $rand_ID; ?>" class="owl-carousel owl-theme">
                <?php while ( $loop->have_posts() ) : $loop->the_post(); global $post, $product; ?>
                    <div class="item">
                        <?php
                        $thumb = get_post_thumbnail_id();
                        // crop the image if the cropping is enabled.
                        if ('yes' === $img_crop){
                            $wpcs_img = wpcs_image_cropping($thumb, $crop_image_width, $crop_image_height, true, 100)['url'];
                        }else{
                            $aazz_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large' );
                            $wpcs_img = $aazz_thumb['0'];
                        }
                        ?>
                        <!-- <div class="product_container"> -->
                            <!-- <div class="product_image_container">
                                <a id="id-<?php the_id(); ?>" class="product_thumb_link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php
                                        if (has_post_thumbnail( $loop->post->ID )) { echo '<img src="'.esc_url($wpcs_img).'" class="wpcs-thum" alt="'.get_the_title().'" />'; } else { echo '<img src="'.wc_placeholder_img_src().'" alt="Product Image" />'; }

                                    ?>
                                </a>
                            </div>
                            <div class="caption">
                                <?php
                                if (!empty($display_product_title) && $display_product_title == 'yes') { ?>
                                    <h4 class="product_name"><a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                                <?php }
                                if (!empty($display_price) && $display_price == 'yes') { ?>
                                    <span class="price"><?php echo $product->get_price_html(); ?></span>
                                <?php }
                                if (!empty($display_ratings) && $display_ratings == 'yes') {
                                    $rating = (($product->get_average_rating()/5)*100); ?>
                                    <div class="wpcs_rating woocommerce"><div class="woocommerce-product-rating"><div class="star-rating" title="<?php echo $rating; ?>%"><span style="width: <?php echo $rating; ?>%;"></span></div></div></div>
                                <?php }
                                if (!empty($display_cart) && $display_cart == 'yes') { ?>
                                    <div class="cart"><?php echo do_shortcode('[add_to_cart id="'.get_the_ID().'"]') ?></div>
                                <?php } ?>
                            </div> -->
                            <div class='product'>
                                <div class='ladi-frame ladi-transition'>
                                    <div class="ladi-frame-background"></div>
                                    <div id="BOX723" class='ladi-element'>
                                        <div class='ladi-box'></div>
                                    </div>
                                    <div id="IMAGE724" class='ladi-element thumbnail'>
                                        
                                        <div class='ladi-image'>
                                            <div class="ladi-image-background">
                                            <?php
                                            if (has_post_thumbnail( $loop->post->ID )) { echo '<img src="'.esc_url($wpcs_img).'" class="wpcs-thum" style="width:100%" alt="'.get_the_title().'" />'; } else { echo '<img src="'.wc_placeholder_img_src().'" alt="Product Image" />'; }

                                        ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="HEADLINE727" class='ladi-element'>
                                        <h3 class='ladi-headline'>Đã bán 1,3k</h3>
                                    </div>
                                    <div id="IMAGE728" class='ladi-element'>
                                        <div class='ladi-image'>
                                            <div class="ladi-image-background"></div>
                                        </div>
                                    </div>
                                    <div id="SHAPE729" class='ladi-element'>
                                        <div class='ladi-shape'><svg xmlns="http://www.w3.org/2000/svg" width="100%"
                                                height="100%" preserveAspectRatio="none" viewBox="0 0 1792 1896.0833"
                                                class="" fill="#000">
                                                <path
                                                    d="M1664 596q0-81-21.5-143t-55-98.5T1506 295t-94-31-98-8-112 25.5-110.5 64-86.5 72-60 61.5q-18 22-49 22t-49-22q-24-28-60-61.5t-86.5-72-110.5-64T478 256t-98 8-94 31-81.5 59.5-55 98.5T128 596q0 168 187 355l581 560 580-559q188-188 188-356zm128 0q0 221-229 450l-623 600q-18 18-44 18t-44-18l-624-602q-10-8-27.5-26T145 952.5 77 855 23.5 734 0 596q0-220 127-344t351-124q62 0 126.5 21.5t120 58T820 276t76 68q36-36 76-68t95.5-68.5 120-58T1314 128q224 0 351 124t127 344z">
                                                </path>
                                            </svg></div>
                                    </div>
                                
                                    
                                    
                                    <div id="HEADLINE737" class='ladi-element'>
                                        <h3 class='ladi-headline'><?php the_title(); ?></h3>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                    <!-- </div> -->
                <?php endwhile; wp_reset_postdata(); ?>
            </div> <!-- End woo-product-carousel-wrapper -->
            <?php else:
                esc_html_e('No products found', WPCS_TEXTDOMAIN);
            endif; ?>
        </div> <!-- End wpcs_product_carousel_slider -->

        <script type="text/javascript">
            jQuery(document).ready(function($) {

                var $wpcs = $("#woo-product-carousel-wrapper-<?= $rand_ID; ?>");

                $wpcs.owlCarousel({

                    /*updated code of the carousel for the version 2.2.1*/
                    rewind:false,
                    loop:<?php echo (!empty($repeat_product) && 'no' == $repeat_product) ? 'false' : 'true';?>,
                    autoWidth:false,
                    responsiveClass:true,
                    autoplayHoverPause:false,
                    autoplay:<?= (!empty( $auto_play) && 'true'== $auto_play) ? 'true':'false'; ?>,

                    dots:<?= (!empty( $pagination) && 'true'== $pagination)? 'true':'false'; ?>,
                    autoplayTimeout: <?= (!empty($slide_speed)) ? (int) $slide_speed : 4000; ?>,
                    dotData:true,
                    dotsEach:false,
                    rtl:<?= is_rtl() ? 'true': 'false'; ?>,
                    slideBy:<?= (!empty( $spp) && 'true' === $spp) ? '\'page\'' : ((!empty( $scrol_dir) && 'right'== $scrol_dir) ? -1 : 1); ?>,
                    nav:false, // we are using custom navigation arrow, so lets turn the default navigation off
                    navText:['‹','›'],
                    smartSpeed: 1000, // it smooths the transition, and it should be lower than the speed of the auto play
                    responsive:{
                        0 : {
                            items:1
                        },
                        350: {
                            items:<?= (!empty( $mobile_items )) ? absint( $mobile_items ):2; ?>
                        },
                        480: {
                            items:<?= (!empty( $mobile_items )) ? (absint( $mobile_items )):3; ?>
                        },
                        600 : {
                            items:<?= (!empty( $tablet_items)) ? (absint( $tablet_items )):3; ?>
                        },
                        768:{
                            items:<?= (!empty( $tablet_items)) ? absint( $tablet_items ):4; ?>
                        },
                        978:{
                            items:<?= (!empty( $laptop_items)) ? absint( $laptop_items ):4; ?>
                        },
                        1198:{
                            items:<?= (!empty( $items)) ? absint( $items):5; ?>
                        }
                    }


                });


                // stop on hover but play after hover out
                <?php if((!empty( $stop_on_hover) && 'true'== $stop_on_hover)){ ?>
                $wpcs.hover(
                    function(){
                        $wpcs.trigger('stop.owl.autoplay');
                    },
                    function(){
                        $wpcs.trigger('play.owl.autoplay');
                    }
                );
                <?php } ?>

                // custom navigation for the owl carousel
                $(".next-<?= $rand_ID; ?>").click(function(){
                    $wpcs.trigger("next.owl.carousel");
                });

                $(".prev-<?= $rand_ID; ?>").click(function(){
                    $wpcs.trigger("prev.owl.carousel");
                });

            });
        </script>
        <?php

        $carousel_content = ob_get_clean();
        return $carousel_content;

    }

}

