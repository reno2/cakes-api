<template>
  <a @click.prevent="role" href="#">Добавть роль</a>
</template>
<script>
export default {
  methods:{
    async role(){
      const newRole = await this.$axios.$post('/users_roles', {
        id: 3,
       role_id: 3
      });

      //await this.$router.push('/')
      console.log(newRole)
    }
  }
}
</script>
