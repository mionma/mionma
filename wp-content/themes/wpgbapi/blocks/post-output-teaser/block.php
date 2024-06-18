<?php if( isset($block) && is_array($block) && array_key_exists( 'is_preview', $block['data'] ) ) : ?>
    <img src="<?php echo get_stylesheet_directory_uri() . '/blocks/post-output-teaser/gbprev.jpg'; ?>" style="width:100%; height:auto;">
<?php else : ?>

    <section class="block-post-output-teaser">

        <div class="block-inner s1x-constraint">

            <?php
            // get current ID to exclude from get posts if this id is a post
            $current_post_id = get_the_ID();

            // get published faq posts
            $args = array(
                'post_type'   => 'post',
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
                        <div class="info">
                            <div class="date">
                                <?php echo get_the_time(get_option('date_format'), $post->ID);  ?>
                            </div>
                            <div class="s1x-categories">
                                <?php $t = get_the_terms($post->ID, 'category'); ?>
                                <?php if( is_array($t) ) : ?>
                                    <?php if( count($t) > 0 ) : ?>
                                        <?php foreach( $t as $value ) : ?>
                                            <div class="s1x-category">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="9.674" height="10.265" viewBox="0 0 9.674 10.265">
                                                    <g id="angle-double-right" transform="translate(-0.739 -0.005)">
                                                        <path id="Pfad_9" data-name="Pfad 9" d="M15.664,4.081,11.587,0,10.68.912l4.076,4.076a.21.21,0,0,1,0,.3L10.68,9.36l.907.909,4.076-4.076a1.494,1.494,0,0,0,0-2.113Z" transform="translate(-5.688)" fill="#fff"/>
                                                        <path id="Pfad_10" data-name="Pfad 10" d="M6.326,4.682,1.646,0,.739.912,4.963,5.136.739,9.36l.907.909,4.68-4.68a.642.642,0,0,0,0-.908Z" fill="#fff"/>
                                                    </g>
                                                </svg>
                                                <?php echo $value->name; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
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
                            <img width="<?php echo $image['width']; ?>"
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
