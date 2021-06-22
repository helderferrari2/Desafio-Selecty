import api from "@/utils/http";

export default {
  state: {
    users: [],
  },

  mutations: {
    SET_USERS(state, payload) {
      state.users = payload;
    },

    DELETE_USER(state, payload) {
      state.users = state.users.filter((i) => i.id !== payload);
    },
  },

  getters: {
    users: (state) => state.users,
  },

  actions: {
    fetchAllUsers(context) {
      return new Promise((resolve, reject) => {
        return api
          .get("users")
          .then((response) => {
            const { data } = response;
            context.commit("SET_USERS", data);
            resolve(data);
          })
          .catch((error) => reject(error));
      });
    },

    fetchUserById(context, id) {
      return new Promise((resolve, reject) => {
        return api
          .get(`/users/${id}`)
          .then((response) => {
            const { data } = response;
            resolve(data);
          })
          .catch((error) => reject(error));
      });
    },

    store(context, payload) {
      return new Promise((resolve, reject) => {
        return api
          .post("users", payload)
          .then((response) => {
            const { data } = response;
            resolve(data);
          })
          .catch((error) => reject(error));
      });
    },

    update(context, payload) {
      return new Promise((resolve, reject) => {
        return api
          .put(`/users/${payload.id}`, payload)
          .then((response) => {
            const { data } = response;
            resolve(data);
          })
          .catch((error) => reject(error));
      });
    },

    deleteUser(context, payload) {
      return new Promise((resolve, reject) => {
        return api
          .delete(`/users/${payload}`)
          .then((response) => {
            const { data } = response;
            context.commit("DELETE_USER", payload);
            resolve(data);
          })
          .catch((error) => reject(error));
      });
    },
  },
};
