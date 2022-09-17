<template>
  <div class="top-menu">
    <nav class="top-menu__nav">
      <ul>
        <li v-if="$auth.loggedIn"><a @click.prevent="logout" href="#">выйти</a></li>
        <li v-else><nuxt-link to="/login">войти</nuxt-link></li>
      </ul>
    </nav>
  </div>

</template>
<script>
export default {
  name: 'Header',
  data() {
    return {
      menu: null
    }
  },
  components: {
    //MainMenu,
  },
  async asyncData( {$apitest}){
    const {menu} = await context.$api.get('/menu');
    console.log(menu)
  },
  async middleware({ store }) {
    console.log('rwerewr')
    await store.dispatch('menus/fetchMenu')
  }
}
</script>
