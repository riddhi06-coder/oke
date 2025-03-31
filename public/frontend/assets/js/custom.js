// stickymenu start
// window.onscroll = function() {myFunction()};

// var header = document.getElementById("myHeader");
// var sticky = header.offsetTop;

// function myFunction() {
//   if (window.pageYOffset > sticky) {
//     header.classList.add("sticky");
//   } else {
//     header.classList.remove("sticky");
//   }
// }
// stickymenu end


$(document).ready(function () {
  var sync1 = $("#sync1");
  var sync2 = $("#sync2");
  var slidesPerPage = 4; //globaly define number of elements per page
  var syncedSecondary = true;

  sync1
    .owlCarousel({
      items: 1,
      slideSpeed: 2000,
      nav: false,
      autoplay: false,
      dots: false,
      loop: true,
      responsiveRefreshRate: 200,
    })
    .on("changed.owl.carousel", syncPosition);

  sync2
    .on("initialized.owl.carousel", function () {
      sync2.find(".owl-item").eq(0).addClass("current");
    })
    .owlCarousel({
      items: slidesPerPage,
      dots: true,
      nav: true,
      smartSpeed: 200,
      slideSpeed: 500,
      slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
      responsiveRefreshRate: 100
    })
    .on("changed.owl.carousel", syncPosition2);

  function syncPosition(el) {
    //if you set loop to false, you have to restore this next line
    //var current = el.item.index;

    //if you disable loop you have to comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }

    //end block

    sync2
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = sync2.find(".owl-item.active").length - 1;
    var start = sync2.find(".owl-item.active").first().index();
    var end = sync2.find(".owl-item.active").last().index();

    if (current > end) {
      sync2.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      sync2.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      sync1.data("owl.carousel").to(number, 100, true);
    }
  }

  sync2.on("click", ".owl-item", function (e) {
    e.preventDefault();
    var number = $(this).index();
    sync1.data("owl.carousel").to(number, 300, true);
  });
});





$(document).ready(function() {
    var owl = $('.battery-features-slider');
    owl.owlCarousel({
        margin: 0,
        loop: true,
        dots: false,
        autoplay: false,
        autoplayTimeout: 4500,
        responsive: {
            0: {
                items: 1,
                nav: true,
            },
            576: {
                items: 1,
                nav: true,
            },
            768: {
                items: 2,
                nav: true,
            },
            992: {
                items: 2,
                nav: true,
            },
            1200: {
                items: 3,
                nav: true,
            },
            1440: {
                items: 3,
                nav: true,
            }
        }
    })
})



$(document).ready(function() {
    var owl = $('.battery-small-features-slider');
    owl.owlCarousel({
        margin: 70,
        loop: true,
        dots: true,
        autoplay: false,
        autoplayTimeout: 4500,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 2,
                nav: false,
            },
            992: {
                items: 2,
                nav: false,
            },
            1200: {
                items: 3,
                nav: false,
            },
            1440: {
                items: 4,
                nav: false,
            }
        }
    })
})


// lightslider start
  //   $(document).ready(function() {
  //     $("#content-slider").lightSlider({
  //         loop:true,
  //         keyPress:true
  //     });
  //     $('#image-gallery').lightSlider({
  //         gallery:true,
  //         item:1,
  //         verticalHeight: 100,
  //         thumbItem:5,
  //         galleryMargin: 30,
  //         adaptiveHeight :true,
  //         thumbMargin: 10,
  //         speed:500,
  //         auto:true,
  //         loop:true,
  //         onSliderLoad: function() {
  //             $('#image-gallery').removeClass('cS-hidden');
  //         }  
  //     });
  // });
// lightslider end


$(document).ready(function() {
    // Initialize the main carousel
    var mainCarousel = $('.product-single-carousel');
    mainCarousel.owlCarousel({
        margin: 20,
        loop: true,
        dots: false, // Disable the default dots
        autoplay: false,
        autoplayTimeout: 4500,
        items: 1, // Only one image at a time
        nav: true,
    });

    // Initialize the thumbnail carousel
    var thumbCarousel = $('.product-thumbnails');
    thumbCarousel.owlCarousel({
        margin: 10,
        items: 4, // Display 4 thumbnails at a time
        loop: true,
        autoplay: false,
        nav: true,
    });

    // Sync the main carousel with the thumbnail click
    thumbCarousel.on('click', '.thumb-item', function() {
        var index = $(this).index(); // Get the index of the clicked thumbnail
        mainCarousel.trigger('to.owl.carousel', [index]); // Trigger main carousel to move to the clicked thumbnail's image
    });

    // Highlight the active thumbnail when the main carousel changes
    mainCarousel.on('changed.owl.carousel', function(event) {
        var currentIndex = event.item.index; // Get the index of the current slide
        thumbCarousel.find('.thumb-item').removeClass('active'); // Remove 'active' class from all thumbnails
        thumbCarousel.find('.thumb-item').eq(currentIndex).addClass('active'); // Add 'active' class to the current thumbnail
    });
});





