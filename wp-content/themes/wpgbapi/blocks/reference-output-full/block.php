<?php if( isset($block) && is_array($block) && array_key_exists( 'is_preview', $block['data'] ) ) : ?>
    <img src="<?php echo get_stylesheet_directory_uri() . '/blocks/reference-output-full/gbprev.jpg'; ?>" style="width:100%; height:auto;">
<?php else : ?>

    <section class="block-reference-output-full">

        <div class="block-inner s1x-constraint">

            <?php
            // get published faq posts
            $args = array(
                'post_type'   => 'cpt-references',
                'numberposts' =>  -1,
                'orderby'     => 'post_date',
                'order'       => 'DESC',
                'post_status' => 'publish',
            );
            $posts = get_posts($args);

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
