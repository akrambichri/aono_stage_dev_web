<template>
  <tr>
    <td>{{ equipe.id }}</td>
    <td>{{ equipe.team_name }}</td>
    <td>{{ equipe.UpComingMatch &&  equipe.UpComingMatch.location + " / "+equipe.UpComingMatch.match_date}}</td>
    <td>{{ equipe.record }}</td>
    <td>

      <router-link class="spacing" v-bind:key="1" :to="{ name: 'FormEquipe', params: {equipe:{...equipe,isEdit:true} } }" >      
         <button class="mini ui blue button" @click="onEdit">Edit</button>
      </router-link>

      <button class="mini ui red button" @click="onDelete">Delete</button>
    </td>
  </tr>
</template>

<script>
export default {
  name: "Equipe",
  props: {
    equipe: {
      type: Object
    }
  },
  methods: {
    onDelete() {
      this.$emit("onDelete", this.equipe.id);
    },
    onEdit() {
      this.$emit("onEdit", this.equipe);
    }
  }
};
</script>

<style scoped></style>
