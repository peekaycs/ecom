
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
//testimpnial slider on page
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
                    centerPadding: '40px',
                    slidesToShow: 6,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '20px',
                    slidesToShow: 3,
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
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
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
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 5,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
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

// vertical new scroll
