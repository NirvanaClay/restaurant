function showAddedFavoritePopup(favItem) {
  let popup = document.createElement('div');
  popup.classList.add('favorite-popup');
  popup.innerText = 'Favorite added';
  let container = favItem.closest('.add-container');
  container.appendChild(popup);

  setTimeout(function() {
      popup.style.opacity = '0';
      setTimeout(function() {
          container.removeChild(popup);
      }, 1000);
  }, 3000);
}

//Add Favorites
const addFavs = document.querySelectorAll('.addFav');

for(addFav of addFavs){
  addFav.addEventListener('submit', async function(e) {
    e.preventDefault();
    axios.post('/favorites', {
      name: this.name.value,
      image_url: this.image_url.value,
      description: this.description.value,
      price: this.price.value,
      category: this.category.value,
      fav_id: this.fav_id.value,
      user_id: this.user_id.value
      })
      .then((response) => {
        showAddedFavoritePopup(this);
        console.log(this);
      })
      .catch(function (error) {
        console.log(error);
      });
  })
}

//Delete Favorites
const deleteFavs = document.querySelectorAll('.deleteFavs');

for(deleteFav of deleteFavs){
  deleteFav.addEventListener('submit', async function(e) {
      e.preventDefault();
      parent = this.parentElement;
      grandparent = parent.parentElement;
      id = this.id.value;
      axios.delete(`/favorites/${id}`, this.deletedata)
      .then(function (response) {
        grandparent.remove();
      })
      .catch(function (error) {
        console.log(error);
      });
  })
}