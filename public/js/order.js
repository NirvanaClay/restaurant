const cartItems = document.querySelectorAll('.item');
const cartCards = document.querySelectorAll('.giftcard');

//Calculate price values at checkout
const cardAmt = document.querySelector('.card-amount');
subCount = 0;

if(cartItems){
  for(cartItem of cartItems){
    let subPrice = cartItem.querySelector('.price').value;
    let quantity = cartItem.querySelector('.quantity-field').value;
    let totalPriceNum = subPrice * quantity;
    subCount += totalPriceNum;
  }
}

cardPrice = 0;

for(cartCard of cartCards){
  let amount = cartCard.querySelector('.amount').value;
  let amountNum = parseFloat(amount);
  cardPrice += amountNum;
}

const selectReward = document.querySelector('.reward-select');
const rewardsNum = document.querySelector('.rewards_num');
const finalForm = document.querySelector('#final-order');
const rewards = document.querySelectorAll('.reward');

rewardAmts = document.querySelectorAll('.reward-option');
rewardIds = document.querySelectorAll('.rewardId');

let taxContainer = document.querySelector('.tax-value');
let subContainer = document.querySelector('.subtotal');
let totalContainer = document.querySelector('.realTotal');
const freeDrink = document.querySelector('.freeDrink');

const userSpent = document.querySelector('.user-spent');

let totalNoRewards = 0;

const getPriceVals = () => {
  if(freeDrink){
    realPrice = subCount + cardPrice - freeDrink.value;
  }
  else{
    realPrice = subCount + cardPrice;
  }
  if(subContainer){
    subContainer.innerText = realPrice.toFixed(2);
  }
  if(taxContainer){
    taxContainer.innerText = (subCount * .07).toFixed(2);
    taxNum = parseFloat(taxContainer.innerText);
  }
  if(realPrice){
    totalNoRewards = realPrice + taxNum;
    totalContainer.innerText = totalNoRewards.toFixed(2);
  }
  if(cardAmt){
    cardAmt.value = cardPrice.toFixed(2);
  }
  if(userSpent){
    userSpent.value = totalContainer.innerText;
  }
}

getPriceVals();

const availRewards = () => {
  rewardsLeft = [];
  for(let rewardAmt of rewardAmts){
    rewardsLeft.push(rewardAmt.value);
    if(rewardAmt.value > totalNoRewards){
      rewardAmt.remove();
      rewardsLeft.pop();
    }
  }
}

availRewards();

const getRewardIds = () => {
  availRewardIds = [];
  for(let rewardId of rewardIds){
    availRewardIds.push(rewardId.value);
    if((availRewardIds.length * 5) > totalNoRewards){
      rewardId.remove();
      availRewardIds.pop();
    } 
  }
}

getRewardIds();

const useRewards = () => {
  if(rewardsNum && selectReward){
    rewardsNum.value = selectReward.value / 5;
    for(i=0; i < selectReward.value / 5; i++){
      if(document.querySelector('#reward' + (i+1))){
        reward = document.querySelector('#reward' + (i+1));
        reward.remove();
      }
    }
    for(i=0; i < selectReward.value / 5; i++){
      input = document.createElement("input");
      input.setAttribute("type", "hidden");
      input.setAttribute("name", ("reward" + (i+1)));  
      input.setAttribute("id", ("reward" + (i+1)));  
      input.setAttribute("value", availRewardIds[i]);
      finalForm.appendChild(input);
    }
  }
  if(totalNoRewards && rewardsNum){
    totalWithRewards = totalNoRewards - (rewardsNum.value * 5);
    if(totalNoRewards == totalWithRewards){
      totalContainer.innerText = totalNoRewards.toFixed(2);
    }
    else{
      totalContainer.innerText = totalWithRewards.toFixed(2);
      userSpent.value = totalWithRewards.toFixed(2);
    } 
  }
}

useRewards();