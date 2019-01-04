<template>

<div>
<h5 class="logged">{{ isLoggedIn }}</h5>
<h5 class="admin">{{ isAdmin }}</h5>
<a :href="'/admin'" class="btn btn-primary" v-if="isAdmin==='admin'" role="button">Admin</a>

  <form @submit.prevent="searchTitle()">
      <div class="form-group">
          <input v-on:input="searchTitle" type="text" class="form-control" placeholder="Search" v-model="search">
      </div>
  </form>

  <label class="mr-sm-2" for="inlineFormCustomSelect">Type</label>
  <div class="filterType">
		<label><input type="radio" v-on:change="onCheckboxChanged" v-model="selectedCategory" value="All" /> All</label>
		<label><input type="radio" v-on:change="onCheckboxChanged" v-model="selectedCategory" value="Entire place" /> Entire place</label>
    <label><input type="radio" v-on:change="onCheckboxChanged" v-model="selectedCategory" value="Private room" /> Private room</label>
  </div>

  <div class="form-group">
      <label for="location">Location</label>
      <select class="form-control" id="location" v-on:change="onSelectChanged" v-model="selectedLocation">
        <option>Seattle</option>
        <option>Los Angeles</option>
        <option>Ermelo</option>
      </select>
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
           <li class="list-group-item">User: {{ room.user_id }}</li>
           <li class="list-group-item">Current User: {{ userId }}</li>
           <li class="list-group-item">User: {{ room.name }}</li>
         </ul>
         <div class="card-body">
           <a href="#" class="card-link">More Info</a>
         </div>
         <a :href="'/rooms/' + room.id + '/edit'" class="btn btn-primary" v-if="userId==room.user_id || isAdmin==='admin'" role="button">Edit</a>
         <button @click="deleteRoom(room.id)" v-if="userId==room.user_id || isAdmin==='admin'" name="delete" class="btn btn-danger">Delete</button>
    </div>
  </div>
  </div>
</div>

</div>



</template>

<script>
    export default {
      props: [
        "isLoggedIn",
        "userId",
        "isAdmin"
      ],
      data: function(){
     return {
       rooms: [],
       selectedCategory: 'All',
       selectedLocation: '',
       search: '',
       room: {
         id: '',
         title: '',
         description: '',
         price: '',
         type: '',
         location: '',
         user_id: '',
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
        onSelectChanged: function(){
          let location = this.selectedLocation;
            axios.get('/rooms?location=' + location)
            .then(({ data }) => {
              this.rooms = data;
            }, (error) => {
              console.log(error);
            });
          },
        searchTitle: function(){
          let title = this.search;
          let type = this.selectedCategory;
          let location = this.selectedLocation;
          console.log(title);
            axios.get('/rooms?title=' + title + "&type=" + type + "&location=" + location)
            .then(({ data }) => {
              this.rooms = data;
            }, (error) => {
              console.log(error);
            });
        },
        deleteRoom: function(id) {
          axios.delete('/rooms/' + id)
          .then((response) => {
          this.getRooms();
        })
        .catch((err) => console.error(err));
        },
      }
    }
</script>
