<template>
  <f-layout>
    <template v-slot:page-header>
      <f-header />
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
import FLayout from '@/views/Layout';
import FFooter from '@/views/Footer';
export default {
  name: 'LayoutDefault',
  components: {
    FHeader, FLayout, FFooter, ModalWrapper
  },
  async middleware({store, $apitest}) {
    await store.dispatch('menus/fetchMenu', $apitest)
  }
};
</script>
