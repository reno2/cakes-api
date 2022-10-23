<template>


    <FormBase class="login-form inline-form" form-type="login" :Validator="Validator" :fields="fields" @submit="submitForm">
      <template v-slot:form-header>
        <div class="block-title">
          <div class="block-title__name">Авторизация</div>
          <div class="block-title__desc">Ещё нет аккаунта?
            <nuxt-link class="block-title__link" to="/register">Регистрация</nuxt-link>
          </div>
        </div>
      </template>
    </FormBase>


</template>

<script>
import InputBase from "./InputBase";
import FormBase from "./FormBase";

import Validator from '../../custom-validators/LoginValidator'
export default {
  auth: 'guest',
  components: {FormBase, InputBase},
  data() {
    return {
      Validator: Validator,
      login: null,
      email: null,
      fields: [
        {
          type: 'text',
          name: 'email',
          label: 'Ваш email',
        },
        {
          type: 'text',
          name: 'password',
          label: 'Ваш пароль',
        },
      ]
    }
  },
  methods: {
    async submitForm(data) {
      const {email, password} = data

      try{
        const log = await this.$auth.loginWith('local', {
          data: {
            email: data.email,
            password: data.password
          }
        })
        console.log(log)
      }catch (e) {
        console.log(e.message)
      }

    }
  },
  computed: {}
}
</script>

<style>

.login-form{
  max-width: 450px;
  margin: 80px auto 0;
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
