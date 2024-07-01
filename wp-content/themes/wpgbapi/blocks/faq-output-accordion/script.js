(function ($) {

    initBlock();

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

    }

})(jQuery);
