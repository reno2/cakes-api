<template>

  <MainMenu :menuItems="header"/>

</template>
<script>
import { mapGetters, mapMutations } from 'vuex';
import MainMenu from '@/components/MainMenu';

export default {
  name: 'Header',
  data() {
    return {
      menu: null
    }
  },
  components: {
    MainMenu,
  },
  computed: {
    ...mapGetters({
      header: 'menus/getMenus'
    })
  },
  async asyncData( {$apitest} ){

  },
  async middleware({ store, $apitest }) {
    await store.dispatch('menus/fetchMenu', $apitest)
  }
}
</script>
