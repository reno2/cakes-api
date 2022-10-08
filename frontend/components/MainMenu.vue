<template>
  <ul class="menu">
    <template v-for="(link, inx) in menuItems">
      <template v-if="link.children">
        <li class="menu__li js_menu__item menu__parent" @mouseenter="menuShow">
          <div class="menu__link">
            {{ link.title }}
            <svg-icon class="profile-auth__person" name="icon-more"/>
          </div>
          <div class="menu__sub js_menu__sub js_profile__menu ">
            <MainMenu :menuItems="link.children"/>
          </div>
        </li>
      </template>
      <template v-else>
        <li class="menu__li">
          <nuxt-link class="menu__link" :to="path(link.slug)">{{ link.title }}</nuxt-link>
        </li>
      </template>
    </template>
  </ul>
</template>
<script>

import {makePath} from '@/helpers/functions';

export default {
  name: 'MainMenu',
  data() {
    return {
      subMenu: [],

    }
  },
  props: {
    menuItems: []
  },
  methods: {
    path(slug) {
      return makePath('category', slug)
    },
    menuShow({target}) {

      const menu = target.closest('.js_menu__item').querySelector('.js_profile__menu')

      if (!menu) return
      menu.classList.add('show')
      target.addEventListener('mouseleave', this.menuHide)
    },
    menuHide({target}) {
      const menu = target.querySelector('.js_profile__menu')
      menu.classList.remove('show')
    }
  }
}
</script>
<style>
.top-menu__ul {
  display: flex;
}

.menu {
  display: flex;
  align-content: center;
}

.menu__li {
  display: flex;
  align-items: inherit;
  position: relative;
}

.menu__link {
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

.menu_svg {
  width: 24px;
  height: 24px;
  fill: #afafaf;
}

.main-menu li:not(:last-child) {
  margin-right: 16px;
}

.menu__sub {
  visibility: hidden;
  opacity: 0;
  position: absolute;
  bottom: -100%
}

.menu__parent .menu__sub.show {
  visibility: visible;
  opacity: 1;
  top: 100%;
  height: fit-content;
  min-width: max-content;
  width: 100%;
  z-index: 9;
  background: #fff;
  box-shadow: 0 0 20px rgb(0 0 0 / 10%);
  border-radius: 0 0 10px 10px;
  padding: 24px;
}

.menu__sub .menu {
  flex-direction: column;
  align-items: self-start;
}

.menu__sub .menu .menu__li {
  margin-left: 0;
  width: 100%;
}

.menu__sub .menu .menu__link {
  padding: 12px 0px;
  width: 100%;
}

.main-menu .menu__link {
  display: inherit;
  align-items: center;
  height: 100%;
  font-size: 14px;
  line-height: 16px;
  font-weight: 600;
  padding: 12px 0;
  cursor: pointer;
  letter-spacing: .8px;
  position: relative;
}

.menu__sub .menu__li:first-child .menu__link {
  padding-top: 0;
}

.main-menu .menu__parent .menu__sub.show {
  right: 0;
}
</style>
