<template>
  <div class="table-responsive">
    <b-table
      :items="users"
      :fields="fields"
      head-variant="dark"
      hover
      bordered
      table-class="shadow text-center text-sm"
      responsive
    >
      <!--Empty data-->
      <template #empty>
        <p>Ops, nenhum dado encontrado</p>
      </template>

      <!-- Custom Actions -->
      <template #cell(actions)="data">
        <b-button
          variant="warning"
          size="sm"
          :to="`/users/${data.item.id}/edit`"
        >
          Editar
        </b-button>
        <b-button
          variant="danger"
          size="sm"
          @click.prevent="deleteUser(data.item.id)"
        >
          Deletar
        </b-button>
      </template>
    </b-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fields: [
        { key: "id", label: "#", tdClass: "align-middle" },
        { key: "name", label: "Nome", tdClass: "align-middle" },
        { key: "email", label: "E-mail", tdClass: "align-middle" },
        { key: "phone", label: "Telefone", tdClass: "align-middle" },
        { key: "actions", label: "Ações", tdClass: "align-middle" },
      ],
    };
  },

  computed: {
    users() {
      return this.$store.getters.users;
    },
  },

  mounted() {
    this.fetchUsers();
  },

  methods: {
    async fetchUsers() {
      try {
        await this.$store.dispatch("fetchAllUsers");
      } catch (e) {
        //
      }
    },

    deleteUser(id) {
      this.$store.dispatch("deleteUser", id);
    },
  },
};
</script>
