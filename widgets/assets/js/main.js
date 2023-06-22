gsap.registerPlugin(ScrollTrigger);
gsap.set("html, body", {
    "scroll-behavior":"initial"
}); 
window.scrollTo(0, 0);
;(function($) {


    function getIPAddress(fun) {
        // Send a GET request to the IP address API
        $.getJSON('https://cors-anywhere.herokuapp.com/http://api.ipify.org/?format=json', function(data) { 
          // Extract the IP address from the response
          var ipAddress = data.ip;
          
          // Use the IP address as needed
          console.log('IP Address:', ipAddress);
          fun(ipAddress)
        })
        .fail(function(jqXHR, textStatus, errorThrown) { 
          console.log('Request failed:', textStatus);
          fun(textStatus)
        });
    }
    getIPAddress(function(data){
        console.log("IP data", data);
    });  

    console.log(window.onbeforeunload);
    let isDesktop = false;
    let isMobile = false;
    function checkDeviceView(){
        if($(window).innerWidth() > 991){
            isDesktop = true;
            isMobile = false;
        }else{
            isDesktop = false;
            isMobile = true;
        }
    }
    checkDeviceView();

    var YTScript = document.createElement("script");
    YTScript.src = "https://www.youtube.com/iframe_api";
    $("head")[0].appendChild(YTScript);  

    var pageRoot = $("#page"); 
    let smootScroll = null;

    $(window).on("resize", checkDeviceView); 

    smoothScrollFun(); 
     
    function smoothScrollFun(){
        if(pageRoot.length){ 
            $("body,html").scrollTop(0); 
            
            smootScroll = new LocomotiveScroll({ 
                el:pageRoot[0],
                smooth:true,
                multiplier:1,
                touchMultiplier:1,
            });
            $(window).on("load", function(){
                smootScroll?.update();
                ScrollTrigger.refresh();  
                setTimeout(() => { 
                    smootScroll?.update(); 
                    ScrollTrigger.refresh();   
                }, 500); 
            });
        
            smootScroll?.on("scroll", ScrollTrigger.update);
            ScrollTrigger.scrollerProxy(pageRoot[0], {
                scrollTop(value) {
                  return arguments.length
                    ? smootScroll?.scrollTo(value, 0, 0)
                    : smootScroll?.scroll.instance.scroll.y;
                }, 
                getBoundingClientRect() {
                  return {
                    left: 0,
                    top: 0,
                    width: window.innerWidth,
                    height: window.innerHeight
                  };
                },
                pinType: pageRoot[0].style.transform ? "transform" : "fixed"
            });
            if($("html").hasClass("has-scroll-smooth")){ 
                console.log("YEs");
                ScrollTrigger.defaults({
                    scroller: pageRoot[0]
                })
            } 
            ScrollTrigger.refresh(); 
            ScrollTrigger.addEventListener("refresh", () => smootScroll?.update()); 
            smootScroll?.scrollTo(0, {
                duration:0
            });  
            window.smoothScroll = smootScroll;
            return smootScroll;
        }
    }
    
    // Text loop Slide
    function textLoop(direction = null, items = null){  
        if(items === null) return;
        let tl = gsap.timeline({
          repeat:-1,
          defaults:{
            duration:20,
            ease:"none"
          }
         }); 
         if(direction === "right"){
          //  Left To Right
          tl
          .set(items[1], {
            // x:-200 direction 
            xPercent:-200
          })
          .to(items[0], {
            xPercent:100
          }, "<")
          .to(items[1], {
            xPercent:-100
          }, "<")
          .set(items[0], {
            xPercent:-100
          })
          .to(items, {
            xPercent:0
          });
         }else{
          //  Right to Left
          tl
          .to(items[0], {
           xPercent:-100
          })
          .to(items[1], {
           xPercent:-100
          }, "<")
          .set(items[0], {
           xPercent:100
          })
          .to(items[0], {
            xPercent:0
           })
           .to(items[1], {
            xPercent:-200
           }, "<")
           .set(items[1], {
            xPercent:0
           }, "<")
         }
    
         return tl;
    }

    $(window).on('elementor/frontend/init', function(){ 
        // elementorFrontend.hooks.addAction( 'frontend/element_ready/SkdevHeader.default', SkdevHeader);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/skdevCard.default', skdevCard);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/skScrollToRight.default', skScrollToRight);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/textAutoScroll.default', textAutoScroll);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/SkPortfolio.default', SkPortfolioFun); 
        elementorFrontend.hooks.addAction( 'frontend/element_ready/SKTestimonial.default', SKTestimonial);  
        elementorFrontend.hooks.addAction( 'frontend/element_ready/brandSlide.default', brandSlide);  
        elementorFrontend.hooks.addAction( 'frontend/element_ready/slideImgList.default', slideImgList);  
        elementorFrontend.hooks.addAction( 'frontend/element_ready/imgList.default', slideImgList); 
        elementorFrontend.hooks.addAction( 'frontend/element_ready/slideCard.default', slideCard); 
        elementorFrontend.hooks.addAction( 'frontend/element_ready/checkBoxToggle.default', checkBoxToggle); 
    }); 


    function convertToSlug(Text)
    {
        return Text
            .toLowerCase()
            .replace(/ /g,'-')
            .replace(/[^\w-]+/g,'')
            ;
    }

    function skdevCard($scop) {
        
    }

    function textAutoScroll($scop){
        var duration = Number($scop.find(".text-slide-wrapper").attr("data-duration")); 
        var text = textLoop("left", $scop.find(".text-slide-wrapper .text-item"));
        text.duration(duration); 
    } 

    function skScrollToRight($scop){     

        var strWrap = $scop.find(".str__wrapper");
        var strInner = $scop.find(".str__inner");
        ScrollTrigger.matchMedia({
            "(min-width: 992px)": function() {
                gsap.to(strInner, {  
                    "--vw":"100vw",
                    "--x":"-100%",
                    ease:"none", 
                    scrollTrigger:{
                        trigger:strWrap,
                        start:"top top",
                        end:`+=${Math.round(strInner.innerWidth() / 1.8)}`,
                        scrub:true,
                        pin:true
                    }
                }); 
                ScrollTrigger.refresh(); 
            },
            "(max-width: 991px)": function() {  
                if(strWrap.hasClass("has-in-mobile")){
                    gsap.to(strInner, {  
                        "--vw":"100vw",
                        "--x":"-100%",
                        ease:"none", 
                        scrollTrigger:{
                            trigger:strWrap,
                            start:"top top",
                            end:`+=${Math.round(strInner.innerWidth() / 1.8)}`,
                            scrub:true,
                            pin:true,
                            onEnter(){
                                ScrollTrigger.refresh(); 
                            },
                            onEnterBack(){
                                ScrollTrigger.refresh(); 
                            },
                            onLeave(){
                                ScrollTrigger.refresh(); 
                            },
                            onLeaveBack(){
                                ScrollTrigger.refresh(); 
                            }
                        } 
                    });  
                    ScrollTrigger.refresh();  
                }
            },
          }); 
    } 

    function SkPortfolioFun($scop){ 
        var slide = $scop.find(".portfolio-slide .swiper");
        var speed = Number($scop.find(".portfolio-slide").attr('data-speen')); 
        var swiper = new Swiper(slide[0], {
            slidesPerView: 3,
            spaceBetween: 30, 
            loop: true,
            autoplay: {
                delay:1
            },
            speed, 
            on:{
                touchEnd:function(swiper, event){
                    setTimeout(()=>{
                      swiper.autoplay.start(); 
                    },100); 
                }
            }, 
            breakpoints:{
                0:{
                    slidesPerView: 1,
                    spaceBetween: 15,
                },
                600:{
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                991:{
                    slidesPerView: 3,
                    spaceBetween: 30,
                }
            }
          });
        
    }
    function brandSlide($scop){ 
        var slide = $scop.find(".brand-slide .swiper");
        var swiper = new Swiper(slide[0], {
            slidesPerView: 5,
            loop: true,
            autoplay: {
                delay:1
            },
            speed: 5000, 
            on:{
                touchEnd:function(swiper, event){
                    setTimeout(()=>{
                      swiper.autoplay.start(); 
                    },100); 
                }
            }, 
            breakpoints:{       
                0:{
                    slidesPerView: 2,
                },
                768:{
                    slidesPerView: 3,
                },
                800:{
                    slidesPerView: 4,
                },
                991:{
                    slidesPerView: 5,
                }
            }
          });
    }
    function slideImgList($scop){  
        var slide = $scop.find(".img-slide-wrapper .swiper");
        if (slide.length){ 
            var sOption = JSON.parse($scop.find(".img-slide-wrapper").attr("data-settings"));
            
            return new Swiper(slide[0], { 
                slidesPerView: sOption.lg_slide_view_auto ? "auto" : sOption.desktopView, 
                loop: true,
                autoplay:sOption.autoplay ? {
                    delay:1 
                } : false, 
                speed: sOption.speed, 
                on:{
                    touchEnd:function(swiper, event){
                        if(sOption.autoplay){
                            setTimeout(()=>{
                                swiper.autoplay.start(); 
                            },100); 
                        }
                    }
                }, 
                breakpoints:{    
                    0:{
                        slidesPerView: sOption.sm_slide_view_auto ? "auto" : sOption.mobileView,
                    },
                    768:{
                        slidesPerView: sOption.md_slide_view_auto ? "auto" : sOption.tabView,
                    },
                    991:{
                        slidesPerView:sOption.lg_slide_view_auto ? "auto" : sOption.desktopView,
                    }
                }
            });
        }
    }
    function slideCard($scop){
        var slide = $scop.find(".card-slide-wrapper .swiper");
        if (slide.length){ 
            console.log($scop.find(".card-slide-wrapper").attr("data-settings")); 
            var sOption = JSON.parse($scop.find(".card-slide-wrapper").attr("data-settings"));
            console.log(sOption);
            return new Swiper(slide[0], {
                slidesPerView: sOption.desktopView, 
                spaceBetween:sOption.desktopViewSpace, 
                loop: false,
                autoplay:sOption.autoplay ? {
                    delay:1 
                } : false, 
                speed: sOption.speed, 
                on:{
                    touchEnd:function(swiper, event){
                        if(sOption.autoplay){
                            setTimeout(()=>{
                                swiper.autoplay.start(); 
                            },100); 
                        }
                    }
                }, 
                breakpoints:{    
                    0:{
                        spaceBetween:sOption.mobileViewSpace,
                        slidesPerView: sOption.mobileView,
                    },
                    768:{
                        spaceBetween:sOption.tabViewSpace,
                        slidesPerView: sOption.tabView,
                    },
                    991:{
                        spaceBetween:sOption.desktopViewSpace,
                        slidesPerView: sOption.desktopView,
                    }
                }
            });
        }
    }
    function SKTestimonial($scop){ 
        var slideSec = $scop.find(".testimonial-section");
        var slide = $scop.find(".testimonial-slide .swiper");
        var vw = slideSec.find(".video__popup_wrapper");
        var PopUp = slideSec.find(".video__popup");
        var ytPlayer = PopUp.find(".vdo-player");
        var speed = 5000;
        var swiper = new Swiper(slide[0], {
            slidesPerView: 4,
            spaceBetween: 30, 
            breakpoints:{ 
                0:{
                    slidesPerView: 1,
                    spaceBetween: 15,
                },
                650:{ 
                    slidesPerView: 2, 
                    spaceBetween: 20,
                },  
                991:{
                    slidesPerView: 3,
                    spaceBetween: 30,
                }
            }
        });

        gsap.set(vw, { 
            y:-50, 
            opacity:0
        });

        let ytPlayObj;
        
        $(document).on("click", ".testimonial__card .arrow__btn", function(){ 
            var card = $(this).closest(".testimonial__card");
            
            ytPlayObj = onYouTubeIframe(ytPlayer[0], card.attr("data-video"));   

            gsap.to(slide.find(".testimonial__card_wrap"), {
                scale:0.8,
                opacity:0,
                duration:0.3,
                ease:"expo.in"
            }) 
            gsap.to(vw, {
                "display":"block",
                y:0,
                opacity:1,
                ease:"expo.out",
                delay:0.3 
            });
        });
        $scop.find(".close__btn").click(function(){ 
            
            gsap.to(vw, { 
                y:-50,
                opacity:0,
                ease:"expo.in",
                onComplete(){
                    ytPlayObj?.stopVideo(); 
                    gsap.set(vw, {
                        "display":"none",
                    });
                }
            });
            gsap.to(slide.find(".testimonial__card_wrap"), {
                scale:1,
                opacity:1,
                duration:0.5,
                ease:"expo.out",
                delay:0.4
            }) 
        });
    }

    $(document).on("click", 'refresh-st', function(){
        ScrollTrigger.refresh();  
    });

    function checkBoxToggle($scop){ 
        slideImgList($scop);
        let slide = null;
        $scop.find(".toggle__wrap .toggle-head").on("click", function(){ 
            var twrap = $(this).closest(".toggle__wrap");
            twrap.find(".toggle-body").slideToggle(200, function(){ 
                slide?.destroy(); 
                slide = slideImgList($scop); 
                smootScroll?.update();  
                ScrollTrigger.refresh(); 
            });
            twrap.toggleClass("active-toggle");  
        });
    }

    $('a[href*="#"]:not([href="#"]').click(function(event){  
        var __this = $(this); 
        var ScrollDuration = {
            duration:0.1,
            ease:"expo.out"
        }
        if(__this.attr("scroll-to-href")){
            event.preventDefault();
            var sectionWrap = $(__this.attr('scroll-to-href')); 
            gsap.to(window, {
                scrollTo:sectionWrap.offset().top - $("header.header-area").innerHeight(),
                ...ScrollDuration
             })
        }else{ 
            var sectionWrap = $(__this.attr('href'));
            var href = __this.attr('href');
            if(sectionWrap.length){  
                if(sectionWrap.hasClass('scroll-to-sec')){
                    event.preventDefault();
                    __this.attr("href", "#");
                    __this.attr("scroll-to-href", href); 
                     gsap.to(window, {
                        scrollTo:sectionWrap.offset().top - $("header.header-area").innerHeight(),
                        ...ScrollDuration  
                     })
                }       
            }
        } 
    }) 

    $('a[href*="#"]:not([href="#"]').on('click', function(event) { 
        var getPopUp = $($(this).attr('href'));

        if(getPopUp.length){
            if(getPopUp.hasClass('popup-wrapper')){
                event.preventDefault();
                getPopUp.addClass('has-open');
                if((getPopUp.innerHeight() - 60) < getPopUp.find(".content__wrap_main").innerHeight()){
                    gsap.set(getPopUp, {
                        "--popup-h":"100%"
                    });
                }else{
                    gsap.set(getPopUp, {
                        "--popup-h":"auto"
                    });
                } 
                // console.log(getPopUp.innerHeight() - 50 < getPopUp.find(".content__wrap_main").innerHeight());

                var duration = {  
                    duration:0.6,
                    ease:"expo.out"
                }
                getPopUp.find(".content-wrap").addClass("overflow-hidden");
                gsap.set(getPopUp.find(".content__wrap_main"), {
                    opacity:0,
                    y:-200
                })
                gsap.set(getPopUp.find(".content__wrap_main .content__area"), {
                    y:100,
                    opacity:0
                })
                gsap.set(getPopUp.find(".content__wrap_main"), {
                    "display":"block"
                })
                gsap.set(getPopUp, {
                    autoAlpha:1
                })
                gsap.to(getPopUp.find(".content__wrap_main"), {
                    opacity:1,
                    y:0,
                    ...duration
                })
                gsap.to(".popup__backdrop", { 
                    autoAlpha:1,
                    ...duration 
                })
                gsap.to(getPopUp.find(".content__wrap_main .content__area"), { 
                    y:0,
                    opacity:1, 
                    delay:0.1, 
                    ...duration,
                    onComplete(){
                        getPopUp.find(".content-wrap").removeClass("overflow-hidden");
                    }
                })
            }
        }
    });
    $(".popup-wrapper .close-btn, .popup__backdrop").on("click", skPopupClose); 

    function skPopupClose(){
        var getPopUp = $(".popup-wrapper.has-open");
        var duration = {  
            duration:0.4,
            ease:"power2.in"
        }
        gsap.to(getPopUp.find(".content__wrap_main"), {
            opacity:0,
            y:-200,
            ...duration,
            onComplete(){
                gsap.set(getPopUp, {
                    autoAlpha:0
                })
                gsap.set(getPopUp.find(".content__wrap_main"), {
                    "display":"none"
                })
                gsap.set(getPopUp, {
                    "--popup-h":"auto"
                });  
                getPopUp.removeClass("has-open"); 
            }
        })
        gsap.to(".popup__backdrop", {
            autoAlpha:0,
            ...duration 
        })
    }
    
    window.skPopupClose = skPopupClose; 

    ScrollTrigger.refresh(); 
    if(typeof smootScroll !== 'undefined' && smootScroll){
        smootScroll.update();  
        $(window).on("load", function(){
            smootScroll.update();  
            ScrollTrigger.refresh();  
        });
    } 
    document.addEventListener( 'wpcf7submit', function( event ) {
        ScrollTrigger.refresh(); 
        smootScroll?.update();  
        console.log("fire c7- sumonkhan.pro"); 
    }, false );

})(jQuery);


let YTPlayerAPI;

function onYouTubeIframe(el, url) { 
    var ID = extractVideoId(url);
    if(ID){
        if(YTPlayerAPI){ 
            YTPlayerAPI.loadVideoById(ID);
        }else{
            YTPlayerAPI = new YT.Player(el, { 
                videoId: ID,
                playerVars: {
                    autoplay: 1,
                } 
            }); 
        }
    }else{
        console.log("Invalid YouTube URL");
    }
    return YTPlayerAPI;
}

function extractVideoId(url) {
    var regExp = /^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\s&]+)/;
    var match = url.match(regExp);
    return match && match[1];
}
  
