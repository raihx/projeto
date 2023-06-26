let slideIndex = 0;
showSlides();
var slides

function showSlides() {
  let i;
  slides = document.getElementsByClassName("mySlides");

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slideIndex ++;

  if (slideIndex > slides.length) {
    slideIndex = 1;
  }

  slides[slideIndex - 1].style.display = "block";
  setTimeout(showSlides, 5000); // muda a imagem a cada 10 seg
}

function currentSlide(index) {
  slideIndex = index;

  if (index > slides.length) {
    index = 1;
  } else if (index < 1) {
    index = slides.length;
  }

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slides[index - 1].style.display = "block";
}