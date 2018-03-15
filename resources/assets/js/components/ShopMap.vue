<template>
  <gmap-map
    :center="center"
    :zoom="zoom"
    style="width: 1300px; height: 100%"
  >
    <gmap-marker
      :key="index"
      v-for="(m, index) in markers"
      :position="m.position"
      :clickable="true"
      :draggable="true"
      @click="center=m.position"
    ></gmap-marker>
  </gmap-map>
</template>

<script>
export default {
    data () {
      return {
        center: {lat: 42.363211, lng: -105.071875},
        zoom:5,
        markers: []
      }
    },
    methods:{
        fetchLocations() {
            axios.post('/api/nearest-shops',{center:this.center})
                .then(response=>{
                    let data=response.data;
                    Bus.$emit('markers_fetched',data);
//                    this.markers=data.markers;
                });
            ;
        }
    },
    created(){
        this.fetchLocations();
        Bus.$on('markers_fetched',data=>{
            this.markers=data.markers;
            if(this.markers.length>0){
                this.center=data.markers[0].position;
            }
            console.log('event data',data);
        })
    }
  }
</script>

<style>

</style>
