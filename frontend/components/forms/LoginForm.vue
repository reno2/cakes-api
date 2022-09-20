<template>
  <div class="login-page">

    <FormBase form-type="login" :Validator="Validator" :fields="fields" @submit="submitForm">
      <template v-slot:form-header>
        <div class="block-title">
          <div class="block-title__name">Авторизация</div>
          <div class="block-title__desc">Ещё нет аккаунта?
            <nuxt-link class="block-title__link" to="/">Регистрация</nuxt-link>
          </div>
        </div>
      </template>
    </FormBase>

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

<style>
.login-page{
  max-width: 450px;
  margin: auto;
}


/* region Block Title */
.block-title{
  margin-bottom: 32px;
}
.block-title__name{
  font-size: 36px;
  font-weight: 700;
  color: #344055;
  margin-bottom: 8px;
}
.block-title__desc{
  color: #b1b2b9;
  font-size: 14px;
}
/* endregion Block Title */
</style>
