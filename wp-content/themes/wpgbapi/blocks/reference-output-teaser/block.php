<?php if( isset($block) && is_array($block) && array_key_exists( 'is_preview', $block['data'] ) ) : ?>
    <img src="<?php echo get_stylesheet_directory_uri() . '/blocks/reference-output-teaser/gbprev.jpg'; ?>" style="width:100%; height:auto;">
<?php else : ?>

    <section class="block-reference-output-teaser">

        <div class="block-inner s1x-constraint">

            <?php
            // get current ID to exclude from get posts if this id is a post
            $current_post_id = get_the_ID();

            // get published faq posts
            $args = array(
                'post_type'   => 'cpt-references',
                'numberposts' =>  4,
                'orderby'     => 'post_date',
                'order'       => 'DESC',
                'post_status' => 'publish',
            );
            $posts = get_posts($args);

            // sort posts array to get next two posts
            $current_post_array_index = 0;
            $get_offset = 0;

            // run through array and find current post if available
            foreach ($posts as $key => $value) {
                if ($value->ID === $current_post_id) {
                    // set current post array index as current key
                    $current_post_array_index = $key;
                    // set get offset to 1 to get next 4 posts
                    $get_offset = 1;
                }
            }
            // get next 4 posts
            $tmp_posts = array_splice($posts, $current_post_array_index + $get_offset, 2);
            // if array ended before 4 posts
            if (count($tmp_posts) < 2) {
                if (count($tmp_posts) == 0) {
                    $length = 2;
                }
                if (count($tmp_posts) == 1) {
                    $length = 1;
                }
                // get posts from array start
                $tmp_posts_fill = array_splice($posts, 0, $length);
                // overwrite $posts array with results
                $posts = array_merge($tmp_posts, $tmp_posts_fill);
            } else {
                // overwrite $posts array with results
                $posts = $tmp_posts;
            }


            foreach ($posts as $post) : ?>

                <?php $bgimage = get_the_post_thumbnail_url($post->ID); ?>
                <div class="post-item">

                    <div class="inner">
                        <h3>
                            <a href="<?php echo get_the_permalink($post->ID); ?>">
                                <?php echo get_the_title($post->ID); ?>
                            </a>
                        </h3>
                        <p><?php echo RankMath\Post::get_meta( 'description', $post->ID ); ?></p>
                    </div>

                    <picture class="s1x-picture-bgimage-absolute">
                        <?php if( $image = get_field('postobject_headimage', $post->ID ) ) : ?>
                            <?php echo \WPGBAPI\Base_Theme_Support::get_imagify_webp_picture_source( $image['url'] ); ?>
                            <img loading="lazy"
                                 width="<?php echo $image['width']; ?>"
                                 height="<?php echo $image['height']; ?>"
                                 src="<?php echo $image['url']; ?>"
                                 alt="<?php echo $image['alt']; ?>">
                        <?php endif; ?>
                    </picture>

                </div>


            <?php endforeach; ?>

        </div>

    </section>

<?php endif; ?>
