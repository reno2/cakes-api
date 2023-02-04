<template>
  <div class="container">
    asdfdsf
  </div>

</template>
<script>

import login from "./login";

export default {
  layout: 'LayoutDefault',

  methods:{
  },
  async asyncData({$apitest, error }) {
    try{
      const res = await $apitest.get('/products');
      console.log('success' + res)
    }catch(e){

      if(e.response.status === 429){
        error({ statusCode: 429, message: e.response.statusText })
      }
      console.log(e.response.status)

    }

  }
}
</script>
