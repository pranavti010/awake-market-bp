<?php

/**
* Get the Awake products
*
* @author Jay Pagnis
*/
function renderAwakeProducts($atts = []){
    ob_start(); ?>
    <style media="screen">
    .brand-image img {
        width: 70%;
    }
    /* .products-container {
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
    } */
    </style>
    <?php
    $vendorId = $tags = $perRow = $wrapperClass = "";
    $forListing = $showSliderDiv = false;
    // We need to check whether shortcode is for listing
    if (isset($atts['for_listing']) && !empty($atts['for_listing']) && $atts['for_listing'] == 1){
        $forListing = true;
    }
    else {
        if(!wp_is_mobile()) {
            $outerClass = "d-sm-block d-none";
            $wrapperClass = "product-wrapper";
            $showSliderDiv = false;
        }
        else {
            $outerClass = "m-product-container d-block d-sm-none";
            $showSliderDiv = true;
        }
    }
    // Need to add other attributes here such as is_slider, slides_to_show
    if(isset($atts['vendor_id']) && !empty($atts['vendor_id'])) $vendorId = $atts['vendor_id'];
    if(isset($atts['per_row']) && !empty($atts['per_row'])) $perRow = $atts['per_row'];
    if(isset($atts['tags']) && !empty($atts['tags'])) $tags = "tags=".$atts['tags'];
    $totalRows = 1; ?>
    <?php if(!$forListing) :?><div class="<?php echo $outerClass; ?>"><?php endif; ?> <!-- Outer Section -->
        <?php if(!$showSliderDiv && !$forListing) : ?><div class="<?php echo $wrapperClass; ?>"><?php endif; ?> <!-- Wrapper Section -->
            <?php for($i=1;$i<=$totalRows;$i++) { ?>
                <div count="<?php echo $perRow; ?>" imageSize="150x150" vendorid="<?php echo $vendorId; ?>" <?php echo $tags; ?> class="products-container product-wrapper <?php echo ($showSliderDiv ? "m-product" : ""); ?>">
                    <?php if($showSliderDiv) : ?><div><?php endif; ?>
                        <div class="<?php echo $atts['product_classes']; ?>">
                            <div class="product-image">
                                <a href="demo/awake/pdp/?product-id={{productId}}" class="am-product-link">
                                    <img class="am-product-image" src="https://us.awake.market/wp-content/uploads/2021/12/Display-Pic.jpg" loading="lazy" alt="">
                                </a>
                            </div>
                            <div class="product-info">
                                <p class="am-product-title product-title">Product Title</p>
                                <p class="am-product-vendor brand-title">Brand Title</p>
                            </div>
                            <span class="amount-badge">XX.XX USD</span>
                        </div>
                    <?php if($showSliderDiv) : ?></div><?php endif; ?>
                </div>
            <?php } ?>
        <?php if(!$showSliderDiv && !$forListing) : ?></div><?php endif; ?> <!-- End Wrapper Section -->
    <?php if(!$forListing) :?></div><?php endif; ?>  <!-- End Outer Section -->
    <?php return ob_get_clean();
}
add_shortcode('awake_products', 'renderAwakeProducts');
?>
