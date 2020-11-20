<template>
  <div class="list">
    <Chargement v-if="loader" />
    <div class="data">
      <router-link class="spacing" v-bind:key="1" :to="{ name: 'FormEquipe' }" >      
         <button class="ui inverted green button"><i class="plus icon" style="font-size:18px;"></i>Ajouter une nouvelle équipe</button>
      </router-link>
      <table class="ui celled table">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">#</th>
            <th>Nom de l'euipe</th>
            <th>Match à venir</th>
            <th>Record</th>
            <th style="width: 148px;">Actions</th>
          </tr>
        </thead>

        <tbody>
          <Equipe
            v-for="equipe in equipes"
            :key="equipe.id"
            :equipe="equipe"
            @onDelete="onDelete"
          />
        </tbody>
      </table>
    </div>
  </div>

</template>

<script>
import Equipe from './Equipe.vue'
import {getTeamsWithUpcomingMatch,deleteTeam,createTeam,editTeam} from '../../DAO/EquipeAPI'
import Chargement from '@/components/Chargement'

export default {
  name: 'App',
  components: {
    Equipe,
    Chargement  
    },
  data() {
    return {
      equipes: [],
      loader: false

    };
  },
  props: {
    equipe: {
      type: Object
    }
  },
  methods: {
   async getList() {
      this.loader = true;
      this.equipes = await getTeamsWithUpcomingMatch();
      this.loader = false;

    },      
   async Delete(id) {
      this.loader = true;
      this.equipes = await deleteTeam(id);
      this.loader = false;
    },
   async Create(data) {
      this.loader = true;
      this.equipes = await createTeam(data);
      this.loader = false;
    },
    async Edit(data) {
       this.loader = true;
      this.equipes = await editTeam(data);
      this.loader = false;
    },
    onDelete(id) {
      var result = confirm("Want to delete?");
      if (result) {
        this.Delete(id);
      }
    },
  },
  created() {
    this.getList();
  },
  mounted(){
    if(this.equipe){
       if (this.equipe.isEdit) {
          this.Edit(this.equipe);
        }else{
          this.Create(this.equipe);
         }
    }
  }
}

</script>

<style lang="scss">
  @import '@/assets/sass/app.scss';
</style>


