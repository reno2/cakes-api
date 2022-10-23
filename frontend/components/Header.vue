<template>
  <div class="header-desktop">
    <div class="container">
      <div class="header-desktop__inner">
        <div class="header-desktop__logo">
          <nuxt-link to="/">
            <img class="header-desktop__svg" src="/full-logo.svg" alt="">
          </nuxt-link>
        </div>
        <div class="header-desktop__menu">
          <div class="main-menu">
            <MainMenu :menuItems="header"/>
          </div>
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
import MainMenu from '@/components/menus/MainMenu';
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
  }
}
</script>
<style>


.header-desktop__inner {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 24px 0;
}

.header-desktop__menu {
  flex-grow: 1;
  margin: 0 24px;
  display: flex;
  justify-content: center;
  position: relative;
  align-items: center;
}
</style>
