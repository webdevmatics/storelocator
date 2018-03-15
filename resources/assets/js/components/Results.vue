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
                <v-layout
                        row
                        v-if="item.heading"
                        align-center
                        :key="i"
                >
                    <v-flex xs6>
                        <v-subheader v-if="item.heading">
                            {{ item.heading }}
              </v-subheader>
                    </v-flex>
                    <v-flex xs6 class="text-xs-right">
                        <v-btn small flat>edit</v-btn>
                    </v-flex>
                </v-layout>
                <v-divider
                        dark
                        v-else-if="item.divider"
                        class="my-3"
                        :key="i"
                ></v-divider>
                <v-list-tile
                        :key="i"
                        v-else
                        @click=""
                >
                    <v-list-tile-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>
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
