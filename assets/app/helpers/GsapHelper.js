import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

function animateFrom(elem, direction) {
    direction = direction || 1;
    var x = 0,
        y = direction * 100;
    if(elem.classList.contains("gs_reveal_fromLeft")) {
        x = -500;
        y = 0;
        elem.style.transform = "translate(" + x + "px, " + y + "px)";
        elem.style.opacity = "0";
        gsap.fromTo(elem, {x: x, y: y, autoAlpha: 0}, {
            duration: 1.25, 
            x: 0,
            y: 0, 
            autoAlpha: 1, 
            ease: "expo", 
            overwrite: "auto"
    });
    } else if (elem.classList.contains("gs_reveal_fromRight")) {
        x = 500;
        y = 0;
        elem.style.transform = "translate(" + x + "px, " + y + "px)";
        elem.style.opacity = "0";
        gsap.fromTo(elem, {x: x, y: y, autoAlpha: 0}, {
            duration: 1.25, 
            scrub: true,
            x: 0,
            y: 0, 
            autoAlpha: 1, 
            ease: "expo", 
            overwrite: "auto"
    });
    } else if (elem.classList.contains("gs_reveal_fromBottom")) {
        x = 0;
        y = 200;
        elem.style.transform = "translate(" + x + "px, " + y + "px)";
        elem.style.opacity = "0";
        gsap.fromTo(elem, {x: x, y: y, autoAlpha: 0}, {
            duration: 1.25, 
            x: 0,
            y: 0, 
            scrub:true,
            autoAlpha: 1, 
            ease: "expo", 
            overwrite: "auto"
        });
    }else if(elem.classList.contains("gs_reveal_zoom")){
        x = 0;
        y = 200;
        elem.style.transform = "scale(" + x + "px, " + y + "px)";
        gsap.fromTo(elem, {x: x, y: y, autoAlpha: 0}, {
            duration: 1.25, 
            scrub: true,
            x: 0,
            y: 0, 
            ease: "expo", 
            overwrite: "auto"
        });
    }       
}

function hide(elem) {
    gsap.set(elem, {autoAlpha: 0});
}

export const gsapInit = () => {

    gsap.registerPlugin(ScrollTrigger);

    gsap.utils.toArray(".gs_reveal").forEach(function(elem) {
        hide(elem);            
        ScrollTrigger.create({
            trigger: elem,
            onEnter: function() { animateFrom(elem) }, 
            onEnterBack: function() { animateFrom(elem, -1) },
        });
    });

    gsap.utils.toArray(".gs_pelicule").forEach(function(elem) {
        
        gsap.to(elem, {
            scrollTrigger:{
                trigger: elem,
                scrub: true,
                start: "bottom bottom",
                end: () => "+=" + elem.offsetWidth,
                toggleActions: "restart pause reverse pause",
            },
            x: 500,
            duration: 1.2,
        })
        
    });

    gsap.utils.toArray(".gs_video").forEach(function(elem) {
        
        gsap.to(elem, {
            scrollTrigger:{
                trigger: elem,
                scrub: 2,
                start: "bottom bottom",
                end: () => "+=" + elem.offsetWidth,
                toggleActions: "restart pause reverse pause",
            },
            scale: .6,
            transformOrigin: "top center",
            duration: 1.2,
        })
        
    });

}    