const slider = document.querySelector('.fav-slider');
const circle1 = document.querySelector('.circle-1');
const circle2 = document.querySelector('.circle-2');
const circle3 = document.querySelector('.circle-3');
const circle4 = document.querySelector('.circle-4');

const favs = document.querySelectorAll('.user-favs');

// const medium = window.matchMedia('(max-width: 768px)');
const medium = window.matchMedia('(max-width: 1024px)');
const small = window.matchMedia('(max-width: 576px)');
const xSmall = window.matchMedia('(max-width: 320px)');

let left= '-900px';

function checkScreenSize(){
  ///default display
  if(circle1 && circle2 && circle3 && circle4){
    circle1.style.display='flex';
    circle2.style.display='flex';
    circle3.style.display='flex';
    circle4.style.display='flex';
    circle1.style.background = '#ff0000';
    circle2.style.background = '#bebebe';
    circle3.style.background = '#bebebe';
    circle4.style.background = '#bebebe';
    slider.style.left = '0';
    if (medium.matches && !small.matches && !xSmall.matches){
      left='-600px';
      circle4.style.display = 'none';
      if(favs.length <=6){
        console.log('4-6 items');
        circle3.style.display = 'none';
      }
      else if(favs.length <=3){
        console.log('4-6 items');
        circle2.style.display = 'none';
      }
    } 
    else if(small.matches && !xSmall.matches){
      left='-300px';
      if(favs.length <=2){
        console.log('0-2 items');
        circle2.style.display = 'none';
        circle3.style.display = 'none';
        circle4.style.display = 'none';
      } 
      else if(favs.length <=4){
        console.log('3-4 items');
        circle3.style.display = 'none';
        circle4.style.display = 'none';
      } 
      else if(favs.length <=6){
        console.log('5-6 items');
        circle4.style.display = 'none';
      }
    } 
    else if(xSmall.matches){
      left='-200px'; 
      if (favs.length <= 1){
        circle2.style.display = 'none';
        circle3.style.display = 'none';
        circle4.style.display = 'none';
      } 
      else if(favs.length <= 2){
          circle3.style.display = 'none';
          circle4.style.display = 'none';
      } 
      else if(favs.length <= 3){
          circle4.style.display = 'none';
      }
    }  
    else {
      left='-900px';
      if(favs.length <= 4){
        circle2.style.display = 'none';
        circle3.style.display = 'none';
        circle4.style.display = 'none';
      } 
      else {
        circle3.style.display = 'none';
        circle4.style.display = 'none';
      }
    }
  }
};

window.addEventListener('resize', checkScreenSize);

checkScreenSize();

if(circle1){
  circle1.onclick = () => {
    slider.style.left = '0';
    circle1.style.background = '#ff0000';
    circle2.style.background = '#bebebe';
    circle3.style.background = '#bebebe';
    circle4.style.background = '#bebebe';
  }
}
if(circle2){
  circle2.onclick = () => {
    slider.style.left = left;
    circle2.style.background = '#ff0000';
    circle1.style.background = '#bebebe';
    circle3.style.background = '#bebebe';
    circle4.style.background = '#bebebe';
  }
}
if(circle3){
  circle3.onclick = () => {
    newLeft = 2 * parseInt(left);
    slider.style.left = newLeft + 'px';
    circle3.style.background = '#ff0000';
    circle1.style.background = '#bebebe';
    circle2.style.background = '#bebebe';
    circle4.style.background = '#bebebe';
  }
}
if(circle4){
  circle4.onclick = () => {
    newLeft = 3 * parseInt(left);
    slider.style.left = newLeft + 'px';
    circle4.style.background = '#ff0000';
    circle1.style.background = '#bebebe';
    circle2.style.background = '#bebebe';
    circle3.style.background = '#bebebe';
  }
}