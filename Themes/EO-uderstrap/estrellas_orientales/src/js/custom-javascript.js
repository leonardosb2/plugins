
function convertDateForIos(date) {
    var arr = date.split(/[- :]/);
    date = new Date(arr[0], arr[1]-1, arr[2], arr[3], arr[4], arr[5]);
    return date;
}
function pad(d) {
    return (d < 10) ? '0' + d.toString() : d.toString();
}
AOS.init({
    once: true
})
var $nav = jQuery(".navbar");
var $navTop = $nav.offset().top;
var bottom = jQuery(window).height();
var $hh = jQuery('header.header').height();

var $pegarNav = function () {
    var $scrollTop = jQuery(window).scrollTop();
    if ($scrollTop > 90) {
        $nav.addClass("sticky_menu");
        $nav.css('top', $hh);
    } else {
        $nav.removeClass("sticky_menu");
    }
}
jQuery('.slide-photos').fadeOut();
jQuery(window).on('scroll', $pegarNav);


jQuery(document).ready(function () {
    jQuery('button.cta').click(function (e) {
        if (jQuery(e.target).parents('.select-resolution').hasClass('active-resolutions')) {
            jQuery(e.target).parents('.select-resolution').removeClass("active-resolutions");
        } else {
            jQuery(e.target).parents('.select-resolution').addClass("active-resolutions");
        }
    });
    // jQuery('a.dropdown-toggle').click(function (e) {
    //     alert(this.text())
    // });
    
    
    

    jQuery('.cta-search').click(function (e) {
        jQuery('.cta-search-pop-up').toggle();
    });
    if (jQuery(window).width() > 990) {
        jQuery('li.dropdown').mouseover(function (e) {
            jQuery(this).children('.dropdown-menu').addClass('show');
        });
        jQuery('li.dropdown').mouseout(function (e) {
            jQuery(this).children('.dropdown-menu').removeClass('show');
        });
    }else{
        jQuery('li.dropdown').click(function (e) {
            jQuery(this).children('.dropdown-menu').addClass('show');
            jQuery(this).addClass('show');
            jQuery('button.back').addClass('show-btn');
        });
        jQuery('button.back').click(function (e) {
            jQuery('ul.dropdown-menu').removeClass('show');
            jQuery('.menu-item-has-children').removeClass('show');
            jQuery(this).removeClass('show-btn');
        });
    }
    jQuery( window ).resize(function() {
        if(jQuery( window ).width()> 990){
            
        }else{
        }
    });    
    jQuery(".go-to-popup").click(function (evt) {
        setTimeout(function () {
            jQuery('.slide-photos').fadeIn();
            jQuery('.slide-photos .slick-arrow').click();
        }, 100);
        var oID = jQuery(this).attr("id");
        jQuery("." + oID).fadeIn(1300);
    });
    jQuery(".go-to-popup").click(function (evt) {
        setTimeout(function () {
            jQuery('.slide-photos').fadeIn();
            jQuery('.slide-photos .slick-arrow').click();
        }, 100);
        var oID = jQuery(this).attr("id");
        jQuery("." + oID).fadeIn(1300);
    });
    jQuery(".close").click(function (evt) {
        jQuery(".content-popup").fadeOut();
        jQuery('.slide-photos').fadeOut();
    });
    jQuery(document).on('keydown', function(event) {
        if (event.key == "Escape") {
            jQuery(".content-popup").fadeOut();
        }
    });
    
    jQuery('.slide-photos').slick({
        centerMode: true,
        centerPadding: '20%',
        slidesToShow: 1,
        dots: true,
        arrows:true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '20px',
                }
            },
        ]
    });
    //alert(jQuery(".slide-photos").slick("getSlick").slideCount);
    jQuery('.home-player .slider-current-players').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: false,
        cssEase: 'linear',
        asNavFor: '.list-faces'
    });
    
    // jQuery('.slider-nav-players a[data-slide]').click(function(e) {
    //   e.preventDefault();
    //   var slideno = jQuery(this).data('slide');
    //   jQuery('.home-player .slider-current-players').slick('slickGoTo', slideno - 1);
    // });
    
    jQuery('.list-faces').slick({
        dots: false,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.home-player .slider-current-players',
        focusOnSelect: true,
        arrows: false
    });
    jQuery('.slider-players-r').slick({
        slidesToShow: 5,
        slidesToScroll: 5,
        dots: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 1100,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    focusOnSelect: true,
                }
            },
            {
                breakpoint: 920,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    focusOnSelect: true,
                }
            },
            {
                breakpoint: 630,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    focusOnSelect: true,
                }
            },
            {
                breakpoint: 530,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    focusOnSelect: true,
                }
            },
            
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
        
    });
    jQuery(document).ready(function () {
        jQuery('.post-slider').slick({
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            fade: false,
            vertical: true,
            verticalSwiping: true,
            asNavFor: '.slider-nav',
            
        });
        jQuery('.slider-nav').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            asNavFor: '.post-slider',
            dots: false,
            arrows: false,
            focusOnSelect: true,
            variableWidth: true,
            responsive: [
                {
                    breakpoint: 1199.98,
                    settings: {
                        variableWidth: false,
                    }
                },
                
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });
    
    jQuery('.carousel-games').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        focusOnSelect: true,
        arrows: true,
        dots: false,
        responsive: [
            {
                breakpoint: 1340,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 507,
                settings: {
                    slidesToShow: 1,
                }
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    
    /* slider photo */
    jQuery('.slider-video').slick({
        dots: true,
        arrows: false,
        //infinite: true,
        centerMode: true,
        infinite: true,
        centerPadding: '60px',
        slidesToShow: 4,
        speed: 500,
        responsive: [{
            breakpoint: 1330,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 900,
            settings: {
                slidesToShow: 2,
                centerMode: false,
            }
        }
        
    ]
    
});
/*--------------------  Slider video  --------------------*/
var counterVideos = jQuery(".videos-section .yotu-videos li").length;
if (counterVideos < 4) {
    var slidesItem = 2;
}
else {
    var slidesItem = 3;
}
jQuery('.section-videos-yt .yotu-videos ul').slick({
    dots: true,
    arrows: false,
    centerMode: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2000,
    centerPadding: '60px',
    slidesToShow: slidesItem,
    draggable: false,
    speed: 500,
    responsive: [{
        breakpoint: 991,
        settings: {
            slidesToShow: 2,
        }
    },
    {
        breakpoint: 767,
        settings: {
            slidesToShow: 1,
        }
    }
]
});
jQuery('.new-vide-sec ul').slick({
    dots: true,
    arrows: false,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2000,
    slidesToShow: 2,
    draggable: false,
    speed: 500,
    responsive: [{
        breakpoint: 1330,
        settings: {
            slidesToShow: 3,
        }
    },
    {
        breakpoint: 991,
        settings: {
            slidesToShow: 2,
        }
    },
    {
        breakpoint: 767,
        settings: {
            slidesToShow: 1,
        }
    }
]
});

jQuery('.slider-video').slick('slickGoTo', 0);
jQuery(".support-sample ul li").click(function (evt) {
    var oID = jQuery(this).attr("id");
    /*if (!jQuery("#" + oID + " a").hasClass("active")) {
        jQuery('.slider-video').slick('slickGoTo', 0);
    }*/
});
jQuery(".play-video").click(function (evt) {
    var oID = jQuery(this).attr("id");
    var idMovie = oID.split("-");
    //jQuery("." + oID).addClass('d-none');
    jQuery(this).css('z-index', "0");
    jQuery("#movie-" + idMovie[2]).css({
        "pointer-events": "initial"
    });
    
    jQuery("#movie-" + idMovie[2]).css({
        "opacity": "1"
    });
    jQuery(".movie-" + idMovie[2]).css({
        "background-image": "none"
    });
    jQuery("#movie-" + idMovie[2])[0].src += "&autoplay=1";
    jQuery("#movie-" + idMovie[2]).addClass("yt-on").removeClass("yt-off");
});
// Hero Photos Slider
jQuery('.photos-hero-slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    fade: true
});

// Custom Button Youtube Pagination 
jQuery('.videos-section .yotu-pagination-more').addClass('btn-primary btn');
jQuery('.videos-section .yotu-pagination-more').text('VER MÁS VIDEOS');

    jQuery('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image 
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function (item) {
                return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
            }
        }
    });
    // jQuery('#matchesFilter').on('submit', function(){ 
    //   var id = jQuery(this).data("value")
    //   alert(id);
    // });
});
jQuery(window).load(function() {
    jQuery('.section-videos-yt .yotu-videos ul').addClass('ready-slider');
});
jQuery('.loader').fadeOut();
// Loader all pages
/*jQuery(window).load(function () {
});*/