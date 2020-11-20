<template>
  <tr>
    <td>{{ equipe.id }}</td>
    <td>{{ equipe.team_name }}</td>
    <td>{{ equipe.UpComingMatch &&  equipe.UpComingMatch.location + " / "+equipe.UpComingMatch.match_date}}</td>
    <td>{{ equipe.record }}</td>
    <td>
        <div class="action-cell">
            <router-link class="spacing" v-bind:key="1" :to="{ name: 'FormEquipe', params: {equipe:{...equipe,isEdit:true} } }" >      
                <button class="ui inverted blue button" @click="onEdit"><i class="edit icon"></i>Éditer</button>
            </router-link>
            <button class="ui inverted red button" @click="onDelete"><i class="trash alternate icon"></i>Supprimer</button>
        </div>
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
