     
    function smoothScrollFun(){
        if(pageRoot.length){ 
            $("body,html").scrollTop(0); 
            
            smootScroll = new LocomotiveScroll({ 
                el:pageRoot[0],
                smooth:true, 
                touchMultiplier:5, 
                multiplier:1.5, 
                tablet:{
                    breakpoint:768,
                    smooth:true,
                },
                smartphone:{ 
                    breakpoint:0,
                    smooth:true
                }
            });
            if(smootScroll){
                $("body").addClass("overflow__hidden"); 
                if($("body").hasClass("elementor-editor-active")) {
                    $("body").removeClass("overflow__hidden");
                }
            }
            setTimeout(() => {  
                if($("body").hasClass("elementor-editor-active")) {
                    $("body").removeClass("overflow__hidden");
                } 
            }, 1500);
    
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
            ScrollTrigger.defaults({
                scroller: pageRoot[0]
            })  
            ScrollTrigger.refresh(); 
            ScrollTrigger.addEventListener("refresh", () => smootScroll?.update()); 
            smootScroll?.scrollTo(0, {
                duration:0
            });  
            window.smoothScroll = smootScroll;
            return smootScroll;
        }
    }