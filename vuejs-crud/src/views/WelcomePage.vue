<template>
  <div id="welcome" >
    <div id="welcomeText">
       <h1 >Bienvenue</h1>
       <p >L'objectif de ce projet est de créer une application CRUD pour deux classes, matchs et équipes.
        Un match a au moins 2 équipes et une équipe appartient à aucun ou plusieurs matchs.
        <p >Front-End est développé avec VueJs.</p>
        <p >Back-End est développé avec PHP Laravel.</p>
    </div>
  </div>

</template>

<script>

export default {
  name: 'App',
  components: {
    //
  }
}

</script>

<style lang="scss">
  @import '@/assets/sass/app.scss';
</style>
