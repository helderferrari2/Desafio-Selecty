<template>
  <div>
    <div class="form-group">
      <label for="experience">Experiência profissional</label>
      <input v-model="form.experience" type="text" class="form-control" />
    </div>

    <div class="form-group my-3">
      <label for="skill">Formação acadêmica </label>
      <input v-model="form.skill" type="text" class="form-control" />
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
