import axios from 'axios';

const axiosInstance = axios.create({
    baseURL: process.env.REACT_APP_BACKEND_URL || 'http://localhost:8080',  // Ensure this URL matches backend
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});

export default axiosInstance;
