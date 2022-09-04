<template>
    <nav class="top-menu">
      <ul class="top-menu__ul">
        <li class="top-menu__li" v-for="link in menuItems">
          <nuxt-link class="top-menu__link" :to="path(link.slug)">{{link.title}}</nuxt-link>
        </li>
      </ul>
    </nav>
</template>
<script>

import makePath from '@/helpers/functions';

export default {
  name: 'MainMenu',
  props: {
      menuItems: []
  },
  methods:{
    path(slug){
      return makePath('category', slug)
    }
  },
  mounted(){

  }
}
</script>
<style>
.top-menu__ul{
  display: flex;
}
.top-menu__li{
  display: flex;
  align-items: inherit;
  position: relative;
}
.top-menu__link{
  display: inherit;
  align-items: center;
  height: 100%;
  font-size: 14px;
  line-height: 16px;
  font-weight: 600;
  padding: 12px 0;
  letter-spacing: 0.8px;
  position: relative
}
</style>
