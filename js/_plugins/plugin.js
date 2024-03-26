// $(".animsition").animsition({
//     inClass: "fade-in-right-lg",
//     outClass: "fade-out-right-lg",
//     linkElement: ".animsition-container a",
//     inDuration: 1000,
//     outDuration: 500
// });

$(".navbar").sticky();

$(".navbar").on("sticky-start", ()=>{
    $(".navbar").addClass("nav-red");
});

$(".navbar").on("sticky-end", ()=>{
    $(".navbar").removeClass("nav-red");
});

$(".slides").slick({
    fade:true,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
    dots: true

    // slidesToShow: 2,
    // slidesToScroll: 2
});