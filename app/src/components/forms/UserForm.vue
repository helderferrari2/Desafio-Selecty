<template>
  <div>
    <div class="form-group">
      <label for="name">Nome</label>
      <input v-model="form.name" type="text" class="form-control" />
    </div>

    <div class="form-group my-3">
      <label for="email">Email</label>
      <input v-model="form.email" type="email" class="form-control" />
    </div>

    <div class="form-group">
      <label for="name">Telefone</label>
      <input v-model="form.phone" type="text" class="form-control" />
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
