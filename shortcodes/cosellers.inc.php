<?php
// ..............................
// Render cosellers section
// ..............................
function renderAwakeCosellers($atts = []) {
    ob_start();
    $forListing = $showSliderDiv = false;
    $showViewCosellerBtn = true;
    $outerClass = $atts['outer_class'];
    $wrapperClass = "cosellers-wrapper";

    // Get cosellers list
    $args = array(
        'role__in' => array('coseller'),
        'order' => 'DESC',
        'orderby' => 'date'
    );

    // Need to add other attributes here such as is_slider, slides_to_show
    if(isset($atts) && !empty($atts)) {
        if(isset($atts['per_row'])) $args['number'] = $atts['per_row'];
        if(isset($atts['for_listing'])) $forListing = true;
        if(isset($atts['show_coseller_button']) && $atts['show_coseller_button'] == 0) $showViewCosellerBtn = false;
        if(isset($atts['per_row_desktop']) && $atts['per_row_desktop'] > 0 && !wp_is_mobile()) $args['number'] = $atts['per_row_desktop'];
        if(isset($atts['per_row_mobile']) && $atts['per_row_mobile'] > 0 && wp_is_mobile()) $args['number'] = $atts['per_row_mobile'];
        if(isset($atts['order_by']) && $atts['order_by'] == 2){
            $args['orderby'] = 'post_count';
            // $args['who'] = 'authors';
        }
        if(isset($atts['order']) && $atts['order'] == 1) $args['order'] = 'ASC';
    }
    // We need to handle listing layuout conditionally
    if (!$forListing) {
        if(wp_is_mobile()) {
            $outerClass = "d-block d-sm-none";
            $wrapperClass = "m-cosellers";
            $showSliderDiv = true;
        }
        else {
            $outerClass = $atts['outer_class']." d-sm-block d-none";
        }
    }

    // Query list
    $cosellers = get_users($args);
    if(count($cosellers) > 0) : ?>
        <div class="<?php echo $outerClass; ?>"> <!-- Outer Section -->
            <div class="<?php echo $wrapperClass; ?>"> <!-- Wrapper Section -->
                <?php foreach($cosellers as $coseller) :
                    if($showSliderDiv) : ?><div><?php endif; ?>
                            <div class="<?php echo (!$showSliderDiv) ? "single-coseller" : "m-coseller"; ?>">
                                <div class="<?php echo (!$showSliderDiv) ? "cosellers-image" : "m-cosellers-image"; ?> ">
                                    <a href="<?php echo home_url('coseller'); ?>?id=<?php echo $coseller->ID; ?>"><img src="<?php echo get_avatar_url($coseller->ID); ?>" alt=""><p><?php echo $coseller->display_name; ?></p></a>
                                </div>
                            </div>
                    <?php if($showSliderDiv) : ?></div><?php endif; ?> <!-- End Wrapper Section -->
                <?php endforeach; ?>
            </div>
            <?php if(!$showSliderDiv && !$forListing) : ?>
                <div class="cosellers-buttons">
                    <?php if($showViewCosellerBtn) : ?>
                        <a href="<?php echo home_url('cosellers'); ?>" class="btn-blueRounded">View Coseller Page</a>
                    <?php endif; ?>
                    <?php if(!is_user_logged_in()) : ?>
                        <a href="<?php echo home_url('login'); ?>" class="btn-blueRounded">Be a Coseller!</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if($showSliderDiv) : ?>
                <div class="m-coseller-lower-container">
                    <div class="m-coseller-note">
                        <p>A platform for Influencers to start coselling and generate real money, real time.</p>
                    </div>
                    <?php if(!$forListing) : ?>
                        <div class="m-cosellerbutton-container">
                            <?php if($showViewCosellerBtn) : ?>
                                <a href="<?php echo home_url('cosellers'); ?>" class="btn-blueCornered">View Coseller Page</a>
                            <?php endif; ?>
                            <?php if(!is_user_logged_in()) : ?>
                                <a href="<?php echo home_url('login'); ?>" class="btn-blueCornered">Be a Coseller!</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div> <!-- End Outer Section -->
        <?php endif;
    return ob_get_clean();
}
add_shortcode('awake_cosellers','renderAwakeCosellers');
?>
