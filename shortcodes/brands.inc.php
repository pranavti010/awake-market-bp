<?php
/**
* Get the Awake brands
*
* @author Jay Pagnis
*/
function renderAwakeBrands($atts = []){
    ob_start();
    $forListing = $isSlider = false;
    $totalRows = 1;
    $loadMore = "";
    if( isset($atts["loadmore"]) ) $loadMore = "loadmore='".$atts["loadmore"]."'";
    if (isset($atts['for_listing']) && !empty($atts['for_listing']) && $atts['for_listing'] == 1) $forListing = true;
    if (isset($atts['slider']) && !empty($atts['slider']) && $atts['slider'] == 1) $isSlider = true;
    for($i=1;$i<=$totalRows;$i++) : ?>
        <div count="<?php echo $atts['per_row']; ?>" imageSize="150x150" class="brands-container <?php echo $atts['container_classes']; ?>">
            <?php if($isSlider) : ?><div><?php endif; ?>
                <div class="brand-container <?php echo $atts['brand_classes']; ?>" style="display:none;">
                    <a href="demo/awake/bdp/?brand-id={{brandId}}" class="am-brand-link">
                        <img class="am-brand-image" src="https://us.awake.market/wp-content/uploads/2021/12/Display-Pic.jpg" loading="lazy" alt="">
                    </a>
                    <h4 class="am-brand-name">Brand Name</h4>
                </div>
            <?php if($isSlider) : ?></div><?php endif; ?>
        </div>
    <?php endfor; ?>
    <?php return ob_get_clean();
}
add_shortcode('awake_brands', 'renderAwakeBrands');

// ..............................
// Render Latest Brands
// ..............................
function renderLatestBrands($atts = []){
    ob_start();
    $totalRows = 1;
    $removeTemplate = "removeTemplate";
    $loadMore = "";
    if( isset($atts["loadmore"]) )
    $loadMore = "loadmore='".$atts["loadmore"]."'";
    for($i=1;$i<=$totalRows;$i++) { ?>
        <div count="<?php echo $atts['per_row']; ?>" imageSize="150x150" <?php echo $removeTemplate;?> class="brands-container <?php echo $atts['container_classes']; ?>" <?php echo $loadMore;?>>
            <div class="brand-container <?php echo $atts['brand_classes']; ?>">
                <div>
                    <div class="brand-image-container">
                        <img class="am-brand-image" src="https://us.awake.market/wp-content/uploads/2021/12/Display-Pic.jpg" loading="lazy" alt="">
                        <p class="am-brand-name"></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php return ob_get_clean();
}
add_shortcode('awake_latest_brands', 'renderLatestBrands');
?>
