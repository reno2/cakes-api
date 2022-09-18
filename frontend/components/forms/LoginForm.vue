<template>
  <div>

    <FormBase :Validator="Validator" :fields="fields" @submit="submitForm">
      In slots

    </FormBase>
<!--    <InputBase type="text" label="Ваш логин" v-model="login"/>-->
<!--    <InputBase label="Ваш email" v-model="email"/>-->



  </div>
</template>

<script>
import InputBase from "./InputBase";
import FormBase from "./FormBase";

import Validator from '../../custom-validators/LoginValidator'
export default {
  components: {FormBase, InputBase},
  data() {
    return {
      Validator: Validator,
      login: null,
      email: null,
      fields: [
        {
          type: 'text',
          name: 'name',
          label: 'Ваше имя',
        },
        {
          type: 'text',
          name: 'email',
          label: 'Ваш email',
        }
      ]
    }
  },
  methods: {
    submitForm(event) {
      console.log(event)
    }
  },
  computed: {}
}
</script>

<style scoped>

</style>
