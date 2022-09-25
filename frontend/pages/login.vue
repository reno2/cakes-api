<template>
  <div class="container">
      <LoginForm />
  </div>


</template>
<script>
import LoginForm from "../components/forms/LoginForm";

export default {
  layout: 'LayoutDefault',
  components: {LoginForm},
  methods:{
     async login(){
       //const post = await this.$axios.$get('/csrf-cookie');
       try {
         //const post = await this.$axios.$get('/sanctum/csrf-cookie');
         //console.log(post)
         // const y = await this.$axios.$post("/login", {
         //       email: 'test@test.test',
         //       password: 'test'
         // });
         // console.log(y)
         //let response = await this.$axios.$get("/user");
         //console.log(response.data);

         // const log = await this.$auth.loginWith('local', {
         //   data: {
         //     email: 'test@test.test',
         //     password: 'test'
         //   }
         // })
       //console.log(log)
       //   await this.$router.push('/')
         // console.log(log)
       }catch (e) {
         console.log(e.message)
       }
      // console.log(this.$auth)
      // this.$auth.loginWith('laravelSanctum', {
      //   data: {
      //     email: 'email@email.ru',
      //     password: '123'
      //   }
      // }).then(data => {
      //   console.log(data);
      // })
      //   const post = await this.$axios.$get('http://localhost:8003/sanctum/csrf-cookie');
      //  const log = await this.$axios.$post('http://localhost:8003/login/', {
      //
      //        email: 'test@test.ru',
      //        password: '123456'
      //
      //  })
      //  console.log(log)
      //  const user = await this.$axios.$get('http://localhost:8003/user/')
      //  console.log(user)


    }
  }
}
</script>
