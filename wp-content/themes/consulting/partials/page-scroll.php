<?php wp_enqueue_script( 'fullPage' ); ?>

<div class="stm_page_scroll">

</div>

<script type="text/javascript">
    (function($){
        "use strict"

        var stm_sections = [];
        var prevScroll = 0;
        var direction = 'down';
        var activeS = 0;
        $(document).ready(function(){

            buildSections();

            $('body').on('click', '.stm_page_scroll div', function(){
                $('.stm_page_scroll div').removeClass('active');
                $(this).addClass('active');

                var section = $(this).data('section');

                $('html, body').stop().animate({
                    scrollTop: stm_sections[section]['$el'].offset().top
                }, 700);
            });
        });

        $(window).load(function(){
            buildSections();
            scroll();
        });

        $(window).scroll(function(e){
            scroll();
        });

        function scroll() {
            var currentPos = $(window).scrollTop();
            if(currentPos > prevScroll) {
                direction = 'down';
            } else {
                direction = 'up'
            }

            $.each(stm_sections, function(key, value) {
                if(currentPos + 1 > value['top'] && currentPos < currentPos + value['height'] - 1) {
                    $('.stm_page_scroll div').removeClass('active');
                    $('.stm_page_scroll div[data-section="'+key+'"]').addClass('active');
                    activeS = key;
                }
            });
        }

        function buildSections() {
            $('.stm_page_scroll').empty();
            var i = 0;
            stm_sections = [];
            $('.vc_row.vc_row-o-full-height').each(function(){
                stm_sections.push ({
                    '$el' : $(this),
                    'top' : $(this).offset().top,
                    'height' : $(this).outerHeight()
                });

                var str = '<div data-section="' + i + '"></div>';
                if(i == 0) {
                    str = '<div class="active" data-section="' + i + '"></div>';
                }
                $('.stm_page_scroll').append(str);

                i++;
            });

            if($('#footer').length) {
                stm_sections.push({
                    '$el' : $('#footer'),
                    'top' : $('#footer').offset().top,
                    'height' : $('#footer').outerHeight()
                })
            }
        }

    })(jQuery);
</script>