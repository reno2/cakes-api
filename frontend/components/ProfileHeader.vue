<template>
  <div class="profile-header">
    <template v-if="$auth.loggedIn">
      <a @click.prevent="logout" href="#">выйти</a>
    </template>
    <template v-else>
      <nuxt-link to="/login">войти</nuxt-link>
    </template>
  </div>
</template>
<script>


export default {
  name: 'ProfileHeader',
  props: {
    menuItems: []
  }
}
</script>
