import { 
  gsap
 } from "gsap/all";
 import { ScrollTrigger } from "gsap/ScrollTrigger";
 gsap.registerPlugin(ScrollTrigger);

 class FadeOnScroll {
   constructor() {
     this.els = gsap.utils.toArray('.fade')
     this.lines = gsap.utils.toArray('.line')
     this.fade()
   }

   fade() {
     this.els.forEach((item) => {
       gsap.from(item,  {
         y:'50px',
         opacity:0,
         scrollTrigger: {
          trigger: item,
          start:"bottom bottom",
          end: "+=200px",
          scrub:1,
          once:true,
        }
       })
     })

     this.lines.forEach((line) => {
      gsap.from(line,  {
        height:'0',
        y: '100%',
        scrollTrigger: {
         trigger: line,
         start:"bottom bottom",
         end: "+=200px",
         transformOrigin:"top",
         scrub:1,
         once:true,
       }
      })
    })
   }
 }

 export default FadeOnScroll