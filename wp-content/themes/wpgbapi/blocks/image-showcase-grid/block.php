<?php if( isset($block) && is_array($block) && array_key_exists( 'is_preview', $block['data'] ) ) : ?>
    <img src="<?php echo get_stylesheet_directory_uri() . '/blocks/image-showcase-grid/gbprev.jpg'; ?>" style="width:100%; height:auto;">
<?php else : ?>

    <section class="block-image-showcase-grid">

        <div class="block-inner s1x-constraint swiper">

            <div class="swiper-wrapper">

            <?php $content = get_field('image_showcase_grid_content'); ?>
            <?php if( is_array($content) ) : ?>
                <?php if( count($content) > 0 ) : ?>
                    <?php foreach($content as $key => $value) : ?>

                        <div class="swiper-slide">

                            <picture class="s1x-picture-bgimage-absolute" loading="lazy">
                                <?php if( $value['image']['url'] ) : ?>
                                    <?php echo \WPGBAPI\Base_Theme_Support::get_imagify_webp_picture_source( $value['image']['url'] ); ?>
                                    <img width="<?php echo $value['image']['width']; ?>"
                                         height="<?php echo $value['image']['height']; ?>"
                                         src="<?php echo $value['image']['url']; ?>"
                                         alt="<?php echo $value['image']['alt']; ?>">
                                <?php endif; ?>
                            </picture>

                            <div class="inner">
                                <p class="title">
                                    <?php echo $key + 1 . ') ' . $value['title']; ?>
                                </p>

                                <picture loading="lazy">
                                    <?php if( $value['image']['url'] ) : ?>
                                        <?php echo \WPGBAPI\Base_Theme_Support::get_imagify_webp_picture_source( $value['image']['url'] ); ?>
                                        <img width="<?php echo $value['image']['width']; ?>"
                                             height="<?php echo $value['image']['height']; ?>"
                                             src="<?php echo $value['image']['url']; ?>"
                                             alt="<?php echo $value['image']['alt']; ?>">
                                    <?php endif; ?>
                                </picture>

                                <?php echo $value['subtext']; ?>
                            </div>

                        </div>



                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>

            </div>

            <div class="s1x-swiper-controls s1x-padding">
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev">

                    <svg xmlns="http://www.w3.org/2000/svg" width="39.552" height="39.552" viewBox="0 0 39.552 39.552">
                        <g id="Gruppe_61" data-name="Gruppe 61" transform="translate(-738.448 -956)">
                            <ellipse id="Ellipse_20" data-name="Ellipse 20" cx="18.776" cy="18.776" rx="18.776" ry="18.776" transform="translate(777 994.552) rotate(180)" fill="none" stroke="#164863" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            <g id="Gruppe_34" data-name="Gruppe 34" transform="translate(766.164 981.328) rotate(180)">
                                <g id="Gruppe_36" data-name="Gruppe 36" transform="translate(0 0)">
                                    <path id="Pfad_19" data-name="Pfad 19" d="M6,7.068H21.879L15.1,13.136l6.782-6.068L15.1,1" transform="translate(-6 -1)" fill="none" stroke="#164863" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                </g>
                            </g>
                        </g>
                    </svg>


                </div>
                <div class="swiper-button-next">

                    <svg xmlns="http://www.w3.org/2000/svg" width="39.552" height="39.552" viewBox="0 0 39.552 39.552">
                        <g id="Gruppe_60" data-name="Gruppe 60" transform="translate(-812.447 -956)">
                            <ellipse id="Ellipse_20" data-name="Ellipse 20" cx="18.776" cy="18.776" rx="18.776" ry="18.776" transform="translate(813.447 957)" fill="none" stroke="#164863" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            <g id="Gruppe_34" data-name="Gruppe 34" transform="translate(824.285 970.225)">
                                <g id="Gruppe_36" data-name="Gruppe 36" transform="translate(0 0)">
                                    <path id="Pfad_19" data-name="Pfad 19" d="M6,7.068H21.879L15.1,13.136l6.782-6.068L15.1,1" transform="translate(-6 -1)" fill="none" stroke="#164863" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                </g>
                            </g>
                        </g>
                    </svg>


                </div>
            </div>

        </div>

    </section>

<?php endif; ?>
