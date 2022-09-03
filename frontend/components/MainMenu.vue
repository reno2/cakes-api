<template>
  <div class="top-menu">
    <nav class="top-menu__nav">
      <ul>
        <li v-for="link in menuItems">{{link.title}}</li>
      </ul>
      <ul>
        <li v-if="$auth.loggedIn"><a @click.prevent="logout" href="#">выйти</a></li>
        <li v-else><nuxt-link to="login">войти</nuxt-link></li>
      </ul>
    </nav>
  </div>

</template>
<script>


export default {
  name: 'MainMenu',
  props: {
      menuItems: []
  }
}
</script>
