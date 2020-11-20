<template>
  <tr>
    <td>{{ match.id }}</td>
    <td>{{ match.location }}</td>
    <td>{{ match.score }}</td>
    <td>{{ match.match_date }}</td>
    <td>{{ match.first_team &&  match.first_team.team_name + " / "+match.first_team.record}}</td>
    <td>{{ match.second_team &&  match.second_team.team_name + " / "+match.second_team.record}}</td>

    <td>

      <router-link class="spacing" v-bind:key="1" :to="{ name: 'FormMatch', params: {match:{...match,isEdit:true} } }" >      
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
    match: {
      type: Object
    }
  },
  methods: {
    onDelete() {
      this.$emit("onDelete", this.match.id);
    },
    onEdit() {
      this.$emit("onEdit", this.match);
    }
  }
};
</script>

<style scoped></style>
