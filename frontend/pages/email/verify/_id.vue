<template>
  <div>
    123123
  </div>

</template>
<script>
export default {
  middleware: 'auth',
  layout: 'LayoutDefault',
  data() {
    return {
      posts: null
    }
  },
  async mounted() {
  },
  async asyncData({$apitest, route, $errorHandler, error, redirect}) {
    try {
      await $apitest.get(route.fullPath);
      redirect('/profile')
    } catch (e) {
      const errorResponse = $errorHandler.setAndParse(e)
      error({
        statusCode: errorResponse.status,
        message: errorResponse.message
      })
    }
  }

}
</script>
