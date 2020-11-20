<template>
  <div class="form">
    <form class="ui_form" >
          <label for="team_name">Nom de l'euipe</label>
          <input
            type="text"
            name="team_name"
            id="team_name"
            placeholder="Nom de l'euipe"
            @change="handleChange"
            :value="form.team_name"
          />

          <label for="record">Record</label>
          <input
            type="text"
            name="record"
            id="record"
            placeholder="Record"
            @change="handleChange"
            :value="form.record"
          />
        <input type="submit" @click="onFormSubmit" :value= btnName >
    </form>
  </div>
</template>

<script>
export default {
  name: "FormEquipe",
  data() {
    return {
      form:{},
      btnName: "Sauvegarder",
      btnClass: "ui primary button submit-button"
    };
  },
  props: {
    equipe: {
      type: Object
    }
  },
    methods: {
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
        this.$root.$router.push({ name: 'EquipeListe', params: { equipe: this.form } })

        // clear form fields
        this.clearFormFields();

      }
    },

    formValidation() {
      if (document.getElementsByName("team_name")[0].value === "") {
        alert("Veuillez saisir le nom de l'équipe");
        return false;
      }

      if (document.getElementsByName("record")[0].value === "") {
        alert("Veuillez saisir le record de l'équipe");
        return false;
      }

      return true;
    },
    clearFormFields() {
      // clear form data
      this.form = {}
    }
  },
  mounted(){
    if(this.equipe){
       this.form = this.equipe;
       this.btnName = "Mise à jour";
       this.btnClass = "ui orange button submit-button";
    }
  }
};
</script>

<style scoped></style>
