<template>
  <div class="profile-auth">
    <!--    <a @click.prevent="logout" href="#">выйти</a>-->
    <div @mouseenter="menuShow" class="profile-auth__item">
      <svg-icon class="profile-auth__person" name="profile-person"/>
      <div class="profile-auth__menu profile-menu js_profile-auth__menu">
        <div class="profile-menu__inner">
          <ul class="profile-menu__ul">
            <li class="profile-menu__li">
              <span class="profile-menu__user">   {{ $auth.user.email }}</span>
            </li>
            <!--            <li class="profile-menu__li"><a href="https://2cake.ru/admin" class="profile-menu__link">Админ панель</a>-->
            <!--            </li>-->
            <li class="profile-menu__li">
              <nuxt-link class="profile-menu__link" to="/profile">Ваш кабинет</nuxt-link>
            </li>
            <li class="profile-menu__li">
              <nuxt-link class="profile-menu__link" to="/profile/articles/">Объявления</nuxt-link>
            </li>
          </ul>
          <ul class="profile-menu__ul">
            <li class="profile-menu__li">
              <nuxt-link to="/profile/edit" class="profile-menu__link">Изменить профиль</nuxt-link>
            </li>
            <li class="profile-menu__li">
              <a class="profile-menu__link" @click.prevent="logout" href="#">выйти</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="profile-auth__item">
      <svg-icon class="profile-auth__person" name="profile-favorite"/>
    </div>
    <div class="profile-auth__item">
      <svg-icon class="profile-auth__person" name="profile-msg"/>
    </div>

  </div>
</template>

<script>
export default {
  methods: {
    menuShow({target}) {

      const menu = target.closest('.profile-auth__item').querySelector('.js_profile-auth__menu')

      if (!menu) return
      menu.classList.add('show')
      target.addEventListener('mouseleave', this.menuHide)
    },
    menuHide({target}) {
      const menu = target.querySelector('.js_profile-auth__menu')
      menu.classList.remove('show')
    },
    logout(){
      this.$auth.logout()
      this.$router.push('/')
    }
  }
}
</script>

<style>
.profile-auth {
  display: flex;
}

.profile-auth__item:not(:first-child) {
  margin-left: 24px;
}

.profile-auth__item {
  position: relative;
  display: flex;
  align-items: center;
  flex-direction: column;
}

.profile-auth__person {
  height: 22px;
  width: 22px;
  fill: #d3a1df;
}

/* region menu */
.profile-menu {
  margin-left: -50%;
}

.profile-menu__inner {
  padding: 24px;
  transition: all 0.5ms ease;
  opacity: 0;
  visibility: hidden;
  position: absolute;
  z-index: 50;
  transform: translateX(-50%);
  box-shadow: 0 0 20px rgb(0 0 0 / 10%);
  background: #fff;
  border-radius: 8px;
  width: 205px;
}

.profile-menu__ul {
  padding-bottom: 16px;
  padding-left: 0;
  list-style-type: none;
  width: 100%;
}

.profile-menu__link {
  font-size: 14px;
  line-height: 20px;
  color: #000;
}

.profile-menu.show .profile-menu__inner {
  transform: translate(-50%, 0);
  opacity: 1;
  visibility: visible;
}

.profile-menu__link {
  font-size: 14px;
  line-height: 20px;
  color: #000;
}

.profile-menu__li:not(:first-child) {
  margin-top: 8px;
}

.profile-auth .profile-menu__user {
  font-weight: 900;
  color: #d3a1df;
  font-size: 14px;
  word-break: break-all;
}
.profile-menu__ul:not(:first-child) {
  border-top: 1px solid #ccc;
  padding-top: 16px;
}
/* endregion menu */
</style>
