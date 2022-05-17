
///Check whether or not there are cart items and display icon accordingly
const numContainer = document.querySelector('.num__container');
const cartNum = document.querySelector('.num');
let numItem = parseInt(cartNum.innerText);

userWelcome = document.querySelector('.welcome');

const checkCart = () => {
  if(numItem > 0){
    numContainer.style.display = 'flex';
  }
  else{
    numContainer.style.display = 'none';
  }
}

checkCart();

//Add item to cart
const cartForms = document.querySelectorAll('.addToCart');

for(cartForm of cartForms){
  cartForm.addEventListener('submit', async function(e) {
    e.preventDefault();
    axios.post('/items', {
      name: this.name.value,
      image_url: this.image_url.value,
      description: this.description.value,
      price: this.price.value, 
      category: this.category.value,
      id: this.id.value,
      quantity: 1
    })
    .then(function (response) {
      ++numItem;
      cartNum.innerText = numItem;
      checkCart();
      if(userWelcome){
        cartIcon.style.top = '-18px';
        numContainer.style.top = '-8px';
      } else{
        cartIcon.style.top = '-10px';
      }
    })
    .catch(function (error) {
      console.log(error);
    });
  })
}

//Update item quantity
const updateForms = document.querySelectorAll('.updateQuantity');

for(updateForm of updateForms){
  let hiddenField = updateForm.querySelector("input[name='quantity']");
  let quantityOptions = updateForm.querySelectorAll(".quantity-option");
  for(quantityOption of quantityOptions){
    if(quantityOption.value == hiddenField.value){
      quantityOption.selected = 'selected';
    }
  }
}

cartIcon = document.querySelector('.fa-shopping-cart');

if(userWelcome){
  cartIcon.style.top = '-10px';
  if(numItem > 0){
    userWelcome.style.top = '-15px';
    cartIcon.style.top = '-18px';
    numContainer.style.top = '-8px'
  };
} else {
  if(numItem > 0){
    cartIcon.style.top = '-10px';
  }
}