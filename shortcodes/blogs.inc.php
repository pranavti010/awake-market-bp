<?php
// ..................................
// Render Editor's pick
// ..................................
function renderEditorsPicks($atts = []) {
    ob_start();
    $categoryName = $className = $leftSectionClassName = $rightSectionClassName = "";
    $displayLayout = 1;
    $leftSectionBlogs = $rightSectionBlogs = [];
    $args = array(
        'post_type' => 'post',
        'post_status' => array('publish','private'),
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => 3
    );
    if(isset($atts['display_layout']) && !empty($atts['display_layout'])) {
        $displayLayout = $atts['display_layout'];
        if($displayLayout == "2") {
            $args['posts_per_page'] = 4;
        }
    }
    if(isset($atts) && !empty($atts) && isset($atts['for_author'])) $args['author'] = $atts['for_author'];
    $allBlogs = get_posts($args);
    $totalBlogs = count($allBlogs);
    foreach ($allBlogs as $key => $blog) {
        if ($totalBlogs == 1) {
            $leftSectionClassName = "col-sm-12";
            array_push($leftSectionBlogs, $blog);
        }
        else {
            if($displayLayout == "1") {
                if($key == 0) {
                    $leftSectionClassName = "col-sm-8";
                    array_push($leftSectionBlogs, $blog);
                }
                else {
                    $rightSectionClassName = "col-sm-4";
                    array_push($rightSectionBlogs, $blog);
                }
            }
            elseif($displayLayout == "2") {
                list($array1, $array2) = array_chunk($allBlogs, ceil(count($allBlogs) / 2));
                $rightSectionBlogs = $array1;
                $leftSectionBlogs = $array2;
                $leftSectionClassName = $rightSectionClassName = "col-sm-6";
            }
            elseif($displayLayout == "3"){
                if($key == ($totalBlogs - 1)) {
                    $rightSectionClassName = "col-sm-8";
                    array_push($rightSectionBlogs, $blog);
                }
                else {
                    $leftSectionClassName = "col-sm-4";
                    array_push($leftSectionBlogs, $blog);
                }
            }
            else $className = "col-sm-4";
        }
    }

    if (count($leftSectionBlogs) > 0) : ?>
        <div class="<?php echo $leftSectionClassName; ?>">
            <?php foreach ($leftSectionBlogs as $leftSectionBlog) :
                $categoryName = "";
                $categories = get_the_category($leftSectionBlog->ID);
                if ( ! empty( $categories ) ) $categoryName = $categories[0]->name;
                ?>
                <div class="single-blog">
                    <div class="blog-image">
                        <a href="<?php echo get_permalink($leftSectionBlog->ID); ?>">
                            <?php if (has_post_thumbnail( $leftSectionBlog->ID ) ) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url($leftSectionBlog->ID,'full'); ?>" alt="">
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/img/home-blogs.jpg" alt="">
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="blog-desc">
                        <h4 class="blog-title"><?php echo $leftSectionBlog->post_title; ?></h4>
                        <!-- <p class="blog-short-desc"><?php// echo $blog['content']; ?></p> -->
                    </div>
                    <?php if(!empty($categoryName)) : ?>
                        <span class="category-badge"><p><?php echo $categoryName; ?></p></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif;
    if (count($rightSectionBlogs) > 0) : ?>
        <div class="<?php echo $rightSectionClassName; ?>">
            <?php // Iterate rightSectionBlogs
            foreach ($rightSectionBlogs as $rightSectionBlog) :
                $categoryName = "";
                $categories = get_the_category($rightSectionBlog->ID);
                if ( ! empty( $categories ) ) $categoryName = $categories[0]->name;
                ?>
                <div class="single-blog">
                    <div class="blog-image">
                        <a href="<?php echo get_permalink($rightSectionBlog->ID); ?>">
                            <?php if (has_post_thumbnail( $rightSectionBlog->ID ) ) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url($rightSectionBlog->ID,'full'); ?>" alt="">
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/img/home-blogs.jpg" alt="">
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="blog-desc">
                        <h4 class="blog-title"><?php echo $rightSectionBlog->post_title; ?></h4>
                        <!-- <p class="blog-short-desc"><?php// echo $blog['content']; ?></p> -->
                    </div>
                    <?php if(!empty($categoryName)) : ?>
                        <span class="category-badge"><p><?php echo $categoryName; ?></p></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif;
    return ob_get_clean();
}
add_shortcode('awake_editors_picks','renderEditorsPicks');
?>
