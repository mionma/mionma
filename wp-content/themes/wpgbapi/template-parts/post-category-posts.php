<?php $qo = get_queried_object(); ?>

<section class="block-post-entry-output-headline category-page">
    <div class="block-inner s1x-constraint s1x-padding">
        <h2>Weitere Artikel der Kategorie <span><?php echo $qo->name; ?></span></h2>
    </div>
</section>



<!-- output area --->
<div id="block-post-entry-output-container">

    <?php echo \WPGBAPI\PT_Post::build_block_post_entry_output($qo->term_id); ?>

</div>