<?php if( isset($block) && is_array($block) && array_key_exists( 'is_preview', $block['data'] ) ) : ?>
    <img src="<?php echo get_stylesheet_directory_uri() . '/blocks/faq-output-full/gbprev.jpg'; ?>" style="width:100%; height:auto;">
<?php else : ?>

    <section class="block-faq-output-full">

        <div class="block-inner s1x-constraint-narrow s1x-padding">

            <h2 class="headline">
                Livefilter
            </h2>

            <div class="cntnr-input">
                <input type="text" class="live-search-box" placeholder="<?php echo get_field('search_placeholder'); ?>" />

                <svg class="searchicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 41.74 41.74">
                    <g id="Gruppe_56" data-name="Gruppe 56" transform="translate(-0.001 0)">
                        <g id="Gruppe_55" data-name="Gruppe 55" transform="translate(0.001 0)">
                            <path id="Pfad_14" data-name="Pfad 14" d="M36.788,28.9A16.937,16.937,0,0,0,12.836,4.952a16.608,16.608,0,0,0-2.548,20.441.712.712,0,0,1-.1.849L1.549,34.883c-1.72,1.72-2.129,4.125-.6,5.65l.263.262c1.525,1.525,3.93,1.116,5.65-.6l8.623-8.623a.723.723,0,0,1,.867-.116A16.608,16.608,0,0,0,36.788,28.9ZM15.963,25.778a12.514,12.514,0,1,1,17.7,0A12.529,12.529,0,0,1,15.963,25.778Z" transform="translate(-0.001 0)" fill="#164863"/>
                            <g id="Gruppe_54" data-name="Gruppe 54" transform="translate(15.295 6.778)">
                                <path id="Pfad_15" data-name="Pfad 15" d="M115.5,59.554a1.749,1.749,0,0,1-1.609-2.43,11.017,11.017,0,0,1,14.423-5.846,1.748,1.748,0,1,1-1.363,3.22,7.517,7.517,0,0,0-9.84,3.989A1.749,1.749,0,0,1,115.5,59.554Z" transform="translate(-113.752 -50.409)" fill="#164863"/>
                            </g>
                        </g>
                    </g>
                </svg>


            </div>

            <h2 class="headline">
                FAQ Einträge
            </h2>


            <div class="faq-grid" itemscope itemtype="https://schema.org/FAQPage">

            <?php
            // get published faq posts
            $args = array(
                'post_type'   => 'cpt-faq',
                'numberposts' =>  -1,
                'orderby'     => 'post_date',
                'order'       => 'DESC',
                'post_status' => 'publish',
            );
            $posts = get_posts($args);

            $active_class = 'active';

            foreach ($posts as $post) : ?>

                <div class="faq-item s1x-noselect" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">

                    <div class="s1x-categories">
                        <?php $t = get_the_terms($post->ID, 'cpt-faq-category'); ?>
                        <?php if( is_array($t) ) : ?>
                            <?php if( count($t) > 0 ) : ?>
                                <?php foreach( $t as $value ) : ?>
                                    <div class="s1x-category category">
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

                    <div class="header">
                        <h3 class="headline" itemprop="name">
                            <?php echo get_the_title($post->ID); ?>
                        </h3>

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


                <div class="faq-item no-faq-found" style="display: none;">

                    <div class="header">
                        <h3 class="headline">
                            Kein Eintrag passend zum Suchwort gefunden.
                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </section>

<?php endif; ?>
