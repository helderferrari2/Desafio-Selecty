import axios from "axios";
const baseUrl = `http://localhost:8000/api`;

//Default Axios Config
const api = axios.create({
  baseURL: baseUrl,
  timeout: 60000,
  headers: {
    post: {
      Accept: "application/json",
    },
  },
});

// Request interceptor
api.interceptors.request.use(
  (request) => {
    // store.dispatch("startPreloader");
    return request;
  },
  (error) => {
    // store.dispatch("stopPreloader");
    Promise.reject(error);
  }
);

export default api;
