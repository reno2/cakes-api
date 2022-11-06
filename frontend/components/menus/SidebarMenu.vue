<template>
  <div class="sidebar-menu">
    <div class="sidebar-menu__ul">
      <nuxt-link class="sidebar-menu__link btn wide btn-middle btn-grey btn-square" v-for="(item, idx) in menu" :key="idx" :to="item.action">
        <div class="sidebar-menu__title">{{item.name}}</div>
      </nuxt-link>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      menu: [
        {name: 'Добавить объявление', action: '/profile/ads/create', type: 'active'},
        {name: 'Изменить профиль', action: '/'},
        {name: 'Изменить пароль', action: '/'},
        {name: 'Объявления', action: '/'},
        {name: 'Вопросы', action: '/'},
        {name: 'Избранное', action: '/'},
      ]
    }
  }

}
</script>

<style>
.sidebar-menu{}
.sidebar-menu__ul{
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}
.sidebar-menu__link{
  display: flex;
  justify-content: flex-start;
}
.sidebar-menu__link:not(:last-child){
  margin-bottom: 8px;
}
.sidebar-menu__title{
  margin-left: 8px;
  color: #000;
  font-weight: 400;
  font-size: 14px;
}
</style>
