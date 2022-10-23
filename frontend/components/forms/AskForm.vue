<template>
  <FormBase class="ask-form" form-type="login" :Validator="Validator" :fields="fields" @submit="submitForm">
    <template v-slot:form-header>
      <div class="block-title">
        <div class="block-title__name">Задать вопрос</div>
      </div>
    </template>
  </FormBase>
</template>

<script>
import FormBase from "./FormBase";
import Validator from '../../custom-validators/AskValidator'
export default {
  components: {FormBase},
  data() {
    return {
      Validator: Validator,
      login: null,
      email: null,
      fields: [
        {
          type: 'textarea',
          name: 'ask',
          label: 'Ваш вопрос',
        },
      ]
    }
  },
  methods: {
    async submitForm(data) {
      console.log(data)
    }
  }
}
</script>

<style scoped>

</style>
