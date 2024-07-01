(function ($) {

    /*
     * Gutenberg Block Editor Addition
     */

    let blockSelector = 'section.block-faq-output-accordion';

    let blockLoaded = false;
    let blockLoadedInterval = setInterval(function() {
        console.log('still-loading ' + blockSelector);
        if ( $(blockSelector).length ) {
            blockLoaded = true;
            initBlock();
        }
        if ( blockLoaded ) {
            clearInterval( blockLoadedInterval );
        }
    }, 1000);

    /*
     * Main Script
     */

    function initBlock() {

        const faqItemsHeader = $('section.block-faq-output-accordion .faq-grid .faq-item .header');

        // toggle open close accordion
        faqItemsHeader.on('click', function(){
            if ( $(this).parent().hasClass('active') ) {
                $(this).parent().removeClass('active')
            } else {
                $(this).parent().addClass('active');
            }
        })


    } // end initBlock


})(jQuery);
