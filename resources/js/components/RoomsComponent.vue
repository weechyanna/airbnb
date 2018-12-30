<template>

<div>

  <form @submit.prevent="searchTitle()">
      <div class="form-group">
          <input v-on:input="searchTitle" type="text" class="form-control" placeholder="Search" v-model="search">
      </div>
  </form>


  <label class="mr-sm-2" for="inlineFormCustomSelect">Type</label>
  <div class="filter">
		<label><input type="radio" v-on:change="onCheckboxChanged" v-model="selectedCategory" value="All" /> All</label>
		<label><input type="radio" v-on:change="onCheckboxChanged" v-model="selectedCategory" value="Entire place" /> Entire place</label>
    <label><input type="radio" v-on:change="onCheckboxChanged" v-model="selectedCategory" value="Private room" /> Private room</label>
  </div>

<div class="row row-eq-height">
  <div v-for="room in rooms">
    <div class="col-md-4"
     <div class="card" style="width: 18rem">
         <div class="card-body">
           <h5 class="card-title">{{ room.title }}</h5>
           <p class="card-text">{{ room.description }}</p>
         </div>
         <ul class="list-group list-group-flush">
           <li class="list-group-item">Price: RM{{ room.price }}</li>
           <li class="list-group-item">Type: {{ room.type }}</li>
           <li class="list-group-item">Location: {{ room.location }}</li>
         </ul>
         <div class="card-body">
           <a href="#" class="card-link">More Info</a>
         </div>
    </div>
  </div>
  </div>
</div>


</template>

<script>
    export default {
      data: function(){
     return {
       rooms: [],
       selectedCategory: 'All',
       search: '',
       room: {
         id: '',
         title: '',
         description: '',
         price: '',
         type: '',
         location: '',
       }
     };
   },
      mounted() {
        console.log('Component mounted.')
        this.getRooms();
      },
      methods: {
        getRooms: function(){
          axios.get('/rooms')
          .then(({ data }) => {
            this.rooms = data;
          }, (error) => {
            console.log(error);
          });
        },
        onCheckboxChanged: function(){
          let type = this.selectedCategory;
            axios.get('/rooms?type=' + type)
            .then(({ data }) => {
              this.rooms = data;
            }, (error) => {
              console.log(error);
            });
        },
        searchTitle: function(){
          let title = this.search;
          let type = this.selectedCategory;
          console.log(title);
            axios.get('/rooms?title=' + title + "&type=" + type)
            .then(({ data }) => {
              this.rooms = data;
            }, (error) => {
              console.log(error);
            });
        }
      }
    }
</script>
