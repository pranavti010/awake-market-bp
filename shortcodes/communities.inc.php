<?php
// .............................
// Get BuddyPress User Groups
// .............................
function renderAwakeCommunities($atts = []){
    ob_start();
    $outerClass = $wrapperClass = "";
    $forListing = false;
    if(isset($atts['for_listing']) && $atts['for_listing'] == 1) $forListing = true;
    if(isset($atts['outer_class']) && !empty($atts['outer_class'])) $outerClass = $atts['outer_class'];
    if(isset($atts['wrapper_class']) && !empty($atts['wrapper_class'])) $wrapperClass = $atts['wrapper_class'];
    if ( bp_has_groups() ) : ?>
        <div class="<?php echo $outerClass; ?>">
            <?php if(!empty($wrapperClass)) : ?><div class="<?php echo $wrapperClass; ?>"><?php endif; ?>
                <?php while ( bp_groups() ) : bp_the_group();
                    $groupId = bp_get_group_id();
                    $coverImgUrl = get_template_directory_uri()."/img/communities-full-image.jpg";
                    $groupCoverImage = bp_attachments_get_attachment('url', array(
                        'object_dir' => 'groups',
                        'item_id' => bp_get_group_id(),
                    ));
                    $group = groups_get_group( array( 'group_id' => $groupId ) );
                    $totalMembers = 0;
                    if ( bp_group_has_members( 'group_id='.bp_get_group_id()) ) :
                        while ( bp_group_members() ) : bp_group_the_member();
                            $totalMembers++;
                        endwhile;
                    endif;
                    if(!empty($groupCoverImage)) $coverImgUrl = $groupCoverImage; ?>
                    <?php if(!$forListing) : ?>
                        <div>
                            <div class="single-community">
                                <div class="bg-container">
                                    <img src="<?php echo $coverImgUrl; ?>" alt="">
                                    <div class="thmbnail-box">
                                        <?php bp_group_avatar(); ?>
                                    </div>
                                </div>
                                <div class="community-content">
                                    <h4 class="content-header"><?php bp_group_name() ?></h4>
                                    <p><?php bp_group_type() ?></p>

                                    <?php if ( bp_group_has_members( 'group_id='.bp_get_group_id().'&per_page=3') ) : ?>
                                        <div class="members-container">
                                            <ul class="list-inline members-list">
                                                <?php while ( bp_group_members() ) : bp_group_the_member(); ?>
                                                    <li class="list-inline-item">
                                                        <?php bp_group_member_avatar(); ?>
                                                        <!-- <img src="<?php //echo get_template_directory_uri(); ?>/img/member-image.jpg" alt=""> -->
                                                    </li>
                                                <?php endwhile; ?>
                                            </ul>
                                            <?php if($totalMembers > 3) : ?>
                                                <p>+ <?php echo ($totalMembers - 3); ?> members</p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="single-group">
                            <div class="groups-image ">
                                <a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar(); ?><p><?php bp_group_name(); ?></p></a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile;?>
            <?php if(!empty($wrapperClass)) : ?></div><?php endif; ?>
        </div>
    <?php endif;
    return ob_get_clean();
}
add_shortcode('awake_communities', 'renderAwakeCommunities');
?>
