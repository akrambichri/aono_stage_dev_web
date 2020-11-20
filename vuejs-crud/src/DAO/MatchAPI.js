import axios from '../config/api';

export function getMatches  ()  {
   return axios.get('/matches').then(data => 
       data.data
    );
    }
    
export function deleteMatche  (id)  {
    return axios
        .delete(`/matches/${id}`)
        .then(() => getMatches())
        .catch(e => {
            alert(e);
         });
    }

export function createMatche (data)  {
  return axios
        .post("/matches", data)
        .then(() => getMatches())
        .catch(e => {
            alert(e);
         });
    }

export function  editMatche  (data) {
  return axios
        .put(`/matches/${data.id}`, data)
        .then(() => getMatches())
        .catch(e => {
            alert(e);
         });
    }