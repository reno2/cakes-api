<template>

  <div class="form-container">
    <div class="form-container__figure">
      <svg-icon name="reg" />
    </div>
    <div class="form-container__form">
      <FormBase form-type="login" :Validator="Validator" :fields="fields" @submit="submitForm">
        <template v-slot:form-header>
          <div class="block-title">
            <div class="block-title__sub">Присоеденяйтесь к нам</div>
            <div class="block-title__name">Регистрация</div>
            <div class="block-title__desc">Уже есть аккаунт?
              <nuxt-link class="block-title__link" to="/login">Войти</nuxt-link>
            </div>
          </div>
        </template>
      </FormBase>
    </div>
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
          name: 'email',
          label: 'Ваш email',
        },
        {
          type: 'text',
          name: 'password',
          label: 'Ваш пароль',
        },
        {
          type: 'text',
          name: 'password_confirmation',
          label: 'Повторить пароль\n',
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
            email: 'chedia@mail.ru',
            password: '123456'
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
.login-page{
  max-width: 450px;
  margin: auto;
}
/* region form */
.form-container{
  width: 766px;
  display: flex;
  margin: 80px auto 0;
  background: #FFFFFF;
  box-shadow: 0 40px 60px 0 rgb(37 59 112 / 10%);
  border-radius: 9px;
}
.form-container__figure{
  flex-grow: 1;
  display: flex;
  width: 50%;
  background: #82c831;
  justify-content: center;
  border-bottom-left-radius: 10px;
  border-top-left-radius: 10px;
  position: relative;
}
.form-container__form{
  flex-shrink: 0;
  width: 50%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  background: #fff;
  border-bottom-right-radius: 10px;
  border-top-right-radius: 10px
}
/* endregion form */

/* region Block Title */
.block-title__sub{
  text-transform: uppercase;
  font-size: 10px;
  color: #b1b2b9;
  font-weight: 600;
  letter-spacing: 1px;
}
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
