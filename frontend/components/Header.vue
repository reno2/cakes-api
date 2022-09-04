<template>
  <div class="header-desktop">
    <div class="container">
      <div class="header-desktop__inner">
        <div class="header-desktop__logo">
          <img class="header-desktop__svg" src="/full-logo.svg" alt="">
        </div>
        <div class="header-desktop__menu">
          <MainMenu :menuItems="header"/>
        </div>
        <div class="header-desktop__profile">
          <ProfileHeader/>
        </div>
      </div>
    </div>
  </div>


</template>
<script>
import {mapGetters, mapMutations} from 'vuex';
import MainMenu from '@/components/MainMenu';
import ProfileHeader from '@/components/ProfileHeader';

export default {
  name: 'Header',
  data() {
    return {
      menu: null
    }
  },
  components: {
    MainMenu, ProfileHeader
  },
  computed: {
    ...mapGetters({
      header: 'menus/getMenus'
    })
  },
  async asyncData({$apitest}) {

  },
  async middleware({store, $apitest}) {
    await store.dispatch('menus/fetchMenu', $apitest)
  }
}
</script>
<style>
.header-desktop {
  display: flex;
}
.header-desktop__inner {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
</style>
