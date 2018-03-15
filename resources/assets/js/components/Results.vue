<template>
    <v-navigation-drawer
            fixed
            clipped
            class="grey lighten-4"
            app
            v-model="drawer"
    >
        <v-list
                dense
                class="grey lighten-4"
        >
            <template v-for="(item, i) in results">

                <v-list-tile
                        :key="i"
                        @click="focusMarker(i)"
                >
                    <v-list-tile-content>
                        <v-list-tile-title class="grey--text">
                            {{ item.text }}
              </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>
        </v-list>
    </v-navigation-drawer>

</template>
<script>
    export default {
        data: () => ({
            drawer: null,
            results: [

            ]
        }),
        methods: {
            focusMarker(index){
                Bus.$emit('marker_result_clicked',index);
            },
            fetchNearestLocations() {
                axios.post('/api/nearest-shops', {center: this.center,radius:this.radius})
                    .then(response => {
                        let data = response.data;
                        Bus.$emit('markers_fetched', data);
                        console.log(response);
                    });
                ;
            },
            getPlace(place){
                let center = {
                    lat: place.geometry.location.lat(),
                    lng: place.geometry.location.lng()
                };
                this.center=center;
                this.fetchNearestLocations();
            },
            onRadiusChange(){
                console.log(this.radius);
            }

        },
        created(){
            Bus.$on('markers_fetched',data=>{
                this.results=data.results;

                console.log('event data',data);
            })
        }
    }
</script>

<style>

</style>
