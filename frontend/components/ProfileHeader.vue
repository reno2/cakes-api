<template>
  <div class="profile-header">
    <template v-if="$auth.loggedIn">
      <ProfileAuth />
    </template>
    <template v-else>
      <nuxt-link to="/login">войти</nuxt-link>
    </template>
  </div>
</template>
<script>

import ProfileAuth from '@/components/menus/ProfileAuth'
export default {
  name: 'ProfileHeader',
  props: {
    menuItems: []
  },
  components: {ProfileAuth}
}
</script>
