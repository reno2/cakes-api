<template>
  <div class="section section__collections">
    <div class="container">
      <div class="ads">
        <template v-for="cart in list">
          <DetailAds :card="cart"/>
        </template>
      </div>
    </div>
  </div>
</template>

<script>

import DetailAds from "./DetailAds";

export default {
  components: {
    DetailAds
  },
  props: {
    list: Array
  },
  inheritAttrs: false
}
</script>

<style scoped>
.ads {
  display: flex;
  flex-wrap: wrap;
}
</style>
