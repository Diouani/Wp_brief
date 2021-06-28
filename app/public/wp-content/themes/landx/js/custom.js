(function (jQuery) {
    
    "use strict";

/* =================================
===  MAILCHIMP                 ====
=================================== */        
        

        /*jQuery('.datefield').each(function(){
            var format = jQuery(this).data('format');
            jQuery(this).datepicker({
                dateFormat: format
            }); 
        })*/

        jQuery('.qual-uptown-open-menu').on('click', function(){
            jQuery(jQuery(this).attr('href')).toggle();

        })

        jQuery('.qual-uptown-close-menu').on('click', function(){
            jQuery(this).closest('.qual-filter-canvas-wrapper').hide();
        })

        jQuery(document).on('focus',".datefield", function(){ //bind to all instances of class "date". 
           jQuery(this).datepicker({
                dateFormat: jQuery(this).data('format')
           });
        });

        jQuery('.mailchimp').each(function(){
            jQuery(this).ajaxChimp({
                url: jQuery(this).data('posturl'),
                language: jQuery(this).data('language'),
                callback: mccallbackFunction
            });
        })

        function mccallbackFunction (resp) {
            var parts = resp.msg.split(' - ', 2);
            if (parts[1] === undefined) {
                var msg = resp.msg;

            } else {
                var i = parseInt(parts[0], 10);
                if (i.toString() === parts[0]) {
                    var index = parts[0];
                    var msg = parts[1];
                  
                } else {
                    var index = -1;
                    var msg = resp.msg;

                }

            }
            if (resp.result === 'success') {
                jQuery('.subscription-success').html('<span class="icon_check_alt2"></span> ' + msg).fadeIn(1000);
                jQuery('.subscription-error').fadeOut(500);
            }else{
                jQuery('.subscription-error').html('<span class="icon_close_alt2"></span> ' + msg).fadeIn(1000);
            }
        }

        jQuery('table').addClass('table');
        // Sectionize-Control
        if (jQuery('select').length > 0) {
            jQuery('select').selectize({
                create: true,
                sortField: {
                    field: 'text',
                    direction: 'asc'
                },
                dropdownParent: 'body'
            });
        }
    
   
 
 jQuery('.button').addClass('btn');

 jQuery('.count-control').on('click', function(){
        var old = parseInt(jQuery(this).closest('.quantity').find('.qty').val());
        if(jQuery(this).hasClass('plus')){

          if(parseInt(jQuery(this).data('max')) != -1 ){
            if( (parseInt(jQuery(this).data('max'))-1) >= old ){
             jQuery(this).closest('.quantity').find('.qty').val(old+1);
            }
          }else{
            jQuery(this).closest('.quantity').find('.qty').val(old+1);
          }      
          
        }else{
          if(old > 1){
            jQuery(this).closest('.quantity').find('.qty').val(old-1);
          }     
        }
        jQuery(this).closest('form').find('input[type="submit"]').prop('disabled', false);
        return false;
    })

/* =================================
===  STICKY NAV                 ====
=================================== */
    jQuery('.main-navigation a').on('click', function(){
        jQuery('.main-navigation li').removeClass('current');
    })
     jQuery('.main-navigation').onePageNav({
        scrollThreshold: 0.2, // Adjust if Navigation highlights too early or too late
        scrollOffset: 75, //Height of Navigation Bar
        filter: ':not(.external)',
        changeHash: true
    }); 

    /* NAVIGATION VISIBLE ON SCROLL */
    mainNav();
    jQuery(window).scroll(function () {
       mainNav();
    }); 


    function mainNav() {
        var top = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
        if(jQuery('.landx-onepage .sticky-navigation').hasClass('header-on')){
            jQuery('.landx-onepage .sticky-navigation').stop().animate({
                "opacity": '1',
                "top": '0'
            });
      jQuery(".navbar-fixed-top").addClass("scroll");
        }else{
            if (top > 40) {            
                jQuery('.landx-onepage .sticky-navigation, .landx-multipage .sticky-navigation').stop().animate({
                    "opacity": '1',
                    "top": '0'
                });
            }        
            else{
                jQuery('.landx-onepage .sticky-navigation').stop().animate({
                    "opacity": '0',
                    "top": '-75'
                });
        jQuery(".navbar-fixed-top").removeClass("scroll");  
            } 
        }

        
        
    }

    jQuery('.btn[href^="#"]').on('click', function(e) {
        var id = jQuery(this).attr('href');
            if( (id.length > 0) && (id != '#') ){
            e.preventDefault();
            jQuery('html,body').animate({
                scrollTop: jQuery(id).offset().top
            }, 'slow');
        }
    });

    jQuery('.nav-item a[href^="#"], .page a.btn[href^="#"], .page a.internal-link[href^="#"]').on('click', function (e) {
      
      e.preventDefault();

      var target = this.hash,
        $target = jQuery(target);
      if($target.length > 0){
        jQuery('html, body').stop().animate({
          'scrollTop': $target.offset().top - 60 // - 200px (nav-height)
        }, 'slow', 'easeInSine', function () {
          window.location.hash = '1' + target;
        });
      }
      
      
    });

/* =================================
===  OWL CROUSEL               ====
=================================== */
    var owl = jQuery("#screenshots");
    owl.owlCarousel({
        items: 3, //3 items above 1000px browser width
        itemsDesktop: [1000, 3], //3 items between 1000px and 901px
        itemsDesktopSmall: [900, 2], // betweem 900px and 601px
        itemsTablet: [600, 1], //1 items between 600 and 0
        itemsMobile: false, // itemsMobile disabled - inherit from itemsTablet option
        navigation: false, // Show next and prev buttons
        slideSpeed: 800,
        paginationSpeed: 400,
        autoPlay: 5000,
        stopOnHover: true
    });

    var owl = jQuery("#feedbacks");
    owl.owlCarousel({
        items: 3, //3 items above 1000px browser width
        itemsDesktop: [1000, 2], //2 items between 1000px and 901px
        itemsDesktopSmall: [900, 2], // betweem 900px and 601px
        itemsTablet: [600, 1], //1 items between 600 and 0
        itemsMobile: false, // itemsMobile disabled - inherit from itemsTablet option
        navigation: false, // Show next and prev buttons
        stopOnHover: true
    });


    var owl = jQuery(".posts-carousel");
    owl.owlCarousel({
        items: 3, //3 items above 1000px browser width
        itemsDesktop: [1000, 2], //2 items between 1000px and 901px
        itemsDesktopSmall: [900, 2], // betweem 900px and 601px
        itemsTablet: [600, 1], //1 items between 600 and 0
        itemsMobile: false, // itemsMobile disabled - inherit from itemsTablet option
        navigation: false, // Show next and prev buttons
        stopOnHover: true
    });

    if(jQuery('.product-categories-carousel').length > 0){
      
      jQuery('.product-categories-carousel').each(function(){
          var column = parseInt(jQuery(this).data('column'));
          jQuery(this).owlCarousel({
              loop:true,
              rtl: (jQuery('body').hasClass('rtl')? true : false),
              items: column,
              animateOut: 'fadeOut',
              animateIn: 'fadeIn',
              dots: false,
              autoplay: true,
              autoplayHoverPause: true,
              margin: 30,
              responsive: {
                1000 : {
                  items:column,
                  dots: false,
                },
                600 : {
                  items:2,
                  dots: true,
                },
                300 : {
                  items:1,
                  dots: true,
                }
              }
          })
      });
  }


  if(jQuery('.related .products').length > 0){
      
      jQuery('.related .products').each(function(){
          var column = 3;
          jQuery(this).owlCarousel({
              loop:false,
              rtl: (jQuery('body').hasClass('rtl')? true : false),
              items: column,
              animateOut: 'fadeOut',
              animateIn: 'fadeIn',
              dots: false,
              autoplay: true,
              autoplayHoverPause: true,
              margin: 30,
              responsive: {
                1000 : {
                  items:column,
                  dots: false,
                },
                500 : {
                  items:2,
                  dots: true,
                },
                300 : {
                  items:1,
                  dots: true,
                }
              }
          })
      });
  }

  if(jQuery('.cross-sells .products').length > 0){
      
      $('.cross-sells .products').each(function(){
          var column = 2;
          jQuery(this).owlCarousel({
              loop:false,
              rtl: (jQuery('body').hasClass('rtl')? true : false),
              items: column,
              animateOut: 'fadeOut',
              animateIn: 'fadeIn',
              dots: false,
              autoplay: true,
              autoplayHoverPause: true,
              margin: 30,
              responsive: {
                1000 : {
                  items:column,
                  dots: false,
                },
                600 : {
                  items:2,
                  dots: false,
                },
                300 : {
                  items:1,
                  dots: true,
                }
              }
          })
      });
  }


    // header-contact-form-slider
    if (jQuery('.landx-background-slider').length > 0){
        jQuery('.landx-background-slider').each(function(){
            var target = jQuery(this).closest('.vc_section').attr('id');
            
            jQuery(this).closest('.vc_section').vegas({
                slides: jQuery(this).data('slides'),
                transition: 'fade',
            });
        })
        
    }

    if( jQuery('.video-bg-wrap').length > 0 ){
        jQuery('.video-bg-wrap').each(function(){
            jQuery(this).closest('.vc_section').addClass('videowrap-section');
        })
    }

    /*----------------------------------------------------*/
    /*  Video Background
    /*----------------------------------------------------*/
    if(jQuery('.video-play').length > 0){
      jQuery('.video-play').each(function(){
        var poster = jQuery(this).data('poster');
        var mp4 = jQuery(this).data('mp4');
        var webm = jQuery(this).data('webm');
        var ogv = jQuery(this).data('ogv');
        var id = jQuery(this).closest('.vc_section').attr('id');
        jQuery(this).closest('.vc_section').vidbg({
            'poster': poster,
            'mp4': mp4,
              'webm': webm,
              'ogv': ogv
        }, {
              // Options
              muted: true,
              loop: true,
        overlay: true,
              overlayColor: '#000',
              overlayAlpha: 0.5,
            });
      })
      
    }

    
    


/* =================================
===  Nivo Lightbox              ====
=================================== */
    jQuery('#screenshots a, .gallery-item a').nivoLightbox({
        effect: 'fadeScale',
    });



/* =================================
===  EXPAND COLLAPSE            ====
=================================== */
    if(jQuery('.expand-form').length > 0){
        jQuery('.expand-form').simpleexpand({
            'defaultTarget': '.expanded-contact-form'
        });
    }
    

/* =================================
===  DOWNLOAD BUTTON CLICK SCROLL ==
=================================== */
    jQuery('.cta-section, .button-container').localScroll({
        duration: 1000
    });
    
   // jQuery('#home.image').parallax();

   function cta_bg_image(){
      if(jQuery(window).width() > 767){
      jQuery('.cta-section').each(function(){
              jQuery(this).parallax({imageSrc: jQuery(this).data('image-src'), speed: 0.0});
          })
    }else{
        jQuery('.cta-section').each(function(){
              jQuery(this).css('background-image', 'url(' +jQuery(this).data('image-src') + ')');
          })
      }
   }

   cta_bg_image();

   jQuery(window).resize(function(){
    cta_bg_image();
   })

   jQuery('input[type="text"], input[type="email"], input[type="tel"], input[type="password"]').addClass('form-control');
   jQuery('#home input[type="text"], #home input[type="email"], #home input[type="tel"], #home input[type="password"]').addClass('input-box');
   jQuery('input[type="submit"]').addClass('btn standard-button');

    jQuery('.eqheight').equalHeights()

/* =================================
===  RESPONSIVE VIDEO             ==
=================================== */
    jQuery(".video-container").fitVids();


/* =================================
===  SMOOTH SCROLL             ====
=================================== */
    var scrollAnimationTime = 1200,
        scrollAnimation = 'easeInOutExpo';
    jQuery('a.scrollto').bind('click.smoothscroll', function (event) {
        event.preventDefault();
        var target = this.hash;
        jQuery('html, body').stop().animate({
            'scrollTop': jQuery(target).offset().top
        }, scrollAnimationTime, scrollAnimation, function () {
            window.location.hash = target;
        });
    });


/* =================================
===  Bootstrap Internet Explorer 10 in Windows 8 and Windows Phone 8 FIX
=================================== */
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement('style')
        msViewportStyle.appendChild(
        document.createTextNode('@-ms-viewport{width:auto!important}'))
        document.querySelector('head').appendChild(msViewportStyle)
    }
})(jQuery);




jQuery(window).resize(function () {

    "use strict";

    var ww = jQuery(window).width();
    
    /* COLLAPSE NAVIGATION ON MOBILE AFTER CLICKING ON LINK */
    
    if (ww < 480) {
        jQuery('.main-navigation a').on('click', function () {
            jQuery(".navbar-toggle").click();
        });
    }

    
});

jQuery(window).load(function() {
    "use strict";
        // will first fade out the loading animation
    jQuery(".status").fadeOut();
        // will fade out the whole DIV that covers the website.
    jQuery(".preloader").delay(1000).fadeOut("slow");
})
