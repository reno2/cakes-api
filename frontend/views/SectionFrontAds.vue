<template>
  <div class="section section__collections">
    <div class="container">
      <div class="ads">
        <template v-for="cart in data">
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
    data: Array
  },
  inheritAttrs: false,
  mounted() {
    console.log(this.data)
  }
}
</script>

<style scoped>
.ads {
  display: flex;
  flex-wrap: wrap;
}
</style>
