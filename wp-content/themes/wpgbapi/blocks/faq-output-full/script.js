(function ($) {

    initBlock();

    function initBlock() {

        const faqItems = $('section.block-faq-output-full .faq-grid .faq-item');
        const faqItemNoFaqFound = $('section.block-faq-output-full .faq-grid .faq-item.no-faq-found');
        const faqItemsHeader = $('section.block-faq-output-full .faq-grid .faq-item .header');

        // toggle open close accordion
        faqItemsHeader.on('click', function(){
            if ( $(this).parent().hasClass('active') ) {
                $(this).parent().removeClass('active')
            } else {
                $(this).parent().addClass('active');
            }
        })

        // build data-search-term text
        faqItems.each(function(){
            let categorys = $(this).find('.category').text().toLowerCase();
            let headline = $(this).find('.headline').text().toLowerCase();
            let text = $(this).find('.text').text().toLowerCase();
            $(this).attr('data-search-term', categorys + ' ' + headline + ' ' + text);
        });

        // do search when input changes
        $('.live-search-box').on('input', function () {
            refreshSearchResult( $(this) );
        });

        function refreshSearchResult( element ) {

            var searchTerm = element.val().toLowerCase();

            if( searchTerm === '' ) {
                faqItems.each(function() {
                    $(this).removeClass('hidden');
                    $(this).removeClass('active');
                });
                faqItems.removeHighlight();
                faqItemNoFaqFound.hide();
            } else {
                faqItems.each(function() {
                    $(this).removeClass('hidden');
                    $(this).removeClass('active');
                });

                faqItems.each(function(){
                    $(this).removeHighlight();
                    if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
                        $(this).addClass('active');
                        $(this).highlight(searchTerm);
                    } else {
                        $(this).removeClass('active');
                        $(this).addClass('hidden');
                        $(this).removeHighlight();
                    }
                });

                /* check how many faq are active, if none, show info */
                if( $('section.block-faq-output-full .faq-grid .faq-item.active').length === 0 ) {
                    faqItemNoFaqFound.show();
                } else {
                    faqItemNoFaqFound.hide();
                }
            }

        }


        /*
        highlight v5

        Highlights arbitrary terms.

        <http://johannburkard.de/blog/programming/javascript/highlight-javascript-text-higlighting-jquery-plugin.html>

        MIT license.

        Johann Burkard
        <http://johannburkard.de>
        <mailto:jb@eaio.com>
        */

        jQuery.fn.highlight = function(pat) {
            function innerHighlight(node, pat) {
                var skip = 0;
                if (node.nodeType == 3) {
                    var pos = node.data.toUpperCase().indexOf(pat);
                    pos -= (node.data.substr(0, pos).toUpperCase().length - node.data.substr(0, pos).length);
                    if (pos >= 0) {
                        var spannode = document.createElement('span');
                        spannode.className = 'highlight';
                        var middlebit = node.splitText(pos);
                        var endbit = middlebit.splitText(pat.length);
                        var middleclone = middlebit.cloneNode(true);
                        spannode.appendChild(middleclone);
                        middlebit.parentNode.replaceChild(spannode, middlebit);
                        skip = 1;
                    }
                }
                else if (node.nodeType == 1 && node.childNodes && !/(script|style)/i.test(node.tagName)) {
                    for (var i = 0; i < node.childNodes.length; ++i) {
                        i += innerHighlight(node.childNodes[i], pat);
                    }
                }
                return skip;
            }
            return this.length && pat && pat.length ? this.each(function() {
                innerHighlight(this, pat.toUpperCase());
            }) : this;
        };

        jQuery.fn.removeHighlight = function() {
            return this.find("span.highlight").each(function() {
                this.parentNode.firstChild.nodeName;
                with (this.parentNode) {
                    replaceChild(this.firstChild, this);
                    normalize();
                }
            }).end();
        };



    }

})(jQuery);