$(document).ready(function(){
      // Initialize the main image carousel
      var mainCarousel = $(".product-single-carousel").owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        dots: false,
      });

      // Initialize the thumbnail carousel
      var thumbCarousel = $(".prod-thumbnail").owlCarousel({
        items: 5,
        margin: 10,
        loop: true,
        center: true,
        nav: false,
        dots: false,
      });

      // Synchronize thumbnail click with the main image carousel
      $('.owl-dot').on('click', function() {
        var index = $(this).index();  // Get the index of the clicked thumbnail
        mainCarousel.trigger('to.owl.carousel', [index, 300]);  // Move the main carousel to the corresponding item
        $('.owl-dot').removeClass('active');  // Remove active class from all thumbnails
        $(this).addClass('active');  // Add active class to the clicked thumbnail
      });

      // Set the first thumbnail as active by default
      $('.owl-dot').first().addClass('active');
    });


// Banner Slider
  // $(document).ready(function() {
  //   var $carousel = $('.banner-slider').owlCarousel({
  //     loop: true,
  //     margin: 30,
  //     nav: false,
  //     mouseDrag: true,
  //     items: 1,
  //     dots: true,
  //     dotsData: true, // Enable custom dots
  //     autoHeight: true,
  //     autoplay: false,
  //     smartSpeed: 1500,
  //     autoplayHoverPause: true,
  //     navText: [
  //       "<i class='fa fa-angle-left'></i>",
  //       "<i class='fa fa-angle-right'></i>"
  //     ]
  //   });

  //   // Ensure dots are clickable
  //   $(document).on('click', '.owl-dot', function() {
  //     var index = $(this).index();
  //     console.log('Dot clicked, index:', index); // Debug log
  //     $carousel.trigger('to.owl.carousel', [index, 300]); // Navigate to the corresponding slide
  //   });
  // });








// $(function () {

//     const svg = document.getElementById("svg");
//     const tl = gsap.timeline();
//     const curve = "M0 502S175 272 500 272s500 230 500 230V0H0Z";
//     const flat = "M0 2S175 1 500 1s500 1 500 1V0H0Z";

//     tl.to(".loader-wrap-heading .load-text , .loader-wrap-heading .cont", {
//         delay: 1.5,
//         y: -100,
//         opacity: 0,
//     });
//     tl.to(svg, {
//         duration: 0.5,
//         attr: { d: curve },
//         ease: "power2.easeIn",
//     }).to(svg, {
//         duration: 0.5,
//         attr: { d: flat },
//         ease: "power2.easeOut",
//     });
//     tl.to(".loader-wrap", {
//         y: -1500,
//     });
//     tl.to(".loader-wrap", {
//         zIndex: -1,
//         display: "none",
//     });
//     tl.from(
//         "header .container",
//         {
//             y: 100,
//             opacity: 0,
//             delay: 0.3,
//         },
//         "-=1.5"
//     );

// });





// AOS.init({
// once: true
// })

$(document).ready(function() {
    var owl = $('.about-slider');
    owl.owlCarousel({
        margin: 20,
        loop: true,
        dots: false,
        autoplay: false,
        autoplayTimeout: 4500,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 1,
                nav: false,
            },
            992: {
                items: 1,
                nav: true,
            },
            1200: {
                items: 1,
                nav: true,
            },
            1440: {
                items: 1,
                nav: true,
            }
        }
    })
})


$(document).ready(function() {
    var owl = $('.client-slider');
    owl.owlCarousel({
        margin: 20,
        loop: true,
        dots: false,
        autoplay: false,
        autoplayTimeout: 4500,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 2,
                nav: false,
            },
            992: {
                items: 3,
                nav: true,
            },
            1200: {
                items: 4,
                nav: true,
            },
            1440: {
                items: 5,
                nav: true,
            }
        }
    })
})


