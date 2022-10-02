<template>
  <div class="container">
      <RegisterForm />
  </div>

</template>
<script>
import RegisterForm from "../components/forms/RegisterForm";

export default {
  middleware: 'auth',
  auth : 'guest',
  layout: 'LayoutDefault',
  components: {RegisterForm},
  methods:{
    async login(){
      //const post = await this.$axios.$get('/csrf-cookie');
      try {
        const log = await this.$auth.loginWith('local', {
          data: {
            email: 'test@test.test',
            password: 'test'
          }
        })
      }catch (e) {
        console.log(e.message)
      }

    }
  }
}
</script>
