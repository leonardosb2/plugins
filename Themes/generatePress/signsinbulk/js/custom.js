jQuery( document ).ready(function() {
    jQuery(".go-top").click(function(e) {
        jQuery("body, html").animate({
            scrollTop: 0
        } , 500 );
    });
    jQuery('.slider-testimonials').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,

   
        nextArrow: '<button class="right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
        prevArrow: ' <button class="left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
    });
});

//go top 

