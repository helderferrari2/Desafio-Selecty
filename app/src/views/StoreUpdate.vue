<template>
  <div>
    <h1>Cadastrar</h1>

    <b-card class="shadow">
      <div class="stepper">
        <!--Stepper Header-->
        <div class="stepper-header">
          <div
            v-for="item in stepper.items"
            :key="item.id"
            :class="{
              'step-item': true,
              'step-item-active': stepper.current == item.id,
            }"
          >
            <div>{{ item.title }}</div>
          </div>
        </div>

        <b-form class="mt-3" @submit.prevent="handleSubmit">
          <!--Stepper Content-->
          <div class="stepper-content">
            <div v-if="stepper.current === 1">
              <UserForm :form="form" />
            </div>

            <div v-if="stepper.current === 2">
              <SkillForm :form="form" />
            </div>

            <div v-if="stepper.current === 3">
              <AccessForm :form="form" />
            </div>
          </div>

          <!--Stepper Footer-->
          <div class="stepper-footer">
            <b-button
              :disabled="stepper.current <= 1"
              variant="secondary"
              pill
              @click.prevent="prev"
            >
              Anterior
            </b-button>

            <b-button
              v-if="stepper.current < stepper.total"
              variant="outline-primary"
              pill
              @click.prevent="next"
            >
              Próximo
            </b-button>

            <b-button
              v-else
              variant="outline-primary"
              pill
              @click.prevent="handleSubmit"
            >
              <b-spinner v-if="loading" small />
              Enviar
            </b-button>
          </div>
        </b-form>
      </div>
    </b-card>
  </div>
</template>

<script>
import UserForm from "@/components/forms/UserForm";
import SkillForm from "@/components/forms/SkillForm";
import AccessForm from "@/components/forms/AccessForm";

export default {
  components: { UserForm, SkillForm, AccessForm },
  data() {
    return {
      stepper: {
        current: 1,
        total: 3,
        items: [
          { id: 1, title: "Dados Pessoais", ref: "user" },
          { id: 2, title: "Dados Profissionais", ref: "skill" },
          { id: 3, title: "Dados Acesso", ref: "access" },
        ],
      },
      loading: false,
      isStore: true,
      form: {
        id: "",
        name: "",
        email: "",
        phone: "",
        experience: "",
        skill: "",
        username: "",
        password: "",
        password_confirmation: "",
      },
    };
  },

  mounted() {
    this.fetchUserById();
  },

  methods: {
    next() {
      this.stepper.current++;
    },

    prev() {
      this.stepper.current--;
    },

    handleSubmit() {
      const action = this.isStore ? "store" : "update";
      this.$store
        .dispatch(action, this.form)
        .then(() => this.$router.push("/"));
    },

    async fetchUserById() {
      try {
        const response = await this.$store.dispatch(
          "fetchUserById",
          this.$route.params.id
        );
        this.isStore = false;
        const { skill, access, ...rest } = response;

        const prepare = {
          id: rest.id,
          name: rest.name,
          email: rest.email,
          phone: rest.phone,
          experience: skill !== null ? skill.experience : "",
          skill: skill !== null ? skill.skill : "",
          username: access !== null ? access.username : "",
        };

        this.form = { ...this.form, ...prepare };
      } catch (e) {
        //
      }
    },
  },
};
</script>
