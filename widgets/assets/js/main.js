gsap.registerPlugin(ScrollTrigger);
;(function($) {  

    function getBodyH(){$("body").css("--body-height", $("body").innerHeight()+"px");}
    getBodyH();

  /*  $(window).on("load", function(){ 
        getBodyH(); 
        gsap.to(".preloader-wrap", {
            scale:0,
            ease:"expo.in",
            opacity:0,
            duration:1,
            onComplete(){
                heroAni($(".hero__area")); 
                $(".preloader__area").fadeOut(100);
            }
        })
    }); */


    function getContainerSpace(){
        var ElContainerWidth = $(".elementor-section.elementor-section-boxed > .elementor-container").innerWidth();
        var WindowWidth = $(window).innerWidth();
        var getContainerSpace = (WindowWidth - ElContainerWidth) / 2;
        gsap.set("body", {
            "--box-container-space":getContainerSpace+"px"
        })
    } getContainerSpace();

    $(window).on("resize", getContainerSpace);

    $(window).on('elementor/frontend/init', function(){ 
        getBodyH();
        elementorFrontend.hooks.addAction( 'frontend/element_ready/SkdevHeader.default', SkdevHeader);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/skdevCard.default', skdevCard);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/skdevHero.default', skdevHero);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/bgWithContent.default', bgWithContent);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/global', globalScript);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/carImg.default', carImg);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/SkdevFooter.default', SkdevFooter);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/Accordion.default', Accordion);
    });

    function carImg($scop){
        var car = $scop.find(".car__img");
        gsap.set(car, {
            scale:0.5,
            x:"-100%"
        })
        gsap.to(car, { 
            scale:1,
            x:"0%",
            scrollTrigger:{
                trigger:$scop,
                start:"top 95%",
                end:"bottom 70%",
                scrub:true
            }
        })

    }
    function convertToSlug(Text)
    {
        return Text
            .toLowerCase()
            .replace(/ /g,'-')
            .replace(/[^\w-]+/g,'')
            ;
    }
    function SkdevHeader($scop){
        $(".sticky--header").each(function(){
            $(this).sticky({topSpacing:0});
        });

        $scop.find(".navbar-lg .navbar__nav > li .sub-menu").each(function(){
            var childList = $(this).find("> li");
            var Parent = $(this);
            if(childList.hasClass("mega-menu")) Parent.addClass("mega-menu");   
            if(childList.hasClass("fluid-menu")) Parent.addClass("fluid-menu");
            if(childList.hasClass("center-menu")) Parent.addClass("center-menu");
        });

        function fulidMenuPos(){
            var menuLg = $scop.find(".navbar-lg");
            var menuItems = menuLg.find(".navbar__nav > li");
            menuItems.each(function(){
                var item = $(this);
                item.css({
                    '--offset-left':item.offset().left - menuLg.offset().left+"px",
                    '--offset-left-minus':- (item.offset().left - menuLg.offset().left)+"px" 
                })
            })
            menuLg.css({
                '--menu-wrap-width':menuLg.innerWidth()+"px"
            })
            $(".mobile-menu-wrapper").css({
                '--left-offset':menuLg.offset().left+"px" 
            })
        } fulidMenuPos();

        $(window).on("resize", fulidMenuPos);
        
        $scop.find(".open-side-menu").click(function () {
            $(".mobile-menu-wrapper").addClass("open")
            // $scop.find(".hum-btn").toggleClass("open") 
        })

        $scop.find(".mobile-menu-wrapper .navbar__nav_sm .sub-menu").each(function(index, el){
            var MenuTitle = $(this).prev().text();
            var subMenu = $(this); 
            var subMenuHtml = $(this)[0].outerHTML;
            var parentMenuContentWrap = $(this).closest(".mobile-menu-content-wrap");
            var parentMenuItem = subMenu.closest(".menu-item");
            parentMenuItem.addClass("has-sub-menu");
            parentMenuItem.append(`
                <button class='open-submenu' data-submenu="#sub-menu-${convertToSlug(MenuTitle)}-${index}"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg></button>
            `);
            parentMenuContentWrap.append(`<div id="sub-menu-${convertToSlug(MenuTitle)}-${index}" class="sub-menu-content-wrap menu-content-wrap">
            <div class="mmenu-header d-flex align-items-center">
                <button class="back--btn back-side-menu me-auto d-lg-none"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" /></svg></button>
                <button class="close-btn close-side-menu d-lg-none"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>
            <h5 class="title">${MenuTitle}</h5>${subMenuHtml}</div>`);

            parentMenuItem.find(".sub-menu").remove();
        });


        $(document).on("click", ".mobile-menu-wrapper .mobile-menu-content-wrap .open-submenu", function(){
            
            var nextMenu = $($(this).attr('data-submenu'));
            var currentMenu = $(this).closest(".menu-content-wrap");
            nextMenu.addClass("enable"); 
            currentMenu.addClass("disable");
        }); 
        $(document).on("click", ".mobile-menu-wrapper .close-side-menu", function(){
            $(".enable").removeClass("enable");
            $(".disable").removeClass("disable");  
            $(".mobile-menu-wrapper").removeClass("open")
        });  
        $(document).on("click", ".mobile-menu-wrapper .back-side-menu", function(){
            $(".enable").removeClass("enable");
            $(".disable").removeClass("disable"); 
        }); 

    }  

    function skdevCard($scop) {
        var card = $scop.find(".card__wrap");
        var title = card.find(".title");
        var img = card.find(".img--inner");
        var des = card.find(".des");
        var btn = card.find(".btn__main-wrap");
        gsap.set([img, title, des, btn], {
            opacity:0,
            y:70
        }); 
        gsap.set(card, {
            opacity:0,
            y:-70
        }); 
        gsap.timeline({
            scrollTrigger:{
                trigger:$scop,
                start:"top 80%",
                toggleActions: "play none none reverse",
            }
        })
        .to(card, {
            opacity:1,
            y:0,
            duration:0.7,
            ease:"expo.out",
        })
        .to([img, title, des, btn], {
            opacity:1,
            y:0,
            ease:"expo.out",
            duration:1, 
            stagger:0.1,
        });


    }
    function skdevHero($scop){ 
        heroAni($scop);
        var heroBg = $scop.find(".hero-bg-wrapper");
        gsap.to(heroBg.find('.bg__main'), { 
            backgroundPositionY:"100%",
            scrollTrigger:{
                trigger:heroBg.find('.bg__main'),
                start:()=>{
                    return `top ${heroBg.find('.bg__main').offset().top}`
                },
                end:"50% top", 
                scrub:true,
            }
        })
    }

    let heroTl;

    function heroAni($scop){ 
        heroTl?.kill();
        var hero = $(".hero-section-wrapper");
        var heroBg = hero.find(".hero-bg-wrapper");
        var textBox = hero.find(".text-box-content");
        var shape = hero.find(".main--custom-shape-wrap")

        gsap.set(heroBg, {
            y:-100,
            opacity:0
        })
        gsap.set(shape, {
            rotation:180,
            y:"200%",
            opacity:0
        })
        gsap.set([textBox], {
            y:100,
            opacity:0
        })

        heroTl = gsap.timeline()
        .to(heroBg, {
            y:0,
            opacity:1,
            ease:"expo.out",
            duration:0.7
        })
        .to(textBox, { 
            y:0,
            opacity:1,
            ease:"expo.out",
            duration:1
        }, "-=0.7")
        .to(shape, {
            rotation:0,
            y:"0%",
            opacity:1, 
            ease:"back.out", 
            duration:0.4,
            onComplete(){
                ScrollTrigger.refresh();
            }
        }, "-=0.6"); 
    }


    function bgWithContent($scop){
        var wrap = $scop.find(".bg__content-section");
        if(wrap.find(".bg-wrapper").hasClass("has-bg-prallax")){ 
            BgPosPrallax(wrap.find(".bg-wrapper"), wrap.find(".bg-wrapper .bg-area"));
        }
    }

    
    function BgPosPrallax(trigger, bg){
        gsap.to(bg, {
            backgroundPositionY:"100%",
            scrollTrigger:{
                trigger,
                start:"top 80%",
                end:"bottom 20%", 
                scrub:true,
            }
        })
    }

    function SkdevFooter($scop){ 
        var bg = $scop.find(".footer-wrapper .left-bg");
        var trigger = $scop.find(".footer-wrapper");  
        gsap.set(bg, { 
            backgroundPositionY:"0%",
        })
        gsap.to(bg, {
            backgroundPositionY:"100%",
            scrollTrigger:{
                trigger,
                start:"top 90%",
                end:"bottom 100%", 
                scrub:true,
            }
        })

        var footerBox = $scop.find(".footer__box");
        var footerBoxContent = $scop.find(".footer__box_content");
        var footerLinkBox = $scop.find(".footer-link-box");

        gsap.set(footerBox, {
            x:"100%"
        }) 
        gsap.set([footerBoxContent, footerLinkBox], {
            y:100,
            opacity:0
        }) 
        
        gsap.timeline({
            scrollTrigger:{
                trigger:$scop,
                start:"top 80%",
                toggleActions: "play none none reverse",
            }
        })
        .to(footerBox, {
            x:"0%",
            ease:"expo.out"
        }) 
        .to([footerBoxContent, footerLinkBox], {
            y:0, 
            opacity:1,
            duration:1,
            stagger:0.1,
            ease:"expo.out"
        })  
    }


    $(".skdev-custom-bg-prallax").each(function(){
        var _this = $(this); 
        var url = _this.css('background-image');
        _this.append(`<div class='skdev__custom__prallax_bg' style='background-image:${url}'>`);
        var mainBg = $(this).find(".skdev__custom__prallax_bg");
        BgPosPrallax(_this, mainBg);
    });
    

    function globalScript(){
        getBodyH(); 
        $(".has_custom_bg__shape").each(function(){
            if(!$(this).find(".main--custom-shape-wrap").length){
                $(this).append(`<div class='main--custom-shape-wrap'></div>`);
                var customBG = $(this).find(".main--custom-shape-wrap");
                var bgUrl = customBG.css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');
                if(bgUrl != 'none' && bgUrl != ""){ 
                    customBG.append(`<img src="${bgUrl}" />`); 
                } 
                gsap.set(customBG, {
                    backgroundImage:"none"
                }) 
            }
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
                } console.log(getPopUp.innerHeight() - 50 < getPopUp.find(".content__wrap_main").innerHeight());

                var duration = {  
                    duration:0.6,
                    ease:"expo.out"
                }
                getPopUp.find(".content-wrap").addClass("overflow-hidden");
                gsap.set(getPopUp.find(".content__wrap_main"), {
                    opacity:0,
                    y:-200
                })
                gsap.set(getPopUp.find(".content__wrap_main .inner-shape"), {
                    rotation:-180,
                    y:-100,
                    opacity:0
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
                gsap.to(getPopUp.find(".content__wrap_main .inner-shape"), {
                    rotation:0,
                    y:0,
                    opacity:1,
                    ...duration,
                    delay:0.3
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
    $(".popup-wrapper .close-btn, .popup__backdrop").on("click", function(){  
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
    });


    function Accordion($scop){ 
        var wrap = $scop.find(".accordion-wrapper")
        var Title = $scop.find(".accordion-wrapper .title");
        if(wrap.hasClass("use-as-toggle")){
            Title.click(function(){
                $(this).closest('.accordion-item').find('.accordion-body').slideToggle(150);
                $(this).closest('.accordion-item').toggleClass("active"); 
            });
        }else{
            Title.click(function(j) {
                var dropDown = $(this).closest('.accordion-item').find('.accordion-body');
        
                $(this).closest('.accordion-wrapper').find('.accordion-body').not(dropDown).slideUp(150);
        
                if ($(this).parent().hasClass('active')) {
                    $(this).parent().removeClass('active');
                } else {
                    $(this).closest('.accordion-wrapper').find('.accordion-item.active').removeClass('active');
                    $(this).parent().addClass('active');
                }
        
                dropDown.stop(false, true).slideToggle(150);
        
                j.preventDefault();
            });
        }
    }



})(jQuery);