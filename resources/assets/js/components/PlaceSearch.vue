<template>
  <div 
class="input-group input-group--prepend-icon input-group--solo input-group--solo-inverted elevation-0 input-group--text-field input-group--single-line primary--text">
<label></label>
<div class="input-group__input">
  <i aria-hidden="true" class="icon material-icons input-group__prepend-icon"></i>
  <gmap-autocomplete
         class='autocomplete'
         @place_changed="getPlace"
          >
        </gmap-autocomplete>

  </div>
  <div class="input-group__details">
  </div>

  </div>
</template>

<script>
export default {
    data () {
      return {
        
      }
    },
    methods:{
        fetchNearestLocations(center) {
            axios.post('/api/nearest-shops',{center:center})
                .then(response=>{
                    let data=response.data;
                    Bus.$emit('markers_fetched',data);
                    console.log(response);
                });
            ;
        },
        getPlace(place){
          let center={
              lat: place.geometry.location.lat(),
              lng: place.geometry.location.lng()
          };
            this.fetchNearestLocations(center);
        }

    }
  }
</script>

<style>

</style>
