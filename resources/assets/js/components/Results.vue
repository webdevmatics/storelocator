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
