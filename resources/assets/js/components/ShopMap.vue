<template>
  <gmap-map
    :center="center"
    :zoom="zoom"
    style="width: 100%; height: 100%"
  >
    <gmap-cluster>

    <gmap-marker
      :key="index"
      v-for="(m, index) in markers"
      :position="m.position"
      :clickable="true"
      icon="/star-red.png"
      :draggable="true"
      @click="toggleInfoWindow(m,index)"
    ></gmap-marker>
    </gmap-cluster>

    <gmap-info-window :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen" @closeclick="infoWinOpen=false">
      <info-content :content="infoContent"></info-content>

      </gmap-info-window>

  </gmap-map>
</template>

<script>
  import InfoContent from './InfoContent.vue'
export default {
      components:{
          'info-content':InfoContent
      },
    data () {
      return {
        center: {lat: 42.363211, lng: -105.071875},
        zoom:5,
        markers: [],
          infoContent: '',
          infoWindowPos: {
              lat: 0,
              lng: 0
          },
          infoWinOpen: false,
          currentMidx: null,
          infoOptions: {
              pixelOffset: {
                  width: 0,
                  height: -35
              }
          }
      }
    },
    methods:{
        toggleInfoWindow (marker, idx) {

            this.infoWindowPos = marker.position;
            this.infoContent = marker.name;

            //check if its the same marker that was selected if yes toggle
            if (this.currentMidx == idx) {
                this.infoWinOpen = !this.infoWinOpen;
            }
            //if different marker set infowindow to open and reset current marker index
            else {
                this.infoWinOpen = true;
                this.currentMidx = idx;

            }
        },
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

        Bus.$on('marker_result_clicked',index=>{
           let targetMarker=this.markers[index];
           this.center=targetMarker.position;
           this.toggleInfoWindow(targetMarker,index)


        })
    }
  }
</script>

<style>

</style>
