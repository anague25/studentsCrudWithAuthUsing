import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000/api'; // Remplacez par l'URL de votre API Laravel
axios.defaults.withCredentials = true; // Pour permettre le partage de cookies entre les domaines

export default axios;