$(document).ready(function() {
    var owl = $('.product-slider');
    owl.owlCarousel({
        margin: 70,
        loop: true,
        dots: false,
        autoplay: false,
        autoplayTimeout: 4500,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 2,
                nav: false,
            },
            992: {
                items: 3,
                nav: true,
            },
            1200: {
                items: 3,
                nav: true,
            },
            1440: {
                items: 3,
                nav: true,
            }
        }
    })
})

$(document).ready(function() {
    var owl = $('.industry-served-slider');
    owl.owlCarousel({
        margin: 70,
        loop: true,
        dots: false,
        autoplay: false,
        autoplayTimeout: 4500,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 1,
                nav: false,
            },
            992: {
                items: 1,
                nav: true,
            },
            1200: {
                items: 1,
                nav: true,
            },
            1440: {
                items: 1,
                nav: true,
            }
        }
    })
})

// Parallax

$(document).ready(function(){
    //.parallax(xPosition, speedFactor, outerHeight) options:
    //xPosition - Horizontal position of the element
    //inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
    //outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    var testMobile = isMobile.any();
    
    if (testMobile == null)
    {
        $('.bg1').parallax("50%", 0.3);
        $('.bg2').parallax("50%", 0.3);
        $('.bg3').parallax("50%", 0.3);
        $('.bg4').parallax("50%", 0.3);
    }
})



// $("html").easeScroll({
//   frameRate: 60,
//   animationTime: 2000,
//   stepSize: 80,
//   pulseAlgorithm: !0,
//   pulseScale: 8,
//   pulseNormalize: 1,
//   accelerationDelta: 20,
//   accelerationMax: 1,
//   keyboardSupport: !0,
//   arrowScroll: 50
// });


var $root = $('html, body');

// $('a[href^="#"]').click(function () {
//     $root.animate({
//         scrollTop: $( $.attr(this, 'href') ).offset().top
//     }, 500);

//     return false;
// });


 // Page Scroll Percentage
    function scrollTopPercentage() {
        const scrollPercentage = () => {

            // {
            //     var header = document.getElementById("myHeader");
            //     var sticky = header.offsetTop;

            //     function myFunction() {
            //       if (window.pageYOffset > sticky) {
            //         header.classList.add("sticky");
            //       } else {
            //         header.classList.remove("sticky");
            //       }
            //     }

            //     myFunction()
            // }
            const scrollTopPos = document.documentElement.scrollTop;
            const calcHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrollValue = Math.round((scrollTopPos / calcHeight) * 100);
            const scrollElementWrap = $("#scroll-percentage");

            scrollElementWrap.css("background", `conic-gradient( #111 ${scrollValue}%, #fff ${scrollValue}%)`);
            
            // ScrollProgress
            if ( scrollTopPos > 100 ) {
                scrollElementWrap.addClass("active");
            } else {
                scrollElementWrap.removeClass("active");
            }

            if( scrollValue < 96 ) {
                $("#scroll-percentage-value").text(`${scrollValue}%`);
            } else {
                $("#scroll-percentage-value").html('<i class="fa fa-long-arrow-up"></i>');
            }
        }
        window.onscroll = scrollPercentage;
        window.onload = scrollPercentage;

        // Back to Top
        function scrollToTop() {
            document.documentElement.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }
        
        $("#scroll-percentage").on("click", scrollToTop);
    }

    scrollTopPercentage();
    

AOS.init({
    once: true
})

  $('#tabs .tab-links').on('click', '.item-link', function () {

        var tab_id = $(this).attr('data-tab');

        $('#tabs .tab-links .item-link').removeClass('current');
        $(this).addClass('current');

        $('.tab-content').hide();
        $("#" + tab_id).show();

    });

    $('#tabs-fade .tab-links').on('click', '.item-link', function () {

        var tab2_id = $(this).attr('data-tab');

        $('#tabs-fade .tab-links .item-link').removeClass('current');
        $(this).addClass('current');

        $('.tab-content').fadeOut();
        $("#" + tab2_id).fadeIn();

    });

  $(document).ready(function() {
    var owl = $('.ads-slider');
    owl.owlCarousel({
        margin: 20,
        nav: true,
        loop: true,
        dots: false,
        autoplay: false,
        autoplayTimeout: 4500,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 1
            },
            1200: {
                items: 1
            },
            1440: {
                items: 1
            }
        }
    })
})



  
    $(document).ready(function() {
    var owl = $('.battery-banner-slider');
    owl.owlCarousel({
        margin: 20,
        nav: true,
        loop: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 4500,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 1
            },
            1200: {
                items: 1
            },
            1440: {
                items: 1
            }
        }
    })
})