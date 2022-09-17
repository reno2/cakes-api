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
          rules: [
            {
              rule: 'ruleRequire'
            }
          ],
        },
        {
          type: 'text',
          name: 'email',
          label: 'Ваш email',
          rules: [
          ]
        }
      ]
    }
  },
  methods: {
    submitForm(event) {
      //console.log(event)
    }
  },
  computed: {
    validation() {
      let isValidate = true;

      // for (let i = 0; i < this.validators.length; i++) {
      //   console.log(1, this.validators[i](this.login))
      //   if (!this.validators[i](this.login)) {
      //     break;
      //   }
      // }

      return isValidate
    }
  }
}
</script>

<style scoped>

</style>
