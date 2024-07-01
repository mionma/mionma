<?php if( isset($block) && is_array($block) && array_key_exists( 'is_preview', $block['data'] ) ) : ?>
    <img src="<?php echo get_stylesheet_directory_uri() . '/blocks/faq-output-accordion/gbprev.jpg'; ?>" style="width:100%; height:auto;">
<?php else : ?>

    <section class="block-faq-output-accordion">

        <div class="block-inner s1x-constraint s1x-padding">

            <div class="faq-grid" itemscope itemtype="https://schema.org/FAQPage">

                <?php
                $selected_faqs = get_field('selected_faqs');
                foreach ($selected_faqs as $post) : ?>

                    <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">

                        <div class="header">
                            <p class="headline" itemprop="name">
                                <?php echo get_the_title($post->ID); ?>
                            </p>

                            <div class="buttons">
                                <div class="controlbtn close">-
                                </div>
                                <div class="controlbtn open">+
                                </div>
                            </div>

                        </div>

                        <div class="text" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            <span itemprop="text">
                                <?php $the_content = apply_filters('the_content', $post->post_content); ?>
                                <?php echo $the_content; ?>
                            </span>
                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </section>

<?php endif; ?>
