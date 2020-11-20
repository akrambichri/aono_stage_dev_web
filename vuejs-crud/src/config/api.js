import axios from "axios";
export const API_URL = "http://localhost:8000/api";
//export const API_URL = "http://names.drycodes.com/";

export default axios.create({
  baseURL: API_URL,
  headers: {
    "Content-Type": "application/json",
  },
});
