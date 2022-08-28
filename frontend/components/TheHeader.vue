<template>
  <div class="top-menu">
    <nav class="top-menu__nav">
      <ul>
        <li v-if="$auth.loggedIn"><a @click.prevent="logout" href="#">выйти</a></li>
        <li v-else><nuxt-link to="login">войти</nuxt-link></li>
      </ul>
    </nav>
  </div>

</template>
<script>
export default {
  name: 'NuxtTutorial',
  methods: {

      async logout() {
        await this.$auth.logout()

        await this.$router.push('/')
      },

  }
}
</script>
