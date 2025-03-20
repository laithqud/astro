document.addEventListener("DOMContentLoaded", function () {
  const sliderContainer = document.querySelector(".category-slider-container");
  const scrollLeftBtn = document.querySelector(".scroll-left");
  const scrollRightBtn = document.querySelector(".scroll-right");

  scrollLeftBtn.addEventListener("click", () => {
    sliderContainer.scrollBy({ left: -150, behavior: "smooth" });
  });

  scrollRightBtn.addEventListener("click", () => {
    sliderContainer.scrollBy({ left: 150, behavior: "smooth" });
  });
});


const bottomNav = document.querySelector('.bottom-nav');
const navnav = document.querySelector('.navnav')
// when scroll none

window.addEventListener('scroll', () => {
  if (window.scrollY > 0) {
    bottomNav.style.opacity = '0';
    bottomNav.classList.add('d-none');
    navnav.style.minHeight = '60px';
  } else {
    bottomNav.style.opacity = '1';
    bottomNav.classList.remove('d-none');
    navnav.style.minHeight = '100px';
  }
});

