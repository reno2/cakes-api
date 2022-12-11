<template>
  <f-layout>
    <template v-slot:page-header>
      <f-header />
    </template>

    <template class="sidebar" v-slot:page-sidebar>
      <f-sidebar />
    </template>

    <template class="main" v-slot:page-content>
      <nuxt />
    </template>


    <template v-slot:page-footer>
      <f-footer />
      <ModalWrapper/>
    </template>
  </f-layout>
</template>

<script>
import ModalWrapper from "@/components/ModalWrapper";
import FHeader from '@/components/Header';
import FSidebar from '@/components/base/SidebarProfile';
import FLayout from '@/components/base/LayoutProfile';
import FFooter from '@/views/Footer';
export default {
  name: 'LayoutDefault',
  components: {
    FHeader, FLayout, FFooter, FSidebar, ModalWrapper
  },
  async middleware({store, $apitest}) {
    await store.dispatch('menus/fetchMenu', $apitest)
  }
};
</script>
