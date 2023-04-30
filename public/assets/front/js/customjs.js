
$(document).ready(function() {
	$(window).scroll(function() {
		if ($(document).scrollTop() > 100) {
			$(".header-sticky").addClass("is-sticky");
		} else {
			$(".header-sticky").removeClass("is-sticky");
		}
	});
});
 
$(document).ready(function(){
    $("#sideNav").click(function(){
        if($(this).hasClass('toggle')){
           $(".header-menu").addClass("add-mob-menu");            
           $(this).removeClass('toggle');
           $("#sideNav i").addClass("fa-times");
           $("#sideNav i").removeClass('fa-bars');
        } else{
           $(".header-menu").removeClass("add-mob-menu");
           $(this).addClass('toggle');
           $("#sideNav i").removeClass("fa-times");
           $("#sideNav i").addClass('fa-bars');
        }                   
    })
});

$(document).ready(function(){
    $(".profile-icon").click(function(){
         {
             $(".profile-ddp").slideToggle("slow");
         }     	     	        
     });
 });
$(document).ready(function () {
    $('.best-selling-products-slide').slick({
        centerMode: true,
          centerPadding: '0px',
          slidesToShow: 7,
          slidesToScroll: 1,
          autoplay: false,
          speed: 1000,
          responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 6,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            }
          ]
        });
    });
$(document).ready(function () {
    $('.offer-slide').slick({
        centerMode: true,
            centerPadding: '0px',
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: false,
            speed: 1000,
            responsive: [
            {
                breakpoint: 769,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }
            ]
        });
    });
$(document).ready(function () {
    $('.product-slide').slick({
        centerMode: true,
            centerPadding: '0px',
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: false,
            speed: 1000,
            responsive: [
            {
                breakpoint: 769,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }
            ]
        });
    });

$(document).ready(function () {
    $('.featured-brand-slide').slick({
        centerMode: true,
            centerPadding: '0px',
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: false,
            speed: 1000,
            responsive: [
            {
                breakpoint: 769,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }
            ]
        });
    });

$(document).ready(function () {
    $('.client-scroll').slick({
        centerMode: true,
        centerPadding: '50px',
        slidesToShow: 4,
        autoplay: true,
        speed: 1000,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
        });
    });
//testimpnial slider on page
$(document).ready(function () {
    $('.testimonial').slick({
        centerMode: true,
        centerPadding: '0px',
        slidesToShow: 3,
        autoplay: false,
        speed: 1000,
        responsive: [
          {
              breakpoint: 768,
              settings: {
                  arrows: false,
                  centerMode: true,
                  centerPadding: '0px',
                  slidesToShow: 2
              }
          },
          {
              breakpoint: 480,
              settings: {
                  arrows: false,
                  centerMode: true,
                  centerPadding: '0px',
                  slidesToShow: 1
              }
          }
        ]
    });
});
// vertical new scroll


$(document).ready(function(){
    $("#btn-add-new-address").click(function(){
        $("#add-new-address").css({"display": "block"});
    });
    $(".btn-cancel").click(function(){
        $("#add-new-address").css({"display": "none"});
    });
});


// mobile service filter
$(document).ready(function(){
    // $(".filter-box").click(function(){
    //     if($(this).hasClass('tab-toggle')){
    //         $(".m-service-filter-data-show").addClass("add-m-data-show");
    //         $(this).removeClass('tab-toggle');
    //     } else{
    //         $(".m-service-filter-data-show").removeClass("add-m-data-show");
    //         $(this).addClass('tab-toggle');
    //     }                   
    // });

    $("#service_type").click(function(){
        $(".aside-mobile-filter").addClass("add-m-data-show");
    });
    $(".m-filter-close").click(function() {
        $(".aside-mobile-filter").removeClass("add-m-data-show");
    });
});

$(document).ready(function() {
    $(".popular").on('click', function(){
        let href = $(this).attr("href");
        $(".slide-popular").hide();
        $(".slide-popular").css('height','0px');
        $(href).css('height','unset'); 
        $(href).show();        
    });
})
// auto hide add-to-cart-success
window.setTimeout(function() {
    $(".alert").fadeTo(6000, 0);
}, 3000);
// auto hide add-to-cart-success end

