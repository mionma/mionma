(function ($) {

    initBlock();

    function initBlock() {

        var imageShowcaseGridSlider = new Swiper('section.block-image-showcase-grid .swiper', {
            allowTouchMove: true,

            slidesPerView: 1,
            spaceBetween: 0,
            slidesPerGroup: 1,

            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            breakpoints: {
                // when window width is >= 250px
                250: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                },
                // when window width is >= 650px
                650: {
                    slidesPerView: 2,
                    spaceBetween: 16,
                },
                // when window width is >= 1194px
                1194: {
                    slidesPerView: 3,
                    spaceBetween: 16,
                }
            }


        })

    }

})(jQuery);
