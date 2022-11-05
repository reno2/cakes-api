<template>
  <div class="sidebar">
    <div class="sidebar__top">
        <sidebar-menu />
    </div>
    <div class="sidebar__menu">

    </div>
  </div>
</template>

<script>
import SidebarMenu from "@/components/menus/SidebarMenu"
export default {
  data(){
    return {

    }
  },
  components: {SidebarMenu}
}
</script>

<style>
.sidebar{
  width: 100%;
}
</style>
