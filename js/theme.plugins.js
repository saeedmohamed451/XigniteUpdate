(function(){$(document).ready(function(){window.ISRTL=getComputedStyle(document.body).direction==="rtl";if($(".royalSlider").length){jQuery.rsCSS3Easing.easeOutBack="cubic-bezier(0.175, 0.885, 0.320, 1.275)";$(".royalSlider").royalSlider({autoScaleSlider:true,autoScaleSliderWidth:1325,autoScaleSliderHeight:925,imageScaleMode:"fill",imageScalePadding:0,slidesSpacing:0,controlNavigation:"none",loop:true,block:{speed:700,easing:"easeOutBack"},keyboardNavEnabled:true})}if($(".rev_slider").length){$(".rev_slider").revolution({delay:4000,startwidth:848,startheight:387,hideTimerBar:"on",hideThumbs:100,navigationType:"none",navigationStyle:"round"})}if($(".layerslider").length){$(".layerslider").layerSlider({responsive:false,responsiveUnder:1140,layersContainer:1140,skinsPath:"js/layerslider/skins/",hoverPrevNext:false,navButtons:false,navStartStop:false,showCircleTimer:false})}$(".countdown").each(function(){var b=$(this),a=b.data(),c=new Date(a.year,a.month||0,a.day||1,a.hours||0,a.minutes||0,a.seconds||0);b.countdown({until:c,format:"dHMS",labels:["years","month","weeks","days","hours","min","sec"]})});window.twitterConfig={username:"fanfbmltemplate",modpath:"twitter/",count:2,loading_text:'<div class="animated_item">Loading tweets...</div>',template:'<li class="animated_item"><p class="tweet_inner"><a href="{user_url}">{screen_name}</a> {text}</p><ul class="tw_actions"><li><a target="_blank" href={tweet_url}>{tweet_date}</a></li><li>{reply_action}</li><li>{retweet_action}</li><li>{favorite_action}</li></ul></li>'};$(".tweet_list_wrap").tweet(window.twitterConfig);$(".twitter_follow").attr({href:"http://www.twitter.com/"+window.twitterConfig.username,target:"_blank"});$(".custom_select").customSelect();if($.arcticmodal){$.arcticmodal("setDefault",{type:"ajax",ajax:{cache:false},afterOpen:function(a){var b=$(".modal_window");b.find(".custom_select").customSelect();b.find(".product_preview .owl_carousel").owlCarousel({margin:10,themeClass:"thumbnails_carousel",nav:true,navText:[],rtl:window.ISRTL?true:false});Core.events.productPreview();addthis.toolbox(".addthis_toolbox")}})}$(".accordion").accordion(false);$(".toggle").accordion(true);if($.fancybox){$.fancybox.defaults.direction={next:"left",prev:"right"}}if($(".fancybox_item").length){$(".fancybox_item").fancybox({openEffect:"elastic",closeEffect:"elastic",helpers:{overlay:{css:{background:"rgba(0,0,0, .6)"}},thumbs:{width:50,height:50}}})}if($(".fancybox_item_media").length){$(".fancybox_item_media").fancybox({openEffect:"none",closeEffect:"none",helpers:{media:{}}})}if($("#img_zoom").length){$("#img_zoom").elevateZoom({zoomType:"inner",gallery:"thumbnails",galleryActiveClass:"active",cursor:"crosshair",responsive:true,easing:true,zoomWindowFadeIn:500,zoomWindowFadeOut:500,lensFadeIn:500,lensFadeOut:500});$(".open_qv").on("click",function(b){var a=$(this).siblings("img").data("elevateZoom");$.fancybox(a.getGalleryList());b.preventDefault()})}if($("#slider").length){window.startRangeValues=[28,562];$("#slider").slider({range:true,min:10,max:580,values:window.startRangeValues,step:0.01,slide:function(d,e){var c=e.values[0].toFixed(2),a=e.values[1].toFixed(2),b=$(this).siblings(".range");b.children(".min_value").val(c).next().val(a);b.children(".min_val").text("$"+c).next().text("$"+a)},create:function(d,e){var f=$(this),c=f.slider("values",0).toFixed(2),a=f.slider("values",1).toFixed(2),b=f.siblings(".range");b.children(".min_value").val(c).next().val(a);b.children(".min_val").text("$"+c).next().text("$"+a)}})}});$(window).load(function(){$(".owl_carousel:not(.widgets_carousel)").on("initialized.owl.carousel resized.owl.carousel",Core.helpers.sameheight).on("initialized.owl.carousel translated.owl.carousel",Core.helpers.owlGetVisibleElements);$('.carousel_in_tabs:not([class*="type"])').owlCarousel({responsive:{0:{items:1},480:{items:2},992:{items:5}},nav:true,navText:[],rtl:window.ISRTL?true:false});$(".brands").owlCarousel({responsive:{0:{items:2},480:{items:3},992:{items:5}},margin:30,loop:true,nav:true,navText:[],themeClass:"brands_carousel",rtl:window.ISRTL?true:false});$(".brands_full_width").owlCarousel({responsive:{0:{items:2},480:{items:3},768:{items:4},992:{items:5},1199:{items:6}},margin:30,loop:true,nav:true,navText:[],themeClass:"brands_carousel",rtl:window.ISRTL?true:false});$(".sellers_carousel, .other_products").owlCarousel({responsive:{0:{items:1},487:{items:2},992:{items:5}},nav:true,navText:[],rtl:window.ISRTL?true:false});$(".carousel_of_entries").owlCarousel({responsive:{0:{items:1},485:{items:2},992:{items:5}},nav:true,navText:[],rtl:window.ISRTL?true:false});$(".carousel_in_tabs.type_2, .owl_carousel.four_items").owlCarousel({responsive:{0:{items:1},490:{items:2},684:{items:3},992:{items:5}},nav:true,navText:[],rtl:window.ISRTL?true:false});$(".carousel_in_tabs.type_3").owlCarousel({responsive:{0:{items:1},490:{items:2},992:{items:5},1199:{items:5}},nav:true,navText:[],rtl:window.ISRTL?true:false});$(".widgets_carousel").owlCarousel({items:1,autoHeight:true,loop:true,nav:true,navText:[],themeClass:"single_visible_element",onResized:function(){$(".widgets_carousel").trigger("next.owl.carousel")},rtl:window.ISRTL?true:false});$(".owl_carousel.six_items").owlCarousel({responsive:{0:{items:1},420:{items:2},580:{items:3},992:{items:5},1199:{items:6}},nav:true,navText:[],themeClass:"carousel_with_six_items",rtl:window.ISRTL?true:false});$(".owl_carousel.five_items").owlCarousel({responsive:{0:{items:1},465:{items:2},580:{items:3},991:{items:5},1199:{items:5}},nav:true,navText:[],rtl:window.ISRTL?true:false});if($(".product_preview").length){$(".product_preview .owl_carousel").owlCarousel({margin:10,themeClass:"thumbnails_carousel",nav:true,navText:[],rtl:window.ISRTL?true:false})}if($(".related_products").length){$(".related_products").owlCarousel({responsive:{0:{items:1},465:{items:2},991:{items:3}},nav:true,navText:[],rtl:window.ISRTL?true:false})}$(".tabs, .tour_section").tabs()})}());