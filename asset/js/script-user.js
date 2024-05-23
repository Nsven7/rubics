// Slider
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("slide");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  if (slides[slideIndex-1]) {slides[slideIndex-1].style.display = "block";}  
}

// Slider project
// Slider
var slideIndexProject = 1;
showSlidesProject(slideIndexProject);

function upSlides(n) {
  showSlidesProject(slideIndexProject += n);
}

function currentSlide(n) {
  showSlidesProject(slideIndexProject = n);
}

function showSlidesProject(n) {
  var i;
  var slidesProject = document.getElementsByClassName("slide-project");
  var dots = document.getElementsByClassName("dot");
  if (n > slidesProject.length) {slideIndexProject = 1}    
  if (n < 1) {slideIndexProject = slidesProject.length}
  for (i = 0; i < slidesProject.length; i++) {
      slidesProject[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  if (slidesProject[slideIndexProject-1]) {slidesProject[slideIndexProject-1].style.display = "block";}  
}

// Mobile menu
document.getElementById('burger-menu').addEventListener('click', function() {
  document.getElementById('menu-overlay').classList.add('open');
});

document.getElementById('close-menu').addEventListener('click', function() {
  document.getElementById('menu-overlay').classList.remove('open');
});