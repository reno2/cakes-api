<template>
  <div class="section section__collections">
    <div class="container">
      <div class="ads">
        <template v-for="cart in data">
          <DetailAds :card="cart" view="profile"/>
        </template>
      </div>
    </div>

    <template v-for="(link, inx) in links" >
      <nuxt-link v-if="link" :to="cutPath(link)">
          {{inx}}
      </nuxt-link>
    </template>

  </div>
</template>

<script>

import DetailAds from "./DetailAds";

export default {
  components: {
    DetailAds
  },
  props: {
    links: {
      type: Object,
      default: null
    },
    data: Array
  },
  inheritAttrs: false,
  methods: {
    cutPath(filepath){

      return filepath.replace(process.env.baseUrl, '')
    }
  },
  mounted() {

  }
}
</script>

<style scoped>
.ads {
  display: flex;
  flex-wrap: wrap;
}
</style>
