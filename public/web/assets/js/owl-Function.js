var owl_1 = $(".owl_1");
owl_1.owlCarousel({
  rtl: true,
  loop: true,
  responsiveClass: true,
  autoplay: true,
  autoplayTimeout: 3500,
  autoplayHoverPause: true,
  nav: true,
  navText: ["<i class='fa fa-chevron-right'></i>","<i class='fa fa-chevron-left'></i>"],
  responsive: {
    0: {
      items: 2,
      nav: false
    },
    600: {
      items: 3,
      nav: false
    },
    1000: {
      items: 6,
      nav: false
    }
  }
});
 

var owl_1 = $(".owl_2");
owl_1.owlCarousel({
  rtl: true,
  loop: true,
  responsiveClass: true,
  autoplay: true,
  margin:20,
  dots:true,
  autoplayTimeout: 4000,
  autoplaySpeed: 4000,
  autoplayHoverPause: true,
 
   responsive: {
    0: {
      items: 1,
      nav: false
    },
    600: {
      items: 2,
      nav: false
    },
    1000: {
      items: 3,
      nav: false
    }
  }
});
 


var owl_1 = $(".owl_3");
owl_1.owlCarousel({
  rtl: true,
  loop: true,
  responsiveClass: true,
  autoplay: true,
  margin:20,
  dots:true,
  autoplayTimeout: 4000,
  autoplaySpeed: 4000,
  autoplayHoverPause: true,
 
   responsive: {
    0: {
      items: 1,
      nav: false
    },
    600: {
      items: 1,
      nav: false
    },
    1000: {
      items: 1,
      nav: false
    }
  }
});
 