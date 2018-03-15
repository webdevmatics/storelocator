<template>
  <v-app id="inspire">

   <results></results>

    <v-toolbar color="amber" app absolute clipped-left>
      <v-toolbar-side-icon @click.native="drawer = !drawer"></v-toolbar-side-icon>
      <span class="title ml-3 mr-5">StoreLocator&nbsp;<span class="text">App</span></span>

        <place-search></place-search>

      <v-spacer></v-spacer>

    </v-toolbar>


    <v-content>
      <v-container fluid fill-height class="grey lighten-4">
        <v-layout justify-center align-center>
            
         <shop-map></shop-map>

        </v-layout>
      </v-container>
    </v-content>

  </v-app>
</template>

<script>
export default {

  props: {
    source: String
  },

  mounted() {
   
  }
};
</script>

<style scoped>
#keep main .container {
  height: 660px;
}

.navigation-drawer__border {
  display: none;
}

.text {
  font-weight: 400;
}
.autocomplete {
  width: 200px;
}
</style>
