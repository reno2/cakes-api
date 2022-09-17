<template>
  <div>
    <div v-for="cart in list">
      <DetailAds :card="cart" />
    </div>
  </div>
</template>

<script>

import DetailAds from "./DetailAds";
export default {
  components:{
    DetailAds
  },
  props: {
    list: Array
  }
}
</script>

<style scoped>

</style>
