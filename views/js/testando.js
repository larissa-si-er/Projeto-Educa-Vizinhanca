const toggleMenu = document.querySelector('.toggle-menu');
const nav = document.querySelector('nav ul');

toggleMenu.addEventListener('click', () => {
  nav.classList.toggle('active');
});
document.addEventListener("DOMContentLoaded", function() {
  const cards = document.querySelectorAll('.card-top','.card-top2','.car-top3');
  cards.forEach((card, index) => {
    card.style.animationDelay = `${index * 500}ms`; 
  })});