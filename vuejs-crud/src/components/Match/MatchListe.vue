<template>
  <div class="list">
    <Chargement v-if="loader" />
    <div class="data">
      <router-link class="spacing" v-bind:key="1" :to="{ name: 'FormMatch' }" >      
         <button class="ui inverted green button"><i class="plus icon" style="font-size:18px;"></i>Ajouter un nouveau match</button>
      </router-link>
      <table class="ui celled table">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">#</th>
            <th>L'emplacement</th>
            <th>Scores</th>
            <th>Date du match</th>
            <th>Première équipe</th>
            <th>Deuxième équipe</th>
            <th style="width: 148px;">Actions</th>
          </tr>
        </thead>

        <tbody>
          <Match
            v-for="match in matchs"
            :key="match.id"
            :match="match"
            @onDelete="onDelete"
          />
        </tbody>
      </table>
    </div>
  </div>

</template>

<script>
import Match from './Match.vue'
import {getMatches,deleteMatche,createMatche,editMatche} from '../../DAO/MatchAPI'
import Chargement from '@/components/Chargement'

export default {
  name: 'App',
  components: {
    Match,
    Chargement  
    },
  data() {
    return {
      matchs: [],
      loader: false

    };
  },
  props: {
    match: {
      type: Object
    }
  },
  methods: {
   async getList() {
      this.loader = true;
      this.matchs = await getMatches();
      this.loader = false;

    },      
   async Delete(id) {
      this.loader = true;
      this.matchs = await deleteMatche(id);
      this.loader = false;
    },
   async Create(data) {
      this.loader = true;
      this.matchs = await createMatche(data);
      this.loader = false;
    },
    async Edit(data) {
       this.loader = true;
      this.matchs = await editMatche(data);
      this.loader = false;
    },
    onDelete(id) {
      var result = confirm("Êtes-vous sûr de vouloir supprimer cet enregistrement ?");
      if (result) {
        this.Delete(id);
      }
    },
  },
  created() {
    this.getList();
  },
  mounted(){
    if(this.match){
       window.console.log("match ", this.match);
       if (this.match.isEdit) {
          this.Edit(this.match);
        }else{
          this.Create(this.match);
         }
    }
  }
}

</script>

<style lang="scss">
  @import '@/assets/sass/app.scss';
</style>


