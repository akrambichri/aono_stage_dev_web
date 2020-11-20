<template>
  <div id="app" >
    <NavBar       
      :width="300"
      format="push"
      direction="left"
      :opacity="0.15"
      :links="[
        {'id': 3, 'text': 'Accueil', 'page': '/'},
        {'id': 1, 'text': 'Liste des équipes', 'page': '/EquipeListe'},
        {'id': 2, 'text': 'Liste des matchs', 'page': '/MatchListe'}
      ]"></NavBar>     
      <router-view/>
 </div>
      
</template>

<script>
import NavBar from '@/components/NavBar'

export default {
  name: 'App',
  components: {
    NavBar
    }
}

</script>

<style lang="scss">
  @import '@/assets/sass/app.scss';
</style>
