<template>
  <div class="form">
    <form class="ui_form" >
          <label for="location">Location</label>
          <input
            type="text"
            name="location"
            id="location"
            placeholder="Location"
            @change="handleChange"
            :value="form.location"
          />

          <label for="score">Scores</label>
          <input
            type="text"
            name="score"
            id="score"
            placeholder="Scores"
            @change="handleChange"
            :value="form.score"
          />

          <label for="match_date">Date du match</label>
          <input
            type="datetime-local"
            name="match_date"
            id="match_date"
            placeholder="Date du match"
            @change="handleChange"
            :value="form.match_date"
          />

          <label for="first_team">Première équipe</label>
          <select id="first_team" class="form-control" v-model="selected_first_team" @change="changeFirstTeam">
              <option>Choisissez l'équipe</option>
              <option v-for="equipe in equipes" v-bind:key="equipe.id"  v-bind:value="equipe.id" >{{ equipe.team_name }}</option>
          </select>

          <label for="second_team">Deuxième équipe</label>
          <select id="second_team" class="form-control" v-model="selected_second_team" @change="changeSecondTeam">
              <option>Choisissez l'équipe</option>
              <option v-for="equipe in equipes" v-bind:key="equipe.id" v-bind:value="equipe.id" >{{ equipe.team_name }}</option>
          </select>


        <input type="submit" @click="onFormSubmit" :value= btnName >
    </form>
  </div>
</template>

<script>
import {getTeams} from '../../DAO/EquipeAPI'
export default {
  name: "FormEquipe",
  data() {
    return {
      form:{},
      selected_first_team: "Choisissez l'équipe",
      selected_second_team: "Choisissez l'équipe",
      first_team_id:{},
      second_team_id:{},
      equipes:[],
      btnName: "Sauvegarder",
      btnClass: "ui primary button submit-button"
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
      this.equipes = await getTeams();
      this.loader = false;
    },   
    changeSecondTeam(event) {
      const { value } = event.target;
      this.second_team_id = value;
    },
    changeFirstTeam(event) {
      const { value } = event.target;
      this.first_team_id = value;
    },
    handleChange(event) {
      const { name, value } = event.target;
      let form = this.form;
      form[name] = value;
      this.form = form;
    },
    onFormSubmit(event) {
      // prevent form submit
      event.preventDefault();

      // form validation
      if (this.formValidation()) {
        //
        window.console.log("form ", this.form);

        // change the button to save
        this.btnName = "Sauvegarder";
        this.btnClass = "ui primary button submit-button";

        //send data
        this.$root.$router.push({ name: 'MatchListe', params: { match: {...this.form,first_team_id:this.first_team_id,second_team_id:this.second_team_id} } })

        // clear form fields
        this.clearFormFields();

      }
    },

    formValidation() {
      
      if (document.getElementsByName("location")[0].value === "") {
        alert("Veuillez saisir L'emplacement");
        return false;
      }

      if (document.getElementsByName("match_date")[0].value === "") {
        alert("Veuillez saisir La date du match");
        return false;
      }

      if (this.first_team_id === null) {
        alert("Veuillez sélectionner la première équipe");
        return false;
      }

      if (this.second_team_id === null) {
        alert("Veuillez sélectionner la deuxième équipe");
        return false;
      }

      if (this.second_team_id === this.first_team_id) {
        alert("S'il vous plaît, ne choisissez pas la même équipe !");
        return false;
      }

      return true;
    },
    clearFormFields() {
      // clear form data
      this.form = {}
    }
  },
  created() {
    this.getList();
  },
  mounted(){
    if(this.match){
       window.console.log("match ", this.match.match_date);
       this.form = this.match;
      // this.form.match_date = this.form.match_date;
       this.selected_first_team = this.first_team_id = this.match.first_team.id;
       this.selected_second_team = this.second_team_id = this.match.second_team.id;
       this.btnName = "Mise à jour";
       this.btnClass = "ui orange button submit-button";
    }
  }
};
</script>

<style scoped></style>
