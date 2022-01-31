const sandwich = document.querySelector('.sandwich');
const smallNavItems = document.querySelector('.small-menu');

sandwich.onclick = () => {
  if (smallNavItems.style.display == "none" || !smallNavItems.style.display) {
    smallNavItems.style.display = "flex";
  } else {
    smallNavItems.style.display = "none";
  };
}

window.addEventListener('resize', function(){
  smallNavItems.style.display = 'none';
})