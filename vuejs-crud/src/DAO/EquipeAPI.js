import axios from '../config/api';

export function getTeamsWithUpcomingMatch  ()  {
   return axios.get('/equipes/matches').then(data => 
       data.data
    );
    }

export function getTeams  ()  {
   return axios.get('/equipes').then(data => 
       data.data
    );
    }

export function deleteTeam  (id)  {
    return axios
        .delete(`/equipes/${id}`)
        .then(() => getTeamsWithUpcomingMatch())
        .catch(e => {
            alert(e);
         });
    }

export function createTeam (data)  {
  return axios
        .post("/equipes", {
        team_name: data.team_name,
        record: data.record
        })
        .then(() => getTeamsWithUpcomingMatch())
        .catch(e => {
            alert(e);
         });
    }

export function  editTeam  (data) {
  return axios
        .put(`/equipes/${data.id}`, {
        team_name: data.team_name,
        record: data.record
        })
        .then(() => getTeamsWithUpcomingMatch())
        .catch(e => {
            alert(e);
         });
    }