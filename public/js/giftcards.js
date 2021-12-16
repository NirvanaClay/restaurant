const giftcardBtns = document.querySelectorAll('.giftcard-btn');
const cardAmount = document.querySelector('.buyCard-amount');
const cardForm = document.querySelector('#addGift');
const hiddenAmount = document.querySelector('.hiddenGcAmt');

const updateHidden = () => {
  for(let giftcardBtn of giftcardBtns){
    if(giftcardBtn.classList.contains('active')){
      hiddenAmount.value = giftcardBtn.value;
    }
  }
}

const updateCustom = () => {
  hiddenAmount.value = '$' + cardAmount.value;
}

for(let giftcardBtn of giftcardBtns){
  giftcardBtn.onclick = () => {
    document.querySelector('.giftcard-btn.active')?.classList.remove('active');
    giftcardBtn.classList.add('active');
    updateHidden();
  }
}

if(cardAmount){
  cardAmount.addEventListener('keypress', function(){
    document.querySelector('.giftcard-btn.active')?.classList.remove('active');
    updateCustom();
  });
}

if(cardForm){
  cardForm.addEventListener('submit', async function(e) {
    if(cardAmount.value){
      updateCustom();
    }
    else {
      updateHidden();
    }
  })
};