<template>
  <div>
    <div class="form-group">
      <label for="username">Usuário</label>
      <input v-model="form.username" type="text" class="form-control" />
    </div>

    <div class="form-group my-3">
      <label for="password">Senha</label>
      <input v-model="form.password" type="password" class="form-control" />
    </div>

    <div class="form-group">
      <label for="password_confirmation">Confirmar Senha</label>
      <input
        v-model="form.password_confirmation"
        type="password"
        class="form-control"
      />
    </div>
  </div>
</template>

<script>
export default {
  props: {
    form: {
      type: Object,
    },
  },
};
</script>
