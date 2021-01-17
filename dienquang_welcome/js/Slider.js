var slideIndex = 0;
showSlides();
function showSlides() {
    var i;
    var slides = document.querySelectorAll(".slide");
    var dots = document.querySelectorAll(".dot img");
    slides.forEach(function( s ){
      s.classList.add( "dnone");  
      s.classList.remove( "dgrid");  
    })
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
      dots[i].classList.remove("active");
    }
    let cur = slides[slideIndex-1] 
    cur.classList.remove('dnone');
    cur.classList.add('dgrid');  
    dots[slideIndex-1].classList.add("active");
    setTimeout(showSlides, 5000); // Change image every 2 seconds
}
