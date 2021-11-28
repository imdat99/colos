<div class='product'>
                            <div class='ladi-frame ladi-transition'>
                                <div class="ladi-frame-background"></div>
                                <div id="BOX723" class='ladi-element'>
                                    <div class='ladi-box'></div>
                                </div>
                                <div id="IMAGE724" class='ladi-element'>
                                    <div class='ladi-image'>
                                        <div class="ladi-image-background"></div>
                                    </div>
                                </div>
                                <div id="IMAGE725" class='ladi-element'>
                                    <div class='ladi-image'>
                                        <div class="ladi-image-background"></div>
                                    </div>
                                </div>
                                <div id="HEADLINE726" class='ladi-element'>
                                    <h3 class='ladi-headline'>Hà Nội</h3>
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
                                <div id="HEADLINE730" class='ladi-element'>
                                    <h3 class='ladi-headline'>919.000</h3>
                                </div>
                                <div id="HEADLINE731" class='ladi-element'>
                                    <h3 class='ladi-headline'>đ</h3>
                                </div>
                                <div id="LINE732" class='ladi-element'>
                                    <div class='ladi-line'>
                                        <div class="ladi-line-container"></div>
                                    </div>
                                </div>
                                <div id="HEADLINE733" class='ladi-element'>
                                    <h3 class='ladi-headline'>đ</h3>
                                </div>
                                <div id="HEADLINE734" class='ladi-element'>
                                    <h3 class='ladi-headline'>950.000</h3>
                                </div>
                                <div id="BUTTON735" class='ladi-element'>
                                    <div class='ladi-button'>
                                        <div class="ladi-button-background"></div>
                                        <div id="BUTTON_TEXT735" class='ladi-element'>
                                            <p class='ladi-headline'>Mua để nhận quà</p>
                                        </div>
                                    </div>
                                </div>
                                <div id="HEADLINE737" class='ladi-element'>
                                    <h3 class='ladi-headline'>Sữa bột Colosmulti IQ Chính Hãng hỗ trợ phát triển
                                        chiều cao và trí thông minh cho trẻ</h3>
                                </div>
                                <div id="IMAGE740" class='ladi-element'>
                                    <div class='ladi-image'>
                                        <div class="ladi-image-background"></div>
                                    </div>
                                </div>
                            </div>
                        </div>


 <div class="product_image_container">
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
                            </div>


                            <!-- <div class='product'>
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
                                    <div id="IMAGE740" class='ladi-element'>
                                        <div class='ladi-image'>
                                            <div class="ladi-image-background"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->