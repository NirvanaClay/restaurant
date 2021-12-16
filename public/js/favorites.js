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
      .then(function (response) {
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