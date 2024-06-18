<?php if( isset($block) && is_array($block) && array_key_exists( 'is_preview', $block['data'] ) ) : ?>
    <img src="<?php echo get_stylesheet_directory_uri() . '/blocks/impressum-used-cc-media/gbprev.jpg'; ?>" style="width:100%; height:auto;">
<?php else : ?>

    <section class="block-impressum-used-cc-media">

        <div class="block-inner s1x-constraint-narrow s1x-padding">

            <div class="text-container">

                <h2>Quellennachweis Bilder unter CC Lizenz</h2>

                <ul>
                <?php
                $image_ids = get_posts(
                    array(
                        'post_type'      => 'attachment',
                        'post_mime_type' => 'image',
                        'post_status'    => 'inherit',
                        'posts_per_page' => -1,
                        'fields'         => 'ids',
                    ) );
                ?>

                <?php foreach ( $image_ids as $id ) : ?>
                    <?php if( $text = get_field('creativecommons_image_author_text', $id) ) : ?>
                        <li><?php echo $text; ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
                </ul>

            </div>

        </div>

    </section>

<?php endif; ?>
