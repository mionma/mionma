<?php if( isset($block) && is_array($block) && array_key_exists( 'is_preview', $block['data'] ) ) : ?>
    <img src="<?php echo get_stylesheet_directory_uri() . '/blocks/header/gbprev.jpg'; ?>" style="width:100%; height:auto;">
<?php else : ?>

    <section class="block-header">

        <?php if ($video = get_field('postobject_headvideo', get_the_ID() )) : ?>

            <?php $class = 'video'; ?>
            <?php $video_poster = get_field( 'postobject_headvideo_lqposter', get_the_ID() ); ?>
            <div class="video fileembed">
                <video class="background-video"
                       width="1920"
                       height="1080"
                       preload="none" playsinline muted loop
                       autoplay="autoplay"
                       poster="<?php echo $video_poster['url']; ?>">
                    <source src="<?php echo $video; ?>">
                </video>
            </div>

        <?php else : ?>

            <?php $class = 'image'; ?>
            <picture class="s1x-picture-bgimage-absolute">
                <?php if( $image = get_field('postobject_headimage', get_the_ID() ) ) : ?>
                    <?php echo \WPGBAPI\Base_Theme_Support::get_imagify_webp_picture_source( $image['url'] ); ?>
                    <img width="<?php echo $image['width']; ?>"
                         height="<?php echo $image['height']; ?>"
                         src="<?php echo $image['url']; ?>"
                         alt="<?php echo $image['alt']; ?>">
                <?php endif; ?>
            </picture>

        <?php endif; ?>



        <?php
        if ( ! $width = get_field('width_type') ) {
            $width = 'narrow';
        }
        ?>

        <div class="contain-<?php echo $width; ?>">
            <div class="contain-text">
                <div class="inner <?php echo $class; ?>">
                    <h1 class="head"><?php echo get_the_title(); ?></h1>
                    <p class="text"><?php echo RankMath\Post::get_meta( 'description' ); ?></p>
                </div>
            </div>
        </div>


    </section>


<?php endif; ?>
