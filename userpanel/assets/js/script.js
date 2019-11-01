$(function () {
    $('.owl-carousel').owlCarousel({
        items:1,
        lazyLoad:false,
        loop:true,
        arrow:false,
        dots:false,
        margin:0,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:1,
                nav:false
            },
            1000:{
                items:1,
                nav:false,
                loop:true
            }
        }
    });
});


// $(document).ready(function(){
//     $(window).scroll(function() {
//         var scroll = $(window).scrollTop();
//
//         if (scroll >=600) {
//             $("nav").removeClass("d-none");
//         } else {
//
//             $("nav").addClass("d-none");
//         }
//     });
// });

